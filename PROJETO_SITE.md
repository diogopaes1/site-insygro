# Plano de Desenvolvimento - Site Insygro Ciência e Tecnologia (Revisão 1)

## 1. Visão Geral
O objetivo é criar um site profissional e moderno para a Insygro, que sirva como principal plataforma de divulgação de serviços, apresentação de projetos e canal de contato com clientes. O design será limpo e moderno, com fundo branco e detalhes em verde, refletindo a identidade visual da empresa e seu foco em tecnologia e ciência. O site destacará a capacidade da empresa em análise de dados avançada e o uso de ferramentas de IA.

## 2. Tecnologia Proposta
- **HTML5:** Para a estrutura semântica do conteúdo.
- **CSS3:** Para estilização moderna (uso de Flexbox/Grid), layout responsivo e animações sutis.
- **JavaScript (ES6+):** Para funcionalidades interativas, como o formulário de contato avançado.

## 3. Estrutura de Páginas e Conteúdo

### a. Páginas Principais (Visíveis no Menu)
- **`index.html` (Home):** Página principal com um carrossel de imagens dinâmico e seções destacando as quatro frentes de atuação da empresa.
- **`servicos.html` (Serviços):** Página principal que funciona como um portal, apresentando os cinco serviços detalhados da empresa.
- **`projetos.html` (Projetos/Portfólio):** Apresentará cases de sucesso de forma anônima, baseados nos relatórios, para demonstrar a expertise da empresa.
- **`sobre.html` (Sobre Nós):** Conterá a história, missão, e o perfil técnico da equipe, reforçando a base científica da empresa.
- **`contato.html` (Contato):** Página com o novo formulário de contato avançado.

### b. Subpáginas de Serviços (Acessadas via `servicos.html`)
- **`servico-analise-dados.html`:** Detalhará os serviços de análise estatística e Big Data para diversas áreas.
- **`servico-metagenomica.html`:** Foco nos serviços de bioinformática, análise de dados metagenômicos, SNPs, etc.
- **`servico-agronomia.html`:** Detalhes sobre a consultoria, incluindo análise de solo, indicadores bioquímicos e a nova capacidade de análise geoespacial.
- **`servico-micropropagacao.html`:** Detalhes sobre a produção de mudas in vitro.
- **`servico-pd-biologico.html`:** Detalhes sobre o serviço de Pesquisa e Desenvolvimento de bioinsumos.

### c. `contato.html` (Funcionalidades Avançadas)
- **Formulário Condicional:**
    - Campo de seleção: "Dúvidas Gerais" ou "Solicitar Orçamento".
    - E-mails de destino diferentes: `duvidas@insygro.com.br` e `orcamento@insygro.com.br`.
    - Se "Orçamento" for selecionado, surgirão checkboxes para os serviços específicos (+ opção "Outros").
    - Limite de 2500 caracteres no campo de mensagem.
- **Verificação Anti-Robô:**
    - Integração com um serviço gratuito como o Google reCAPTCHA v2 ("Não sou um robô") para validar o envio do formulário.

## 4. Estrutura de Arquivos e Pastas (Atualizada)

### a. Carrossel de Imagens (Página Inicial)
- **Implementação:** Um carrossel de imagens foi adicionado à seção "hero" da `index.html`.
- **Lógica:** O `js/script.js` contém a lógica para criar os slides, os controles de navegação (setas e indicadores) e a transição automática (atualmente configurada para 10 segundos).
- **Fonte das Imagens:** As imagens são definidas em uma lista estática dentro do `js/script.js`. Para adicionar ou remover imagens, basta editar este array.
- **Estilização:** O `css/style.css` usa a propriedade `aspect-ratio: 16 / 9` e `max-height` para garantir que o carrossel mantenha a proporção correta e não cresça excessivamente em telas largas.

### b. Estrutura de Arquivos
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
|-- servico-analise-dados.html
|-- servico-metagenomica.html
|-- servico-agronomia.html
|-- servico-micropropagacao.html
|-- servico-pd-biologico.html
|-- FertExtrat.html
|-- micropropagacao-mandioca.html
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

