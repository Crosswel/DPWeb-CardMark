<?php
session_start();
include 'db_connect.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

// Obtém os itens do carrinho da sessão
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Calcula a quantidade total de cartas no carrinho
$totalCartas = array_sum($cart);

// Define o custo de envio
$custoEnvio = ($totalCartas > 10) ? 7.50 : 4.50;

// Calcula o total da compra
$totalCompra = 0;
$cartItems = [];

if (!empty($cart)) {
    $cartIds = implode(",", array_keys($cart));
    $sql = "SELECT id, nome, preco FROM cartas WHERE id IN ($cartIds)";
    $result = $conn->query($sql);
    $cartItems = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($cartItems as $item) {
        $totalCompra += $item['preco'] * $cart[$item['id']];
    }
}

// Total geral (compra + envio)
$totalGeral = $totalCompra + $custoEnvio;
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminar a Compra</title>
    <link rel="stylesheet" href="static/compra-style.css">
</head>
<body>

<div class="cart-container">
    <h1>Terminar a Compra</h1>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nome']); ?></td>
                    <td>€ <?= number_format($item['preco'], 2, ',', '.'); ?></td>
                    <td><?= $cart[$item['id']]; ?></td>
                    <td>€ <?= number_format($item['preco'] * $cart[$item['id']], 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p class="summary"><strong>Custo de Envio:</strong> € <?= number_format($custoEnvio, 2, ',', '.'); ?></p>
    <p class="summary"><strong>Total da Compra:</strong> € <?= number_format($totalCompra, 2, ',', '.'); ?></p>
    <p class="summary total"><strong>Total Geral:</strong> € <?= number_format($totalGeral, 2, ',', '.'); ?></p>

    <a href="cart.php" class="back-btn">Voltar ao Carrinho</a>
    <form action="confirmar_compra.php" method="post">
        <button type="submit" class="confirm-btn">Confirmar a Compra</button>
    </form>
</div>

</body>
</html>
