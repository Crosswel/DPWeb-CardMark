<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Usuário não logado.";
    exit;
}

if (!isset($_POST['id_carta'])) {
    echo json_encode(["success" => false, "message" => "ID inválido"]);
    exit;
}

$id_carta = $_POST['id_carta'];

// Se o carrinho ainda não existe, cria um
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Adiciona +1 no contador da carta específica
if (isset($_SESSION['cart'][$id_carta])) {
    $_SESSION['cart'][$id_carta]++;
} else {
    $_SESSION['cart'][$id_carta] = 1;
}

// Calcula o total de itens no carrinho
$totalItems = array_sum($_SESSION['cart']);

// Retorna resposta JSON
echo json_encode(["success" => true, "cart_count" => $totalItems]);
?>