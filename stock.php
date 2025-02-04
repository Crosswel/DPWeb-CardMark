<?php
require_once('db_connect.php');

if (!isset($pdo)) {
    die("Erro: Conexão com o banco de dados não foi estabelecida.");
}

// Remove a carta
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM cartas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: stock.php");
    exit();
}

// Adicionar nova carta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $nome = $_POST['nome'];
    $box_set = $_POST['box_set'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $jogo = $_POST['jogo'];
    $imagem = "";

    // Upload de imagem
    if (!empty($_FILES["imagem"]["name"])) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
        $imagem = $target_file;
    }

    // Inserir na base de dados
    $sql = "INSERT INTO cartas (nome, box_set, preco, imagem, quantidade, jogo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $box_set, $preco, $imagem, $quantidade, $jogo]);

    header("Location: stock.php");
    exit();
}

// Aumentar a quantidade
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['increase'])) {
    $id = intval($_POST['id']);
    $sql = "UPDATE cartas SET quantidade = quantidade + 1 WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    header("Location: stock.php");
    exit();
}

// Diminuir a quantidade (evitar valores negativos)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['decrease'])) {
    $id = intval($_POST['id']);

    // Verifica a quantidade atual antes de diminuir
    $sql = "SELECT quantidade FROM cartas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $quantidade_atual = $stmt->fetchColumn();

    if ($quantidade_atual > 0) {
        $sql = "UPDATE cartas SET quantidade = quantidade - 1 WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    header("Location: stock.php");
    exit();
}

// Procurar todas as cartas
$sql = "SELECT * FROM cartas ORDER BY id DESC";
$stmt = $pdo->query($sql);
$cartas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Stock</title>
    <link rel="stylesheet" href="static/stock-style.css">
</head>
<body>

    <div class="container">
        <button onclick="window.history.back();" class="btn-voltar">Voltar</button>

        <h2>Gerir o Stock</h2>

        <!-- Formulário para adicionar cartas -->
        <form action="stock.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome da Carta" required>
            <input type="text" name="box_set" placeholder="Box Set" required>
            <input type="number" name="preco" placeholder="Preço (€)" step="0.01" required>
            <input type="number" name="quantidade" placeholder="Quantidade" required>
            <input type="text" name="jogo" placeholder="Jogo" required>
            <input type="file" name="imagem" accept="image/*">
            <button type="submit" name="add">Adicionar Carta</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Box Set</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Jogo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartas as $carta): ?>
                    <tr>
                        <td><?= $carta['id'] ?></td>
                        <td><img src="<?= $carta['imagem'] ?>" alt="Imagem da carta"></td>
                        <td><?= htmlspecialchars($carta['nome']) ?></td>
                        <td><?= htmlspecialchars($carta['box_set']) ?></td>
                        <td>€<?= number_format($carta['preco'], 2, ',', '.') ?></td>
                        <td class="quantidade-form">
                            <form action="stock.php" method="POST">
                                <input type="hidden" name="id" value="<?= $carta['id'] ?>">
                                <button type="submit" name="decrease">➖</button>
                            </form>
                            <?= $carta['quantidade'] ?>
                            <form action="stock.php" method="POST">
                                <input type="hidden" name="id" value="<?= $carta['id'] ?>">
                                <button type="submit" name="increase">➕</button>
                            </form>
                        </td>
                        <td><?= htmlspecialchars($carta['jogo']) ?></td>
                        <td><a href="stock.php?delete=<?= $carta['id'] ?>" class="remove-btn">Remover</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
