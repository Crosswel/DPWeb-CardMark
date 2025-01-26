<?php
// Database connection configuration
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'cartas';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve input data
$username_or_email = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare and execute SQL query
$sql = "SELECT * FROM users WHERE user_name = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username_or_email, $username_or_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $user['password'])) {
        // Redirect to the login_vanguard.html page
        header("Location: login_vanguard.html");
        exit();
    } else {
        // Password is incorrect
        echo "<script>alert('Password incorreta. Por favor, tente novamente.'); window.history.back();</script>";
    }
} else {
    // Username or email not found
    echo "<script>alert('Conta não encontrada. Verifique o username ou email.'); window.history.back();</script>";
}

// Close the connection
$conn->close();
?>
