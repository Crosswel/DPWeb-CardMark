<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include 'db_connect.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT user_name, email, telemovel, morada FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['user_name'];
    $email = $row['email'];
    $phone = $row['telemovel'];
    $address = $row['morada'];
} else {
    $name = $email = $phone = $address = "N/A";
}

$stmt->close();
$conn->close();
?>



