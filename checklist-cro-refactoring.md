# Checklist de Refatoracao & Validacao de Landing Pages

Utilize este checklist em cada entrega para garantir que a pagina esteja 100% pronta para receber trafego pago sem desperdicio de orcamento.

---

### 1. Performance & Core Web Vitals
- [ ] Teste no Google PageSpeed Insights (Meta: > 85 Mobile / > 95 Desktop).
- [ ] LCP (Largest Contentful Paint) menor que 2.0s na conexao 4G simulada.
- [ ] Todas as imagens convertidas para WebP e devidamente comprimidas (< 120KB cada).
- [ ] Elementor experimentos de performance ativados (Optimized DOM Output, Improved Asset Loading).
- [ ] Lazy load ativo para imagens abaixo da dobra e videos externos.

### 2. Tracking & Analytics
- [ ] Google Tag Manager (GTM) instalado no `<head>` e no inicio do `<body>`.
- [ ] Meta Pixel e API de Conversoes (CAPI) validados via Meta Pixel Helper e Test Events.
- [ ] Tags de Conversao do Google Ads instaladas com disparador no evento de sucesso / pagina de obrigado.
- [ ] Parametros de UTM persistindo corretamente no clique para o WhatsApp.
- [ ] Eventos de clique em botoes secundarios e links externos sendo computados no GA4.

### 3. CRO & Mobile UX
- [ ] Botao de CTA da Dobra 1 com alto contraste e visivel sem rolagem no mobile.
- [ ] Formulario com autocomplete ativado (`name="name"`, `type="email"`, `type="tel"`).
- [ ] Testado em telas iPhone (Safari) e Android (Chrome).
- [ ] Links de telefone e WhatsApp abrindo diretamente no aplicativo correto (sem tela de erro).
- [ ] Politica de Privacidade e Termos de Uso visiveis no rodape (exigencia das politicas de anuncios do Meta e Google).
