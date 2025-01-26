<?php
// Configurações com a base de dados
$host = '127.0.0.1'; // Pode usar 'localhost' se preferir
$user = 'root'; // Substitua pelo seu user MySQL
$password = ''; // Substitua pela sua senha MySQL (geralmente vazia no Laragon)
$dbname = 'cartas'; // Certifique-se de que este é o nome correto do seu base de dados

// Conectar a base de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Executar a consulta
$sql = "SELECT id_pk_carta, box_set, nome_carta, preco, imagem FROM cartas_pokemon ORDER BY id_pk_carta DESC LIMIT 20";
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    $cards = [];
    while ($row = $result->fetch_assoc()) {
        $cards[] = $row;
    }
    // Retornar os dados em formato JSON
    header('Content-Type: application/json');
    echo json_encode($cards);
} else {
    // Caso nenhum dado seja encontrado
    echo json_encode([]);
}

// Fechar a conexão
$conn->close();
?>
