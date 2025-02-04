<?php
require_once('db_connect.php');

if (!isset($pdo)) {
    die("Erro: Conexão com o banco de dados não foi estabelecida.");
}

// Atualizar estado do pedido para "Enviado"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_estado'])) {
    $id_compra = intval($_POST['id_compra']);
    $sql = "UPDATE compra SET estado = 'Enviado' WHERE id_compra = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_compra]);
    header("Location: visualizar-pedidos.php");
    exit();
}

// Procurar todas as compras agrupadas por id_compra
$sql = "SELECT compra.id_compra, compra.id_user, users.user_name AS nome_user, 
               compra.id_carta, cartas.nome AS nome_carta, cartas.imagem, compra.quantidade, compra.estado
        FROM compra
        JOIN users ON compra.id_user = users.user_id
        JOIN cartas ON compra.id_carta = cartas.id
        ORDER BY compra.id_compra DESC";

$stmt = $pdo->query($sql);
$compras = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras dos Clientes</title>
    <link rel="stylesheet" href="static/visualizar-pedidos.css">
</head>
<body>

    <div class="wrapper">
        <div class="container">
            <h2>Compras dos Clientes</h2>

            <?php
            $ultimo_id_compra = null;
            foreach ($compras as $compra):
                if ($ultimo_id_compra !== $compra['id_compra']): 
                    if ($ultimo_id_compra !== null): ?>
                        </tbody>
                        </table>
                    <?php endif; ?>

                    <div class="compra-box">
                        <h3>Pedido #<?= $compra['id_compra'] ?> - Cliente: <?= htmlspecialchars($compra['nome_user']) ?></h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php 
                endif; 
                ?>

                <tr>
                    <td><img src="<?= htmlspecialchars($compra['imagem']) ?>" alt="<?= htmlspecialchars($compra['nome_carta']) ?>"></td>
                    <td><?= htmlspecialchars($compra['nome_carta']) ?></td>
                    <td><?= $compra['quantidade'] ?></td>
                    <td>
                        <form action="visualizar-pedidos.php" method="POST">
                            <input type="hidden" name="id_compra" value="<?= $compra['id_compra'] ?>">
                            <select name="update_estado" onchange="this.form.submit()">
                                <option value="Pendente" <?= $compra['estado'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                                <option value="Enviado" <?= $compra['estado'] == 'Enviado' ? 'selected' : '' ?>>Enviado</option>
                            </select>
                        </form>
                    </td>
                </tr>

            <?php 
            $ultimo_id_compra = $compra['id_compra'];
            endforeach; 
            ?>

            </tbody>
            </table>

            <button onclick="window.history.back();" class="btn-voltar">Voltar</button>
        </div>
    </div>

</body>
</html>
