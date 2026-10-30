# 📋 Checklist de Refatoração & Validação de Landing Pages

Utilize este checklist em cada entrega para garantir que a página esteja 100% pronta para receber tráfego pago sem desperdício de orçamento.

---

### 1. Performance & Core Web Vitals
- [ ] Teste no Google PageSpeed Insights (Meta: > 85 Mobile / > 95 Desktop).
- [ ] LCP (Largest Contentful Paint) menor que 2.0s na conexão 4G simulada.
- [ ] Todas as imagens convertidas para WebP e devidamente comprimidas (< 120KB cada).
- [ ] Elementor experimentos de performance ativados (Optimized DOM Output, Improved Asset Loading).
- [ ] Lazy load ativo para imagens abaixo da dobra e vídeos externos.

### 2. Tracking & Analytics
- [ ] Google Tag Manager (GTM) instalado no `<head>` e no início do `<body>`.
- [ ] Meta Pixel e API de Conversões (CAPI) validados via *Meta Pixel Helper* e *Test Events*.
- [ ] Tags de Conversão do Google Ads instaladas com disparador no evento de sucesso / página de obrigado.
- [ ] Parâmetros de UTM persistindo corretamente no clique para o WhatsApp.
- [ ] Eventos de clique em botões secundários e links externos sendo computados no GA4.

### 3. CRO & Mobile UX
- [ ] Botão de CTA da Dobra 1 com alto contraste e visível sem rolagem no mobile.
- [ ] Formulário com autocomplete ativado (`name="name"`, `type="email"`, `type="tel"`).
- [ ] Testado em telas iPhone (Safari) e Android (Chrome).
- [ ] Links de telefone e WhatsApp abrindo diretamente no aplicativo correto (sem tela de erro).
- [ ] Política de Privacidade e Termos de Uso visíveis no rodapé (exigência das políticas de anúncios do Meta e Google).
