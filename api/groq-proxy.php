<?php
// --- Configuração de Headers e CORS (Restrito ao Domínio do Site) ---
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://insygro.com.br'); // Domínio real configurado
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Accept');

// --- Tratamento de OPTIONS (CORS Preflight) ---
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// --- Chave da API (Segura via Variável de Ambiente) ---
$apiKey = getenv('GROQ_API_KEY') ?: 'CHAVE_NAO_CONFIGURADA';

// --- Log para debug ---
error_log("Recebendo requisição para chatbot...");

// --- Processamento da Requisição ---
$input = json_decode(file_get_contents('php://input'), true);
error_log("Input recebido: " . print_r($input, true));

if (!$input || !isset($input['message']) || empty(trim($input['message']))) {
    error_log("Erro: Mensagem vazia ou não fornecida");
    http_response_code(400);
    echo json_encode(['error' => 'Mensagem não fornecida ou vazia']);
    exit;
}

$userMessage = trim($input['message']);
error_log("Mensagem do usuário: " . $userMessage);

// --- SISTEMA DE LIMITAÇÃO DE MENSAGENS ---
session_start();
$currentTime = time();
$timeWindow = 60; // 1 minuto
$maxMessages = 15; // máximo 15 mensagens por minuto

// Inicializar array de mensagens se não existir
if (!isset($_SESSION['message_times'])) {
    $_SESSION['message_times'] = [];
}

// Remover mensagens antigas (fora da janela de tempo)
$_SESSION['message_times'] = array_filter($_SESSION['message_times'], function($time) use ($currentTime, $timeWindow) {
    return ($currentTime - $time) < $timeWindow;
});

// Verificar se excedeu o limite
if (count($_SESSION['message_times']) >= $maxMessages) {
    error_log("Limite de mensagens excedido. IP: " . $_SERVER['REMOTE_ADDR']);
    http_response_code(429);
    echo json_encode([
        'error' => 'Limite excedido',
        'message' => 'Você excedeu o limite de mensagens. Tente novamente em alguns minutos.'
    ]);
    exit;
}

// Adicionar timestamp da mensagem atual
$_SESSION['message_times'][] = $currentTime;

// --- FILTROS DE SEGURANÇA ---
$blockedKeywords = [
    'senha', 'password', 'chave api', 'api key', 'token', 'login',
    'relatório confidencial', 'documento interno', 'financeiro', 'preço',
    'valor', 'custo', 'orçamento específico', 'contrato', 'propriedade intelectual',
    'dados pessoais', 'cliente específico', 'processo interno', 'metodologia proprietária'
];

$messageWords = strtolower($userMessage);
foreach ($blockedKeywords as $keyword) {
    if (strpos($messageWords, strtolower($keyword)) !== false) {
        error_log("Tentativa de acesso a informação restrita detectada: " . $keyword);
        http_response_code(200);
        echo json_encode([
            'message' => 'Desculpe, não posso fornecer esse tipo de informação. Para questões específicas sobre valores, contratos ou detalhes técnicos confidenciais, entre em contato diretamente conosco através do formulário do site ou pelo e-mail. Posso ajudá-lo com informações gerais sobre nossos serviços públicos.'
        ]);
        exit;
    }
}

