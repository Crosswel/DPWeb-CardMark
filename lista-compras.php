<?php
session_start();
include 'db_connect.php';

// Verifica se o user fez o login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// procura as compras do user
$sql = "SELECT c.id_compra, ca.nome, ca.box_set, ca.preco, c.quantidade, c.estado
        FROM compra c
        JOIN cartas ca ON c.id_carta = ca.id
        WHERE c.id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$compras = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Compras</title>
    <link rel="stylesheet" href="static/lista-compras-style.css">
</head>
<body>

<div class="container">
    <h2>Minhas Compras</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Box Set</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($compras) > 0): ?>
                <?php foreach ($compras as $compra): ?>
                    <tr>
                        <td><?= htmlspecialchars($compra['nome']); ?></td>
                        <td><?= htmlspecialchars($compra['box_set']); ?></td>
                        <td>€<?= number_format($compra['preco'], 2, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($compra['quantidade']); ?></td>
                        <td>
                            <?= $compra['estado'] == 'Enviado' ? 'Enviado' : 'Pendente'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhuma compra encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="conta.php" class="btn-voltar">Voltar</a>
</div>

</body>
</html>
