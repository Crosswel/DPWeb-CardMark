<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['total' => 0]);
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT SUM(c.quantidade * cv.preco) AS total FROM compra c JOIN cartas_vg cv ON c.id_vg_carta = cv.id_vg_carta WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total = $result->fetch_assoc()['total'] ?? 0;

echo json_encode(['total' => $total]);
?>
