<?php
session_start();
session_unset(); // Remove todas as variáveis da sessão
session_destroy(); // Destrói a sessão

// Redireciona para a página inicial (index.php)
header("Location: index.php");
exit();
?>
