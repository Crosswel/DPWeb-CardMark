<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Verificar se já existe email, username ou telemóvel
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR user_name = ? OR telemovel = ?");
    $stmt->bind_param("sss", $email, $name, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Erro: Email, nome ou telefone já em uso!";
    } else {
        // Inserir no banco de dados
        $stmt = $conn->prepare("INSERT INTO users (user_name, email, password, telemovel) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $phone);
        if ($stmt->execute()) {
            header("Location: login.php"); // Redireciona para login
            exit();
        } else {
            $error = "Erro ao registrar. Tente novamente!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo</title>
    <link rel="stylesheet" href="static/styles4.css"> <!-- Importação correta do CSS -->
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <img src="static/CarMark.png" alt="Logo">
            <p>Já tem uma conta?</p>
            <a href="login.php">Iniciar Sessão</a>
        </div>
        <div class="register-right">
            <h2>Registo</h2>
            <form method="POST" action="register.php">
                <label>Nome*</label>
                <input type="text" name="name" required>
                <label>Telemóvel*</label>
                <input type="text" name="phone" required>
                <label>Email*</label>
                <input type="email" name="email" required>
                <label>Password*</label>
                <input type="password" name="password" required>
                <button type="submit">Confirmar</button>
            </form>
        </div>
    </div>
</body>
</html>
