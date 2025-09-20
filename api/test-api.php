<?php
header('Content-Type: application/json');
echo json_encode(['message' => 'PHP está funcionando!', 'timestamp' => date('Y-m-d H:i:s')]);
?>
