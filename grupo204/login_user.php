<?php
// configuração da base de dados
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'cartas';

$conn = new mysqli($host, $user, $password, $dbname);

// verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// devolve os dados
$username_or_email = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// prepara e executa o SQL entry
$sql = "SELECT * FROM users WHERE user_name = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username_or_email, $username_or_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verifica a password
    if (password_verify($password, $user['password'])) {
        // Redireciona para a página
        header("Location: login_vanguard.html");
        exit();
    } else {
        // Password incorreta
        echo "<script>alert('Password incorreta. Por favor, tente novamente.'); window.history.back();</script>";
    }
} else {
    // Username ou email não encontrado
    echo "<script>alert('Conta não encontrada. Verifique o username ou email.'); window.history.back();</script>";
}

// Acabar a conexão
$conn->close();
?>
