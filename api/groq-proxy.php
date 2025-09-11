<?php
// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Substitua 'SUA_CHAVE_API_GROQ' pela sua chave de API real.
// IMPORTANTE: Mantenha esta chave em segredo e nunca a exponha no lado do cliente (JavaScript, HTML).
$apiKey = 'REMOVIDO_POR_SEGURANCA';

// Pega os dados enviados pelo JavaScript
$jsonPayload = file_get_contents('php://input');
$data = json_decode($jsonPayload, true);

// Verifica se a mensagem do usuário foi recebida
if (!isset($data['message']) || empty($data['message'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Nenhuma mensagem recebida.']);
    exit;
}

$userMessage = $data['message'];

// URL da API Groq
$groqApiUrl = 'https://api.groq.com/openai/v1/chat/completions';

// Dados para enviar à API Groq
$requestData = [
    'model' => 'mixtral-8x7b-32768',
    'messages' => [
        [
            'role' => 'system',
            'content' => 'Você é o assistente virtual da Insygro, uma empresa de biotecnologia e consultoria agrícola. Seu nome é Syn. Responda em português do Brasil. Seja amigável, prestativo e um pouco informal. Use emojis para deixar a conversa mais leve. Apresente-se na primeira mensagem. Foque em responder perguntas sobre a Insygro, seus serviços (consultoria em agronomia, análise de dados, metagenômica, micropropagação) e produtos (FertexTrat). Se não souber a resposta, diga que vai consultar um especialista.'
        ],
        [
            'role' => 'user',
            'content' => $userMessage
        ]
    ]
];

// Configuração da requisição cURL
$ch = curl_init($groqApiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
]);

// Executa a requisição e obtém a resposta
$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Fecha a sessão cURL
curl_close($ch);

// Verifica se a requisição para a Groq foi bem-sucedida
if ($httpcode >= 200 && $httpcode < 300) {
    // Repassa a resposta da Groq para o frontend
    echo $response;
} else {
    // Informa ao frontend que houve um erro
    http_response_code($httpcode);
    echo json_encode([
        'error' => 'Erro ao contatar a API da Groq.',
        'details' => json_decode($response)
    ]);
}
?>
