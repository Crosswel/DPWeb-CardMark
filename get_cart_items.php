<?php
session_start();
include 'db_connection.php';

$user_id = $_SESSION['user_id'];

$query = $conn->prepare("
    SELECT c.nome_carta, c.preco, co.quantidade 
    FROM compra co
    JOIN cartas_vg c ON co.id_vg_carta = c.id_vg_carta
    WHERE co.user_id = ?
");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);
?>
