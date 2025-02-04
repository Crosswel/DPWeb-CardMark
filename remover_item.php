<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_carta'])) {
    $id_carta = $_POST['id_carta'];

    if (isset($_SESSION['cart'][$id_carta])) {
        unset($_SESSION['cart'][$id_carta]); // Remove a carta do carrinho
    }
}

header("Location: cart.php");
exit();
?>
