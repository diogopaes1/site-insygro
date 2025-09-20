<?php
// Arquivo de configuração seguro para chaves da API
// ⚠️  ESTE ARQUIVO NÃO DEVE SER COMMITADO NO GIT
// Configure suas chaves reais apenas localmente

// Chave da API Groq - CONFIGURE SUA CHAVE REAL AQUI
define('GROQ_API_KEY', 'SUA_CHAVE_GROQ_REAL_AQUI');

// Chave do Formspree - CONFIGURE SUA CHAVE REAL AQUI
define('FORMSPREE_KEY', 'SUA_CHAVE_FORMSPREE_REAL_AQUI');

// Verificar se as chaves foram definidas corretamente
if (!defined('GROQ_API_KEY') || empty(GROQ_API_KEY) || GROQ_API_KEY === 'SUA_CHAVE_GROQ_REAL_AQUI') {
    die('Erro: Chave da API Groq não configurada. Configure uma chave real no arquivo config.php');
}

if (!defined('FORMSPREE_KEY') || empty(FORMSPREE_KEY) || FORMSPREE_KEY === 'SUA_CHAVE_FORMSPREE_REAL_AQUI') {
    die('Erro: Chave do Formspree não configurada. Configure uma chave real no arquivo config.php');
}
?>