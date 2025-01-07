<?php
$servername = "localhost";
$username = "root";
$password = ""; // Senha padrão no Laragon
$dbname = "cartasdb";

try {
    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta para buscar os 3 primeiros Pokémon (ID 1, 2 e 3)
    $sql = "SELECT id, nome, caminho_imagem FROM pokemon WHERE id IN (1, 2, 3)";
    $result = $conn->query($sql);

    $pokemons = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pokemons[] = $row;
        }
    }

    // Retornar os dados como JSON
    header('Content-Type: application/json');
    echo json_encode($pokemons);

    // Fechar a conexão
    $conn->close();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
