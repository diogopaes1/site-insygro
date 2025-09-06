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

## Como Atualizar o Site no GitHub Pages

Para atualizar o site após fazer modificações locais, siga estes 3 passos no terminal do VS Code:

1.  **Adicionar todas as alterações para serem salvas:**
    ```powershell
    git add .
    ```

2.  **Criar um "pacote" de atualização (commit) com uma mensagem automática:**
    ```powershell
    git commit -m "Atualização do site em $(Get-Date -Format 'dd-MM-yyyy HH:mm:ss')"
    ```

3.  **Enviar as alterações para o GitHub para publicar:**
    ```powershell
    git push
    ```

Após o `push`, o GitHub Pages irá atualizar o site automaticamente em 1 ou 2 minutos.

---

## Princípios Técnicos e Boas Práticas

Para garantir a consistência e evitar erros comuns durante o desenvolvimento, os seguintes princípios devem ser seguidos:

### 1. Template Padrão para Novas Páginas HTML

Toda nova página `.html` criada para este projeto **DEVE** seguir a estrutura mínima abaixo. Isso garante que todas as funcionalidades essenciais (estilos, animações, SEO) estejam presentes desde o início.

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ATENÇÃO: Mudar a descrição para ser específica da página -->
    <meta name="description" content="Descrição específica da página aqui.">
    <!-- ATENÇÃO: Mudar o título para ser específico da página -->
    <title>Título da Página - Insygro</title>
    <link rel="icon" href="Image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <!-- Conteúdo do Header (geralmente copiado de outra página) -->
    </header>

    <main>
        <!-- Conteúdo principal da página -->
    </main>

    <footer>
        <!-- Conteúdo do Footer (geralmente copiado de outra página) -->
    </footer>

    <!-- SCRIPTS ESSENCIAIS - DEVEM ESTAR EM TODAS AS PÁGINAS -->
    <script src="js/script.js"></script>
    <script src="js/animations.js"></script>
</body>
</html>
```

### 2. Convenção de Nomenclatura CSS

Para evitar que estilos de uma página afetem outra inesperadamente (como o problema dos links de serviço):
- **Estilos Gerais:** Classes que se aplicam a todo o site (ex: `.container`, `.cta-button`) podem ter nomes genéricos.
- **Estilos Específicos:** Se um estilo é exclusivo para um componente de uma página específica, use um nome que reflita isso.
    - **Exemplo Ruim:** `.card-link` (muito genérico).
    - **Exemplo Bom:** `.home-service-card-link` ou `.service-page-details-link`. Isso deixa claro onde o estilo deve ser aplicado.