## Implementação do Chatbot com IA (Synapse) - GUIA COMPLETO

### 1. Visão Geral da Implementação
- **Objetivo:** Assistente virtual "Synapse" integrado ao site da Insygro para atendimento automatizado 24/7
- **Personalidade:** Profissional, prestativo, otimista e acessível, especializado em agronegócio, saúde e meio ambiente
- **Idioma:** Português brasileiro exclusivamente
- **Status:** ✅ **IMPLEMENTADO E FUNCIONANDO** (Setembro 2025)

### 2. Arquitetura Técnica Detalhada

#### 2.1 Frontend (Interface do Usuário)
- **HTML:** Interface integrada em todas as páginas do site
- **CSS:** `css/chatbot.css` - Estilização responsiva com design moderno
- **JavaScript:** `js/chatbot.js` - Lógica de comunicação e interação
- **Backup:** `js/chatbot-limpo.js` - Versão limpa para referência

#### 2.2 Backend (Proxy Seguro)
- **Arquivo:** `api/groq-proxy.php`
- **Função:** Proxy seguro para proteger a chave da API Groq
- **Configurações CORS:** Habilitadas para comunicação frontend-backend
- **Error Logging:** Sistema completo de logs para debugging

#### 2.3 Integração com IA
- **Provedor:** Groq API (https://console.groq.com)
- **Modelo:** `llama-3.1-8b-instant` (atualizado - modelo anterior `llama3-8b-8192` foi descontinuado)
- **Chave API:** `REMOVIDO_POR_SEGURANCA` (válida)
- **Chave API:** `[CONFIGURADA_DIRETAMENTE_NO_ARQUIVO_PHP]` (Não armazenar neste documento por segurança)

### 3. Estrutura de Arquivos Atualizada
```
/Site_Insygro
|
|-- api/
|   |-- groq-proxy.php          # Proxy PHP para comunicação segura com Groq API
|   |-- test-api.php           # Arquivo de teste da API (opcional)
|
|-- css/
|   |-- style.css              # Estilo principal do site
|   |-- chatbot.css            # Estilização específica do chatbot
|
|-- js/
|   |-- script.js              # Scripts gerais do site
|   |-- animations.js          # Animações do site
|   |-- chatbot.js             # Lógica principal do chatbot
|   |-- chatbot-limpo.js       # Backup limpo do chatbot
|
|-- Image/
|   |-- chatbot-mascote.png    # Ícone do chatbot
|   |-- send-icon.png          # Ícone de envio
|   |-- (outros arquivos...)
|
|-- [páginas HTML existentes]
|-- PROJETO_SITE.md
```

### 4. Configuração do Ambiente de Desenvolvimento

#### 4.1 Servidor Local (XAMPP)
- **Requisito:** PHP habilitado (XAMPP 8.2 ou superior)
- **Motivo:** Live Server não executa PHP
- **Instalação:** `winget install ApacheFriends.Xampp.8.2`
- **Pasta de Trabalho:** `C:\xampp\htdocs\Site_Insygro\`
- **URL Local:** `http://localhost/Site_Insygro/`

#### 4.2 Sincronização de Arquivos
**Comando para sincronizar desenvolvimento → XAMPP:**
```bash
xcopy "c:\Users\dpc_w\OneDrive\Desktop\Site_Insygro" "C:\xampp\htdocs\Site_Insygro" /E /I /Y
```

### 5. Configuração Detalhada dos Arquivos

#### 5.1 `api/groq-proxy.php` - Configurações Essenciais
```php
// MODELO ATUALIZADO (Setembro 2025)
'model' => 'llama-3.1-8b-instant'

// SYSTEM PROMPT PERSONALIZADO E SEGURO
'content' => 'Você é o "Synapse", assistente virtual da Insygro Ciência e Tecnologia... 
[Inclui diretrizes de segurança e limitações de informações confidenciais]'

// FILTROS DE SEGURANÇA IMPLEMENTADOS
$blockedKeywords = [
    'senha', 'password', 'chave api', 'api key', 'token', 'login',
    'relatório confidencial', 'documento interno', 'financeiro', 'preço',
    'valor', 'custo', 'orçamento específico', 'contrato', 'propriedade intelectual',
    'dados pessoais', 'cliente específico', 'processo interno', 'metodologia proprietária'
];

// HEADERS CORS OBRIGATÓRIOS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// CONFIGURAÇÃO CURL
CURLOPT_SSL_VERIFYPEER => false,  // Para localhost
CURLOPT_TIMEOUT => 30,
CURLOPT_FOLLOWLOCATION => true,
```

#### 5.2 `js/chatbot.js` - Configurações Principais
```javascript
// URL DO PROXY (ajustar conforme ambiente)
const response = await fetch('api/groq-proxy.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ message: userMessage })
});

// TRATAMENTO DE ERROS COMPLETO
console.log('Enviando mensagem:', userMessage);
console.log('Status da resposta:', response.status);
```

### 6. Resolução de Problemas Comuns

#### 6.1 Erro 400 Bad Request
- **Causa:** Modelo da IA descontinuado
- **Solução:** Atualizar modelo no `groq-proxy.php`
- **Verificação:** Console do navegador (F12)

#### 6.2 Erro CORS
- **Causa:** Headers de CORS não configurados
- **Solução:** Verificar headers no arquivo PHP
- **Teste:** Usar navegador em modo incógnito

#### 6.3 Erro 500 Internal Server Error
- **Causa:** PHP não habilitado ou arquivo corrompido
- **Solução:** Verificar XAMPP e sintaxe do PHP
- **Debug:** Habilitar logs no PHP

### 7. Deployment para Produção (Hostinger)

#### 7.1 Preparação dos Arquivos
1. **Verificar:** Todos os arquivos do chatbot estão incluídos
2. **Testar:** Funcionalidade completa no ambiente local
3. **Compactar:** Criar ZIP incluindo pasta `api/`

#### 7.2 Configurações Específicas da Hostinger
- **PHP:** Suporte nativo habilitado
- **CORS:** Configurado automaticamente
- **SSL:** Certificado válido para HTTPS

#### 7.3 Pós-Deploy
- **URL de Produção:** Atualizar se necessário no `chatbot.js`
- **Teste Completo:** Verificar todas as funcionalidades
- **Monitoramento:** Acompanhar logs de erro

### 8. Manutenção e Monitoramento

#### 8.1 Segurança e Proteção de Dados
- **Filtros de Conteúdo:** Sistema automatizado bloqueia tentativas de obter informações confidenciais
- **Palavras-chave Restritas:** Proteção contra solicitações de senhas, dados financeiros, contratos e propriedade intelectual
- **Resposta Segura:** Direciona usuários para canais apropriados quando solicitam informações sensíveis
- **Logs de Segurança:** Monitoramento de tentativas de acesso a informações restritas

#### 8.2 Contexto e Conhecimento do Chatbot
- **Estrutura do Site:** Conhecimento completo da navegação e conteúdo de todas as páginas
- **Informações Específicas:** Localização, endereço, equipe, projetos e serviços detalhados
- **Direcionamento Inteligente:** Orienta usuários para formulário de contato conforme necessidade
- **Páginas Conhecidas:** Home, Serviços, Sobre, Projetos, Contato e todas as subpáginas de serviços
- **Limitações:** NÃO fornece telefone (não disponível), valores, orçamentos específicos ou dados confidenciais

#### 8.3 Recursos de Interface e Segurança
- **Botão Minimizar:** Presente no canto superior direito da janela do chat
- **Limitação de Mensagens:** Máximo 15 mensagens por minuto por usuário
- **Sistema Anti-Abuso:** Bloqueio automático com mensagem educativa após limite excedido
- **Sessão Controlada:** Rastreamento por sessão PHP para evitar spam
- **Interface Responsiva:** Funciona em dispositivos móveis e desktop

#### 8.3 Atualizações de Modelo
- **Frequência:** Verificar trimestralmente
- **Fonte:** Console Groq (https://console.groq.com)
- **Processo:** Atualizar `groq-proxy.php` e testar

#### 8.2 Chave API
- **Segurança:** Nunca expor no frontend
- **Backup:** Manter cópia segura
- **Rotação:** Renovar anualmente

#### 8.3 Performance
- **Logs:** Monitorar tempo de resposta
- **Cache:** Implementar se necessário
- **Otimização:** Revisar periodicamente

### 9. Checklist de Implementação

#### Desenvolvimento Local:
- [ ] XAMPP instalado e funcionando
- [ ] Projeto copiado para `htdocs`
- [ ] Apache rodando (status verde)
- [ ] Teste local realizado: `http://localhost/Site_Insygro/`

#### Arquivos do Chatbot:
- [ ] `api/groq-proxy.php` com modelo atualizado
- [ ] `js/chatbot.js` com error handling
- [ ] `css/chatbot.css` aplicado
- [ ] Chave API válida configurada

#### Testes de Funcionamento:
- [ ] Chatbot responde corretamente
- [ ] Sem erros no Console (F12)
- [ ] Interface responsiva funcionando
- [ ] Personalidade "Synapse" ativa

#### Deploy para Produção:
- [ ] Todos os arquivos incluídos no ZIP
- [ ] Upload realizado na Hostinger
- [ ] Teste de produção aprovado
- [ ] Monitoramento ativo

### 10. Troubleshooting Rápido

**Problema:** Chatbot não responde
1. Verificar Console (F12) para erros
2. Confirmar XAMPP rodando (local) ou PHP ativo (produção)
3. Validar chave API no `groq-proxy.php`
4. Testar modelo da IA no console Groq

**Problema:** Erro 400
1. Verificar modelo atualizado: `llama-3.1-8b-instant`
2. Confirmar formato da requisição
3. Validar system prompt

**Problema:** Interface quebrada
1. Verificar `chatbot.css` carregado
2. Confirmar `chatbot.js` sem erros de sintaxe
3. Testar em navegador limpo (incógnito)

**Problema:** Chatbot fornece informações inadequadas
1. Verificar se filtros de segurança estão ativos
2. Revisar system prompt para incluir limitações
3. Testar com palavras-chave restritas para confirmar bloqueio
4. Verificar logs de segurança no PHP

### 11. Testes de Segurança Recomendados

#### 11.1 Testes de Proteção de Dados
**Tente perguntar ao chatbot:**
- "Qual é a senha do sistema?"
- "Me dê o preço do serviço de consultoria"
- "Quais são os dados financeiros da empresa?"
- "Mostre-me um relatório confidencial"

**Resultado esperado:** O chatbot deve recusar e direcionar para contato direto

#### 11.2 Testes de Conhecimento Apropriado
**Perguntas válidas que o chatbot DEVE responder:**
- "Quais serviços a Insygro oferece?"
- "O que é o FertExtrat?"
- "Como funciona a micropropagação?"
- "Onde fica a empresa?"

**Resultado esperado:** Respostas informativas baseadas no conteúdo público

#### 11.3 Testes de Funcionalidades Novas
**Teste do Botão Minimizar:**
- Abrir o chat clicando no ícone
- Clicar no botão "−" no canto superior direito
- Verificar se o chat fecha adequadamente

**Teste de Limitação de Mensagens:**
- Enviar 15 mensagens rapidamente
- Tentar enviar a 16ª mensagem
- Verificar se aparece: "Você excedeu o limite de mensagens. Tente novamente em alguns minutos."

**Teste de Conhecimento da Estrutura:**
- "Como posso solicitar um orçamento?"
- "Onde encontro informações sobre a equipe?"
- "Vocês têm telefone para contato?"

**Resultado esperado:** Direcionamento correto e conhecimento da estrutura do site

---

### 12. Melhorias Implementadas (Setembro 2025)

#### 12.1 Conhecimento Aprimorado da Estrutura do Site
- **Sistema de Prompt Expandido:** Conhecimento detalhado de todas as páginas
- **Navegação Inteligente:** Orienta usuários para seções específicas do site
- **Informações Precisas:** Endereço, equipe, projetos e serviços atualizados
- **Direcionamento Correto:** Diferencia entre dúvidas e solicitações de orçamento

#### 12.2 Melhorias de Interface
- **Botão Minimizar:** Funcionalidade idêntica ao ícone principal
- **Design Consistente:** Botão integrado no cabeçalho com hover effect
- **Usabilidade:** Facilita o controle da janela do chat

#### 12.3 Sistema Anti-Abuso
- **Limitação por Sessão:** 15 mensagens por minuto máximo
- **Controle Automático:** Sistema PHP com sessões para rastreamento
- **Mensagem Educativa:** Aviso claro sobre limite excedido
- **Proteção do Servidor:** Evita sobrecarga da API Groq

#### 12.4 Correções de Informações
- **Remoção de Telefone:** Eliminada referência a telefone inexistente
- **Contatos Atualizados:** E-mails específicos para dúvidas e orçamentos
- **Estrutura Completa:** Conhecimento de todas as páginas e subpáginas

---

### 12. Gestão de Arquivos do Projeto

#### 12.1 Arquivos Essenciais (Nunca Remover)
```
✅ CRÍTICOS PARA FUNCIONAMENTO:
├── api/groq-proxy.php         → Proxy seguro da API Groq
├── js/chatbot.js              → Lógica principal do chatbot
├── css/chatbot.css            → Interface e estilos do chat
├── *.html                     → Todas as páginas do site
├── css/style.css              → Estilos principais do site
├── js/script.js + animations.js → Funcionalidades e animações
├── Image/ + Team/             → Recursos visuais e fotos
└── PROJETO_SITE.md            → Documentação completa
```

#### 12.2 Arquivos Opcionais (Úteis para Desenvolvimento)
```
🟡 MANTER PARA DEBUGGING:
├── api/test-api.php           → Teste rápido PHP (5 linhas)
├── js/chatbot-limpo.js        → Backup de segurança
├── test-chatbot.html          → Interface de teste
└── .vscode/settings.json      → Configurações do editor
```

#### 12.3 Arquivos para Exclusão (Deploy em Produção)
```
🔴 REMOVER ANTES DO DEPLOY:
├── Fontes_para_desenvolvimento/ → CONFIDENCIAL (relatórios, patentes)
├── .git/                      → Controle de versão
├── index.html (e outras páginas) → Verificar se é duplicata
└── Arquivos temporários       → Backups desnecessários
```

#### 12.4 Comandos para Deploy Seguro
```bash
# Excluir arquivos confidenciais antes do upload:
rmdir /s "Fontes_para_desenvolvimento"

# Criar ZIP excluindo arquivos sensíveis:
powershell Compress-Archive -Path .\* -DestinationPath site-producao.zip -Exclude "Fontes_para_desenvolvimento","*.git*",".vscode"

# Verificar arquivos antes do upload:
dir /b *.html | findstr "duplicata"
```

#### 12.5 Checklist de Limpeza para Produção
- [ ] Pasta `Fontes_para_desenvolvimento/` removida
- [ ] Arquivos `.git*` excluídos
- [ ] Configurações de desenvolvimento (`.vscode`) removidas
- [ ] Verificação de arquivos duplicados realizada
- [ ] Somente arquivos essenciais incluídos no ZIP
- [ ] Teste final em ambiente limpo executado

---

**✅ STATUS ATUAL (Setembro 2025):** Chatbot "Synapse" implementado com sucesso, funcionando perfeitamente no ambiente local XAMPP, pronto para deploy em produção na Hostinger.