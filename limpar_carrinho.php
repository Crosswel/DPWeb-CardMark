<?php
session_start();
unset($_SESSION['cart']); // Remove todas as cartas do carrinho
header("Location: cart.php");
exit();
?>
