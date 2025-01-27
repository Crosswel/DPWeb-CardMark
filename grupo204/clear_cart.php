<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Remover todos os itens do carrinho
$stmt = $conn->prepare("DELETE FROM compra WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

echo json_encode(['success' => true]);
?>
