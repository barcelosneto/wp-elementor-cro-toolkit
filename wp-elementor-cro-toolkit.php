<?php
/**
 * Plugin Name: Elementor CRO & Tracking Toolkit for Media Buyers
 * Description: High-performance micro-toolkit for WordPress + Elementor landing pages: Dynamic UTM persistence (WhatsApp/Links), automated DataLayer push, and critical performance optimizations.
 * Version: 1.0.0
 * Author: Especialista WordPress & CRO
 * License: GPL-2.0+
 */

if (!defined('ABSPATH')) {
    exit;
}

class Elementor_CRO_Toolkit {
    private static $instance = null;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets'], 99);
        add_action('wp_footer', [$this, 'inject_datalayer_init'], 1);
        add_filter('script_loader_tag', [$this, 'defer_scripts'], 10, 2);
    }

    /**
     * Enqueue lightweight tracking and conversion script (< 4KB)
     */
    public function enqueue_assets() {
        wp_register_script(
            'cro-toolkit-js',
            false,
            [],
            '1.0.0',
            true
        );
        wp_enqueue_script('cro-toolkit-js');

        $inline_script = <<<JS
(function() {
    'use strict';

    // 1. UTM Extraction and Local Storage Persistence
    const utmParams = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'sck', 'src'];
    const urlParams = new URLSearchParams(window.location.search);
    
    utmParams.forEach(param => {
        if (urlParams.has(param)) {
            sessionStorage.setItem('cro_' + param, urlParams.get(param));
        }
    });

    function getStoredUtms() {
        let stored = {};
        utmParams.forEach(param => {
            const val = sessionStorage.getItem('cro_' + param);
            if (val) stored[param] = val;
        });
        return stored;
    }

    // 2. Dynamic WhatsApp & Checkout URL UTM Appending
    function appendUtmsToLinks() {
        const utms = getStoredUtms();
        if (Object.keys(utms).length === 0) return;

        const targetLinks = document.querySelectorAll('a[href*="api.whatsapp.com"], a[href*="wa.me"], a[href*="kiwify.com.br"], a[href*="hotmart.com"], a[href*="eduzz.com"], .cro-append-utm');
        
        targetLinks.forEach(link => {
            try {
                let url = new URL(link.href);
                Object.keys(utms).forEach(key => {
                    if (!url.searchParams.has(key)) {
                        url.searchParams.set(key, utms[key]);
                    }
                });
                link.href = url.toString();
            } catch (e) {}
        });
    }

    // 3. Automated DataLayer Triggers for Elementor Forms and CTA Clicks
    function initDataLayerEvents() {
        window.dataLayer = window.dataLayer || [];

        // Track CTA clicks
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('a, button, .elementor-button');
            if (!btn) return;

            const isWhatsApp = /whatsapp|wa\.me/i.test(btn.href || '');
            const isCheckout = /checkout|cart|kiwify|hotmart|eduzz/i.test(btn.href || '');

            if (isWhatsApp || isCheckout || btn.classList.contains('cro-track-click')) {
                window.dataLayer.push({
                    event: 'cro_cta_click',
                    cta_type: isWhatsApp ? 'whatsapp' : (isCheckout ? 'checkout' : 'custom_button'),
                    cta_text: btn.innerText.trim(),
                    cta_url: btn.href || '',
                    timestamp: new Date().toISOString()
                });
            }
        });

        // Listen for Elementor Form submissions via jQuery hook if available
        if (window.jQuery) {
            window.jQuery(document).on('submit_success', function(e, response) {
                window.dataLayer.push({
                    event: 'cro_form_submit_success',
                    form_id: e.target ? e.target.getAttribute('name') || e.target.id : 'elementor_form',
                    timestamp: new Date().toISOString()
                });
            });
        }
    }

    // Initialize on DOM Ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            appendUtmsToLinks();
            initDataLayerEvents();
        });
    } else {
        appendUtmsToLinks();
        initDataLayerEvents();
    }
})();
JS;
        wp_add_inline_script('cro-toolkit-js', $inline_script);
    }

    /**
     * DataLayer Initialization safety check
     */
    public function inject_datalayer_init() {
        echo "<script>window.dataLayer = window.dataLayer || [];</script>\n";
    }

    /**
     * Defer non-critical scripts for PageSpeed Core Web Vitals optimization
     */
    public function defer_scripts($tag, $handle) {
        if (is_admin()) return $tag;
        if (strpos($tag, 'defer') !== false || strpos($tag, 'async') !== false) return $tag;

        $defer_handles = ['cro-toolkit-js'];
        if (in_array($handle, $defer_handles, true)) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
        return $tag;
    }
}

add_action('plugins_loaded', ['Elementor_CRO_Toolkit', 'get_instance']);
