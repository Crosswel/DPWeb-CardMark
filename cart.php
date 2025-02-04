<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remover uma unidade da carta
if (isset($_POST['remove_one'])) {
    $id = $_POST['remove_one'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]--;
        if ($_SESSION['cart'][$id] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: cart.php");
    exit();
}

// Remover cartas
if (isset($_POST['remove'])) {
    $id = $_POST['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit();
}

// Esvazia o carrinho
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit();
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="static/cart-style.css">
</head>
<body>

<div class="cart-container">
    <h1>Carrinho de Compras</h1>
    <table>
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Box Set</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Remover</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $stmt = $conn->prepare("SELECT nome, box_set, preco, imagem FROM cartas WHERE id = ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $carta = $result->fetch_assoc();
                    
                    if ($carta) {
                        $subtotal = $carta['preco'] * $qty;
                        $total += $subtotal;
                        ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($carta['imagem']) ?>" class="cart-img"></td>
                            <td><?= htmlspecialchars($carta['nome']) ?></td>
                            <td><?= htmlspecialchars($carta['box_set']) ?></td>
                            <td>€ <?= number_format($carta['preco'], 2, ',', '.') ?></td>
                            <td><?= $qty ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <button type="submit" name="remove_one" value="<?= $id ?>" class="remove-one-btn">➖</button>
                                </form>
                                <form method="POST" style="display: inline;">
                                    <button type="submit" name="remove" value="<?= $id ?>" class="remove-btn">Remover</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
            } else {
                echo "<tr><td colspan='6'>Seu carrinho está vazio.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <p class="summary"><strong>Total da Compra: € <?= number_format($total, 2, ',', '.') ?></strong></p>

    <a href="vanguard.php" class="back-btn"> Continuar a comprar</a>

    <?php if ($total > 0): ?>
        <a href="compra.php" class="checkout-btn">Terminar a Compra</a>
        <form method="POST" style="display: inline;">
            <button type="submit" name="clear_cart" class="clear-btn">Esvaziar Carrinho</button>
        </form>
    <?php endif; ?>

</div>

</body>
</html>
