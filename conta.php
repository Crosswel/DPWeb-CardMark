<?php
session_start();
require 'db_connect.php'; // Conexão à base de dados

// Verifica qual é o user que realizou o login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Obtém o ID do user da sessão
$user_id = $_SESSION['user_id'];

// Procurar as informações do user na base de dados
$stmt = $conn->prepare("SELECT email, user_name, morada, telemovel, role FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Erro: Usuário não encontrado.";
    exit();
}

$user = $result->fetch_assoc();
$email = $user['email'];
$name = $user['user_name'];
$address = $user['morada'];
$phone = $user['telemovel'];
$role = $user['role']; // 0 = Cliente | 1 = Administrador

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>

    <link rel="stylesheet" href="static/account-style.css">
</head>
<body>

<div class="sidebar">
    <a href="vanguard.php"><img src="static/vg_new_logo.png" alt="Vanguard"></a>
    <a href="pokemon.php"><img src="static/pokemon-logo.png" alt="Pokémon"></a>
    <a href="yugioh.php"><img src="static/yugi.png" alt="Yu-Gi-Oh"></a>
    
    <?php if ($role == 0): ?>
        <a href="lista-compras.php">Minhas Compras</a>
    <?php else: ?>
        <a href="stock.php">Stock</a>
        <a href="visualizar-pedidos.php">Visualizar Pedidos</a>
    <?php endif; ?>
</div>

<div class="container">
    <div class="account-box">
        <h2> <i class="fas fa-user"></i> Minha Conta </h2>

        <form action="update_account.php" method="POST">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label>Nome:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

            <label>Endereço:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

            <label>Telefone:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>

            <button type="submit" class="update-btn">Atualizar Informações</button>
        </form>

        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Sair</button>
        </form>
    </div>
</div>

</body>
</html>
