<?php
// Arquivo de teste para verificar a configuração da API
echo "<h1>Teste da Configuração da API Groq</h1>";

// Teste 1: Verificar variável de ambiente
echo "<h2>1. Variável de Ambiente (.htaccess):</h2>";
$envKey = getenv('GROQ_API_KEY');
echo "GROQ_API_KEY do .htaccess: " . (empty($envKey) ? "<span style='color:red'>NÃO ENCONTRADA</span>" : "<span style='color:green'>ENCONTRADA</span>") . "<br>";

// Teste 2: Verificar arquivo config.php
echo "<h2>2. Arquivo config.php:</h2>";
if (file_exists('config.php')) {
    echo "Arquivo config.php: <span style='color:green'>ENCONTRADO</span><br>";
    require_once 'config.php';
    echo "GROQ_API_KEY do config.php: " . (defined('GROQ_API_KEY') ? "<span style='color:green'>DEFINIDA</span>" : "<span style='color:red'>NÃO DEFINIDA</span>") . "<br>";
} else {
    echo "Arquivo config.php: <span style='color:red'>NÃO ENCONTRADO</span><br>";
}

// Teste 3: Verificar chave final
echo "<h2>3. Chave Final Selecionada:</h2>";
$apiKey = getenv('GROQ_API_KEY');
if (empty($apiKey) && file_exists('config.php')) {
    require_once 'config.php';
    if (defined('GROQ_API_KEY')) {
        $apiKey = GROQ_API_KEY;
    }
}
if (empty($apiKey)) {
    $apiKey = 'CHAVE_NAO_CONFIGURADA_PARA_TESTE'; // Placeholder seguro
}

echo "Chave final: " . (empty($apiKey) ? "<span style='color:red'>VAZIA</span>" : "<span style='color:green'>CONFIGURADA (" . substr($apiKey, 0, 10) . "...)</span>") . "<br>";

// Teste 4: Verificar cURL
echo "<h2>4. Teste cURL:</h2>";
if (function_exists('curl_version')) {
    echo "cURL: <span style='color:green'>DISPONÍVEL</span><br>";
    $version = curl_version();
    echo "Versão: " . $version['version'] . "<br>";
} else {
    echo "cURL: <span style='color:red'>NÃO DISPONÍVEL</span><br>";
}

// Teste 5: Verificar conectividade com Groq (se chave configurada)
echo "<h2>5. Teste de Conectividade com Groq:</h2>";
if (!empty($apiKey) && $apiKey !== 'CHAVE_NAO_CONFIGURADA_PARA_TESTE' && $apiKey !== 'SUA_CHAVE_GROQ_REAL_AQUI') {
    $ch = curl_init('https://api.groq.com/openai/v1/models');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        echo "Conectividade: <span style='color:green'>OK</span><br>";
    } else {
        echo "Conectividade: <span style='color:red'>ERRO (HTTP $httpCode)</span><br>";
    }
} else {
    echo "Conectividade: <span style='color:orange'>PENDENTE (configure chave real)</span><br>";
}

echo "<hr>";
echo "<p><strong>Instruções:</strong></p>";
echo "<ul>";
echo "<li>Configure GROQ_API_KEY no .htaccess ou config.php</li>";
echo "<li>Teste novamente após configurar</li>";
echo "<li>Verifique se o Apache tem permissão para ler variáveis de ambiente</li>";
echo "</ul>";
?>