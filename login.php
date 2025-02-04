<?php
session_start();
include 'db_connect.php';

// Verificar se o user já realizou o login
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redireciona se já estiver logado
    exit();
}

// Guardar a página de origem para voltar depois do login
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_user = $_POST['email_or_user'];
    $password = $_POST['password'];

    // Procurar user na base de dados
    $stmt = $conn->prepare("SELECT user_id, user_name, password FROM users WHERE email = ? OR user_name = ?");
    $stmt->bind_param("ss", $email_or_user, $email_or_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar senha
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];

        // Redirecionar para a página anterior ou para index.php
        header("Location: $redirect");
        exit();
    } else {
        $error = "Email/Usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="static/styles3.css"> <!-- Importação correta do CSS -->
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <img src="static/CarMark.png" alt="Logo">
            <p>Ainda não tens conta?</p>
            <a href="register.php">Cria uma conta!</a>
        </div>
        <div class="login-right">
            <h2>Login</h2>
            <form method="POST" action="login.php">
                <label>Username ou Email*</label>
                <input type="text" name="email_or_user" required>
                <label>Password*</label>
                <input type="password" name="password" required>
                <button type="submit">Iniciar Sessão</button>
            </form>
        </div>
    </div>
</body>
</html>