// --- Configuração da Requisição para Groq ---
$requestData = [
    'model' => 'llama-3.1-8b-instant', // MODELO ATUALIZADO
    'messages' => [
        [
            'role' => 'system',
            'content' => 'Você é o "Synapse", assistente virtual da Insygro Ciência e Tecnologia. 

SOBRE A EMPRESA:
A Insygro é uma empresa brasileira de Ciência e Tecnologia localizada em Garanhuns-PE (Rua São Miguel, 211, Boa Vista - CEP: 55292-640) que atua no agronegócio, saúde e meio ambiente.

ESTRUTURA DO SITE E NAVEGAÇÃO:
1. **Página Inicial (index.html)**: Apresentação da empresa, visão geral dos serviços, estatísticas (+30 projetos, +30 clientes, +10 anos experiência)
2. **Serviços (servicos.html)**: Portal principal dos serviços com 4 áreas principais
3. **Sobre Nós (sobre.html)**: História, missão, visão, valores e equipe da empresa
4. **Projetos (projetos.html)**: Portfólio e cases de sucesso
5. **Contato (contato.html)**: Formulário para dúvidas e orçamentos

SERVIÇOS DETALHADOS:
1. **Consultoria Agronômica** (servico-agronomia.html): Análises de solo, indicadores bioquímicos, manejo, agricultura de precisão e análise geoespacial com sensoriamento remoto (NDVI, etc.).
2. **Análise de Dados** (servico-analise-dados.html): Consultoria estatística, Machine Learning, Big Data, visualização de dados
3. **Análise Metagenômica** (servico-metagenomica.html): Bioinformática, dados ômicos, mapeamento da biodiversidade microbiana de solos
4. **Micropropagação** (servico-micropropagacao.html): Produção in vitro de mudas de alta qualidade genética
5. **P&D em Controle Biológico** (servico-pd-biologico.html): Desenvolvimento de novos bioinsumos e soluções sustentáveis

PROJETOS DESTACADOS:
- **FertExtrat** (FertExtrat.html): Bioestimulante organomineral com extratos da Caatinga (produto patenteado)
- **Micropropagação de Mandioca** (micropropagacao-mandioca.html): Produção de mudas livres de patógenos

EQUIPE PRINCIPAL:
- Sarah Jane Alexandre Medeiros: Fitopatologia, Controle Biológico
- Diogo Paes da Costa: Solos, Nutrição de Plantas, Metagenômica, Machine Learning
- Helio Henrique Franco: Colaborador

INFORMAÇÕES DE CONTATO:
- **Endereço**: Rua São Miguel, 211, Boa Vista – Garanhuns, PE - CEP: 55292-640
- **Formulário de Contato**: Disponível na página "Contato" do site
- **E-mails**: duvidas@insygro.com.br (dúvidas) / orcamento@insygro.com.br (orçamentos)
- **Página de Contato**: Possui formulário condicional para dúvidas ou orçamentos

DIRETRIZES DE ATENDIMENTO:
- Para ORÇAMENTOS: Direcione para o formulário de contato e selecionar "Orçamento"
- Para DÚVIDAS GERAIS: Direcione para o formulário e selecionar "Dúvidas"
- Para informações TÉCNICAS DETALHADAS: Direcione para contato direto
- NÃO forneça números de telefone (não disponível publicamente)
- NÃO divulgue informações financeiras, metodologias proprietárias ou dados confidenciais

COMPORTAMENTO:
Seja profissional, prestativo e direto. Demonstre conhecimento da estrutura do site. Responda sempre em português brasileiro. Direcione adequadamente conforme a necessidade do usuário.'
        ],
        [
            'role' => 'user',
            'content' => $userMessage
        ]
    ],
    'temperature' => 0.7,
    'max_tokens' => 1000,
    'stream' => false
];

error_log("Dados para enviar à Groq: " . json_encode($requestData));

// --- Execução da Requisição cURL ---
$ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($requestData),
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
        'Accept: application/json'
    ],
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => false, // Para evitar problemas de SSL no localhost
    CURLOPT_USERAGENT => 'Insygro-Chatbot/1.0'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

error_log("Resposta da Groq - HTTP Code: " . $httpCode);
error_log("Resposta da Groq - Conteúdo: " . $response);

// --- Tratamento da Resposta ---
if ($curlError) {
    error_log("Erro cURL: " . $curlError);
    http_response_code(500);
    echo json_encode(['error' => 'Erro de conexão: ' . $curlError]);
    exit;
}

if ($httpCode >= 200 && $httpCode < 300) {
    $responseData = json_decode($response, true);
    if ($responseData && isset($responseData['choices'][0]['message']['content'])) {
        error_log("Sucesso! Resposta enviada ao cliente.");
        echo json_encode([
            'success' => true,
            'choices' => $responseData['choices']
        ]);
    } else {
        error_log("Formato de resposta inesperado da Groq");
        echo $response; // Fallback: retorna resposta original
    }
} else {
    error_log("Erro HTTP da Groq: " . $httpCode . " - " . $response);
    http_response_code(400); // Mantém o código 400 para indicar erro da API
    echo json_encode([
        'error' => 'Erro da API Groq', 
        'code' => $httpCode,
        'details' => $response
    ]);
}
?>
