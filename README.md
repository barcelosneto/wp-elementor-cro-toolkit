# 🚀 WordPress + Elementor CRO & Performance Stack for Media Buyers

> **Stack e Toolkit de Desenvolvimento WordPress + Elementor voltado a Tráfego Pago, Otimização de Conversão (CRO) e Core Web Vitals (90+ Mobile).**

Desenvolvido especialmente para operações de tráfego pago e agências que demandam páginas rápidas, tagueamento de dados limpo e zero atrito técnico entre a mídia e o desenvolvimento.

---

## 🎯 Por que esta stack foi desenhada para Gestores de Tráfego?

A maioria dos desenvolvedores entrega páginas pesadas cheias de plugins desnecessários, com botões que quebram eventos no Pixel do Meta/Google Ads e sem persistência de UTMs. Este projeto resolve isso na raiz:

1. **Persistência Dinâmica de UTMs (`utm_source`, `utm_campaign`, etc.):**
   - Salva automaticamente os parâmetros de tráfego na sessão do visitante.
   - Concatena dinamicamente os parâmetros nos links de **WhatsApp (wa.me)** e **Checkouts (Kiwify, Hotmart, Eduzz, etc.)**.
   - Garante que a equipe de mídia saiba exatamente qual anúncio gerou cada conversa no WhatsApp ou venda.

2. **DataLayer Automatizado para Google Tag Manager (GTM) & Meta Pixel:**
   - Dispara eventos em tempo real (`cro_cta_click`, `cro_form_submit_success`) sem depender de seletores CSS frágeis.
   - Compatível de forma nativa com Elementor Forms e botões de chamada para ação.

3. **Performance First & Core Web Vitals (LCP < 1.5s):**
   - Otimização sem bloat: script de tracking com menos de 4KB, sem bibliotecas pesadas.
   - Defer automático de scripts não críticos.
   - Padrão arquitetural pronto para atingir notas 90+ no Google PageSpeed (Mobile e Desktop).

---

## 🛠️ Arquitetura e Estrutura dos Arquivos

```text
wp-elementor-cro-toolkit/
├── wp-elementor-cro-toolkit.php   # Micro-plugin WP com DataLayer, UTM Tracking & Scripts Defer
├── README.md                      # Documentação técnica e metodologia
└── checklist-cro-refactoring.md   # Checklist de auditoria e refatoração de LPs
```

---

## ⚡ Metodologia de Refatoração e Criação de LPs

Quando assumo uma página para refatorar ou criar do zero, sigo este fluxo de 5 etapas:

### 1. Auditoria de Performance & Assets
- Remoção de plugins obsoletos e substituição de scripts por soluções nativas.
- Implementação de imagens em formato moderno (`.webp`) com dimensões responsivas corretas.
- Pré-carregamento (`preload`) de fontes locais (evitando requisições bloqueantes do Google Fonts).
- Configuração de cache de página e minificação sem quebrar os seletores do Elementor.

### 2. Responsividade Mobile-First
- Mais de 80% do tráfego pago chega via smartphone.
- Ajuste de *touch targets* (mínimo de 48px para botões).
- Eliminação de *Cumulative Layout Shift* (CLS) reservando espaçamentos para iframes e elementos dinâmicos.

### 3. Tagueamento & Analytics (GTM / GA4 / Meta Pixel / CAPI)
- Criação e verificação do contêiner GTM com triggers padronizados.
- Validação de disparo do evento de *Lead* / *InitiateCheckout* no carregamento e no clique.
- Teste em tempo real no *Tag Assistant* e no *Meta Events Manager* (Test Events).

### 4. Copy e Hierarquia Visual (CRO)
- Dobra 1 (*Above the fold*) com Proposta Única de Valor evidente em menos de 3 segundos.
- Prova social posicionada estrategicamente junto aos principais pontos de fricção.
- Formulários com menor número possível de campos para maximizar taxa de conversão.

---

## 💻 Instalação do Toolkit no WordPress

1. Baixe a pasta `wp-elementor-cro-toolkit` ou compacte em `.zip`.
2. No painel do WordPress, vá em **Plugins > Adicionar Novo > Enviar Plugin**.
3. Ative o plugin.
4. *(Opcional)* Como alternativa, instale o arquivo diretamente em `wp-content/mu-plugins/` para execução permanente sem possibilidade de desativação acidental pelo cliente.

---

## 📊 Eventos disparados no `window.dataLayer`

| Evento | Variáveis Enviadas | Quando dispara? |
| :--- | :--- | :--- |
| `cro_cta_click` | `cta_type` (whatsapp, checkout, custom), `cta_text`, `cta_url` | Clique em qualquer link do WhatsApp, checkout ou elemento com a classe `.cro-track-click`. |
| `cro_form_submit_success` | `form_id`, `timestamp` | Envio com sucesso de qualquer formulário nativo do Elementor Pro. |

---

## 🤝 Parceria para Gestores de Tráfego & Produtores

Se você é gestor de tráfego pago ou dono de agência, pode contar comigo para:
- **Repositório:** [github.com/barcelosneto/wp-elementor-cro-toolkit](https://github.com/barcelosneto/wp-elementor-cro-toolkit)
- **Autor:** Pedro Moacyr Barcelos Neto

- **Implementação e revisão completa de tagueamento** (GTM, Meta Pixel, Google Ads, GA4).
- **Otimização de velocidade** para reduzir rejeição (*bounce rate*) e baixar o CPA dos seus anúncios.
