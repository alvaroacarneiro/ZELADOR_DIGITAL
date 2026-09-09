<?php
// api/webhook.php - Endpoint para receber notificações do GitHub
header('Content-Type: application/json');

// Chave secreta para validar o webhook (defina no GitHub)
$SECRET_KEY = 'seu_secret_key_aqui'; // Configure no GitHub

// Verificar assinatura
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$payload = file_get_contents('php://input');

if ($signature) {
    $computed = 'sha256=' . hash_hmac('sha256', $payload, $SECRET_KEY);
    if (!hash_equals($computed, $signature)) {
        http_response_code(403);
        echo json_encode(['status' => 403, 'mensagem' => 'Assinatura inválida']);
        exit;
    }
}

$data = json_decode($payload, true);

if ($data && isset($data['ref'])) {
    $branch = str_replace('refs/heads/', '', $data['ref']);
    $commits = $data['commits'] ?? [];
    
    // Registrar que houve atualização
    require_once __DIR__ . '/../includes/config.php';
    
    $stmt = $pdo->prepare("
        UPDATE controle_versao 
        SET atualizacao_disponivel = 1,
            ultima_versao = ?
        ORDER BY id DESC LIMIT 1
    ");
    $stmt->execute([substr($data['after'] ?? '', 0, 7)]);
    
    echo json_encode([
        'status' => 200,
        'mensagem' => 'Webhook processado com sucesso',
        'branch' => $branch,
        'commits' => count($commits)
    ]);
} else {
    http_response_code(400);
    echo json_encode(['status' => 400, 'mensagem' => 'Payload inválido']);
}
?>
