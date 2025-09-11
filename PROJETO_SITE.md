# Plano de Desenvolvimento - Site Insygro Ciência e Tecnologia (Revisão 1)

## 1. Visão Geral
O objetivo é criar um site profissional e moderno para a Insygro, que sirva como principal plataforma de divulgação de serviços, apresentação de projetos e canal de contato com clientes. O design será limpo e moderno, com fundo branco e detalhes em verde, refletindo a identidade visual da empresa e seu foco em tecnologia e ciência. O site destacará a capacidade da empresa em análise de dados avançada e o uso de ferramentas de IA.

## 2. Tecnologia Proposta
- **HTML5:** Para a estrutura semântica do conteúdo.
- **CSS3:** Para estilização moderna (uso de Flexbox/Grid), layout responsivo e animações sutis.
- **JavaScript (ES6+):** Para funcionalidades interativas, como o formulário de contato avançado.

## 3. Estrutura de Páginas e Conteúdo

### a. Páginas Principais (Visíveis no Menu)
- **`index.html` (Home):** Apresentação impactante, destacando os pilares: Biotecnologia Agrícola, Consultoria Agronômica e Análise de Dados Multissetorial. Incluir menções ao uso de IA.
- **`servicos.html` (Serviços):** Página principal que funcionará como um portal, apresentando de forma criativa as três grandes áreas de serviço e direcionando para páginas de detalhes.
- **`projetos.html` (Projetos/Portfólio):** Apresentará cases de sucesso de forma anônima, baseados nos relatórios, para demonstrar a expertise da empresa.
- **`sobre.html` (Sobre Nós):** Conterá a história, missão, e o perfil técnico da equipe, reforçando a base científica da empresa.
- **`contato.html` (Contato):** Página com o novo formulário de contato avançado.

### b. Subpáginas de Serviços (Acessadas via `servicos.html`)
- **`servico-analise-dados.html`:** Detalhará os serviços de análise estatística e Big Data para diversas áreas.
- **`servico-metagenomica.html`:** Foco nos serviços de bioinformática, análise de dados metagenômicos, SNPs, etc.
- **`servico-agronomia.html`:** Detalhes sobre a consultoria em fertilidade do solo, manejo e análise de indicadores bioquímicos.

### c. `contato.html` (Funcionalidades Avançadas)
- **Formulário Condicional:**
    - Campo de seleção: "Dúvidas Gerais" ou "Solicitar Orçamento".
    - E-mails de destino diferentes: `duvidas@insygro.com.br` e `orcamento@insygro.com.br`.
    - Se "Orçamento" for selecionado, surgirão checkboxes para os serviços específicos (+ opção "Outros").
    - Limite de 2500 caracteres no campo de mensagem.
- **Verificação Anti-Robô:**
    - Integração com um serviço gratuito como o Google reCAPTCHA v2 ("Não sou um robô") para validar o envio do formulário.

## 4. Estrutura de Arquivos e Pastas (Atualizada)
```
/Site_Insygro
|
|-- Image/
|   |-- Logo_Insygro.jpg
|
|-- css/
|   |-- style.css       # Arquivo de estilo principal, com design moderno
|
|-- js/
|   |-- script.js       # Script para o formulário de contato e outras interações
|
|-- index.html
|-- servicos.html
|-- projetos.html
|-- sobre.html
|-- contato.html
|-- servico-analise-dados.html  # NOVA PÁGINA
|-- servico-metagenomica.html # NOVA PÁGINA
|-- servico-agronomia.html    # NOVA PÁGINA
|-- PROJETO_SITE.md
```

---

## Publicação e Atualização na Hostinger

Para publicar ou atualizar o site no domínio `insygro.com.br`, siga estes passos:

### 1. Preparar os Arquivos
1.  No seu computador, abra a pasta do projeto `Site_Insygro`.
2.  Selecione **todos os arquivos e pastas** (HTML, CSS, JS, Image, etc.). **NÃO inclua a pasta `.git`**.
3.  Clique com o botão direito nos arquivos selecionados e escolha **"Enviar para" > "Pasta compactada (zipada)"**.
4.  Nomeie o arquivo como `site.zip`.

### 2. Enviar para a Hostinger
1.  Acesse o painel da Hostinger e vá para **Gerenciador de Arquivos**.
2.  Entre na pasta `public_html`. Se for uma atualização, exclua os arquivos antigos primeiro (após fazer um backup).
3.  Use a função **"Upload"** para enviar o arquivo `site.zip`.
4.  Clique com o botão direito no `site.zip` e selecione **"Extrair"** (Extract), confirmando a extração para a pasta `public_html`.

### 3. Configurações Pós-Publicação (Crítico)
- **Google reCAPTCHA:** Lembre-se de que o domínio `insygro.com.br` e `www.insygro.com.br` devem estar autorizados no painel do Google reCAPTCHA para que o formulário de contato funcione.

---

## Checklist de Manutenção e Atualização

Antes de fazer o upload de uma nova versão do site para a Hostinger, siga este checklist para evitar a reintrodução de bugs antigos:

-   **[ ] 1. Consistência do Cabeçalho:**
    -   Se você modificou o menu de navegação, você copiou e colou o `<header>...</header>` completo e idêntico para **TODAS** as páginas `.html`? (A única diferença permitida é a classe `.active` no link da página atual).

-   **[ ] 2. Scripts Essenciais:**
    -   Todas as páginas `.html` (incluindo novas páginas) possuem os dois scripts no final do `<body>`?
        ```html
        <script src="js/script.js"></script>
        <script src="js/animations.js"></script>
        ```

-   **[ ] 3. Teste de Responsividade:**
    -   Você diminuiu a janela do navegador no seu computador para verificar se o menu hambúrguer aparece e funciona corretamente?
    -   As seções da página se ajustam para o formato de coluna sem quebrar o layout?

-   **[ ] 4. Formulário de Contato:**
    -   Se o site for ser testado em um novo domínio/endereço, você adicionou este novo domínio à lista de permissões no painel do Google reCAPTCHA?

-   **[ ] 5. Compactação Correta:**
    -   Ao criar o arquivo `.zip`, você selecionou os arquivos *dentro* da pasta do projeto e **NÃO** incluiu a pasta `.git`?

Seguir este checklist garantirá que as atualizações futuras sejam tranquilas e sem surpresas.

## Implementação do Chatbot com IA (Synapse)

- **Objetivo:** Adicionar um assistente virtual interativo ao site para responder perguntas dos usuários em tempo real.
- **Tecnologia:**
  - **Frontend:** A interface do chat foi construída com HTML, CSS e JavaScript (`chatbot.js`, `chatbot.css`).
  - **Backend (Proxy):** Para proteger a chave da API e gerenciar a lógica, foi criado um proxy em PHP (`api/groq-proxy.php`). Esta abordagem é segura e adequada para ambientes de hospedagem compartilhada como a Hostinger.
  - **IA:** A inteligência artificial é fornecida pela **Groq API**, utilizando o modelo `llama3-8b-8192`.
- **Configuração do Servidor:**
  - Foi criado um arquivo `.htaccess` na raiz do projeto para garantir que as chamadas do JavaScript para o proxy PHP não sejam bloqueadas ou redirecionadas pelas configurações do servidor.
- **Status:** Implementado e em fase de testes/produção.