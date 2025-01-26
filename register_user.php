<?php
// Configurar a conexão com o banco de dados
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'cartas';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Receber os dados do formulário
$nome = $_POST['nome'];
$telemovel = $_POST['telemovel'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografar a senha

// Preparar e executar a query
$sql = "INSERT INTO users (user_name, telemovel, email, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome, $telemovel, $email, $password);

if ($stmt->execute()) {
    // Redirecionar para a página vanguard.html após sucesso
    header("Location: login_vanguard.html");
    exit();
} else {
    echo "Erro ao registrar o utilizador: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
