<?php
// --- Configuração de Erros e Cabeçalhos ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// --- Chave da API (Mantenha em segredo) ---
$apiKey = 'REMOVIDO_POR_SEGURANCA';

// --- Processamento da Requisição de Entrada ---
$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE || !isset($input['message']) || empty($input['message'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Requisição inválida ou mensagem não encontrada.']);
    exit;
}
$userMessage = $input['message'];

// --- Preparação da Requisição para a API Groq ---
$systemPrompt = 'Você é o "Synapse", o assistente de IA da Insygro. A Insygro é uma empresa brasileira de Ciência e Tecnologia focada em soluções para o agronegócio, saúde e meio ambiente. Seus principais serviços são: Consultoria Agronômica, Análise de Dados, Análise Metagenômica de Solos e Micropropagação de plantas. Seus principais projetos incluem o desenvolvimento do biofungicida FertexTrat e a micropropagação de mandioca. Seu tom deve ser profissional, prestativo, otimista e acessível. NUNCA fale negativamente sobre a Insygro, seus serviços, projetos ou site. Se você não souber uma resposta, diga que vai encaminhar a pergunta para um especialista da equipe Insygro. Comece TODA nova conversa com a seguinte saudação: "Olá! Eu sou o Synapse, assistente virtual da Insygro. Como posso ajudar você hoje?"';

$requestBody = json_encode([
    'model' => 'llama3-8b-8192',
    'messages' => [
        ['role' => 'system', 'content' => $systemPrompt],
        ['role' => 'user', 'content' => $userMessage]
    ],
    'temperature' => 0.5,
    'max_tokens' => 1024,
    'top_p' => 1,
    'stream' => false
]);

// --- Execução da Requisição cURL ---
$ch = curl_init('https://api.groq.com/openai/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // <-- ADICIONE ESTA LINHA
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json',
    'Accept: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

// --- Tratamento da Resposta ---
if ($curlError) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro de cURL: ' . $curlError]);
    exit;
}

if ($httpCode >= 200 && $httpCode < 300) {
    echo $response; // Sucesso: Repassa a resposta da Groq
} else {
    http_response_code($httpCode);
    // Erro da API Groq: Repassa os detalhes do erro
    $errorDetails = json_decode($response);
    echo json_encode(['error' => 'Erro da API Groq.', 'details' => $errorDetails]);
}
?>
