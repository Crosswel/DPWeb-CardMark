<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);
$card_id = $input['card_id'];

if (!$user_id || !$card_id) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
    exit;
}

// Verificar a quantidade disponível
$query = $conn->prepare("SELECT quantidade FROM cartas_vg WHERE id_vg_carta = ?");
$query->bind_param("i", $card_id);
$query->execute();
$result = $query->get_result()->fetch_assoc();
$quantidade_disponivel = $result['quantidade'] ?? 0;

if ($quantidade_disponivel <= 0) {
    echo json_encode(['success' => false, 'message' => 'Estoque insuficiente.']);
    exit;
}

// Adicionar ao carrinho ou atualizar
$query = $conn->prepare("INSERT INTO compra (user_id, id_vg_carta, quantidade) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE quantidade = quantidade + 1");
$query->bind_param("ii", $user_id, $card_id);
$query->execute();

// Atualizar quantidade no estoque
$query = $conn->prepare("UPDATE cartas_vg SET quantidade = quantidade - 1 WHERE id_vg_carta = ?");
$query->bind_param("i", $card_id);
$query->execute();

echo json_encode(['success' => true]);
?>
