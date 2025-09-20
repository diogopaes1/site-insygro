<?php
header('Content-Type: application/json');

$sliderDir = '../Slider/';
$images = [];

// Verifica se o diretório existe
if (is_dir($sliderDir)) {
    // Escaneia o diretório em busca de arquivos
    $files = scandir($sliderDir);
    
    foreach ($files as $file) {
        // Pega a extensão do arquivo em minúsculas
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        
        // Adiciona à lista apenas se for uma imagem válida
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            // Adiciona o caminho relativo correto para uso no HTML/CSS
            $images[] = 'Slider/' . $file;
        }
    }
}

// Retorna a lista de imagens como um JSON
echo json_encode($images);
?>
