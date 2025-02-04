<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Verifica se o carrinho tem itens
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Seu carrinho está vazio!'); window.location.href='cart.php';</script>";
    exit();
}

$metodo_pagamento = "";
$telefone = "";
$email = "";
$compra_confirmada = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['metodo'])) {
        $metodo_pagamento = $_POST['metodo'];
        
        if ($metodo_pagamento == "MBWAY") {
            $telefone = $_POST['telefone'] ?? '';
            if (empty($telefone) || !preg_match('/^[0-9]{9}$/', $telefone)) {
                echo "<script>alert('Digite um número de telemóvel válido!');</script>";
            } else {
                $compra_confirmada = true;
            }
        }

        if ($metodo_pagamento == "PayPal") {
            $email = $_POST['email'] ?? '';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Digite um e-mail válido!');</script>";
            } else {
                $compra_confirmada = true;
            }
        }
    }

    // confirmação da compra
    if ($compra_confirmada) {
        foreach ($_SESSION['cart'] as $id_carta => $quantidade) {
            // Reduzir a quantidade na base de dados
            $stmt = $conn->prepare("UPDATE cartas SET quantidade = quantidade - ? WHERE id = ? AND quantidade >= ?");
            $stmt->bind_param("iii", $quantidade, $id_carta, $quantidade);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Registar a compra na tabela de compras
                $insertCompra = $conn->prepare("INSERT INTO compra (id_user, id_carta, quantidade) VALUES (?, ?, ?)");
                $insertCompra->bind_param("iii", $user_id, $id_carta, $quantidade);
                $insertCompra->execute();
            }
        }

        // Limpa o carrinho após a compra
        unset($_SESSION['cart']);
        echo "<script>alert('Compra realizada com sucesso!'); window.location.href='vanguard.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Compra</title>
    <link rel="stylesheet" href="static/confirmar-compra-style.css">
    <script>
        function mostrarCampo(tipo) {
            document.getElementById('campoMBWAY').style.display = tipo === 'MBWAY' ? 'block' : 'none';
            document.getElementById('campoPayPal').style.display = tipo === 'PayPal' ? 'block' : 'none';
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Confirmar a Compra</h1>
    
    <form method="POST">
    <label>
    <input type="radio" name="metodo" value="MBWAY" onclick="mostrarCampo('MBWAY')">
    <img src="static/mbwaylogo.png" alt="MB WAY" width="100">
</label>

<label>
    <input type="radio" name="metodo" value="PayPal" onclick="mostrarCampo('PayPal')">
    <img src="static/paypallogo.png" alt="PayPal" width="100">
</label>

        <div id="campoMBWAY" class="hidden">
            <label for="telefone">Número de Telemóvel:</label>
            <input type="text" name="telefone" id="telefone" placeholder="Digite o número">
        </div>

        <div id="campoPayPal" class="hidden">
            <label for="email">E-mail do PayPal:</label>
            <input type="email" name="email" id="email" placeholder="Digite o e-mail">
        </div>

        <button type="submit" class="confirm-btn">Confirmar Pagamento</button>
    </form>
</div>

</body>
</html>
