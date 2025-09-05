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