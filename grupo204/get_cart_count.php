<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

$query = $conn->prepare("SELECT SUM(quantidade) AS count FROM compra WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result()->fetch_assoc();

echo json_encode(['count' => $result['count'] ?? 0]);
?>
