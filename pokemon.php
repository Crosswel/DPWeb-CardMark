<?php
session_start();
include 'db_connect.php';

// Verificar se há login
$logged_in = isset($_SESSION['user_id']);

// Filtrar as Top 3 cartas pela menor quantidade
$sql_top3 = "SELECT id, nome, box_set, preco, imagem, quantidade 
             FROM cartas 
             WHERE jogo = 'Pokemon' 
             ORDER BY quantidade ASC, id ASC 
             LIMIT 3"; // Ordena pela menor quantidade primeiro, depois pelo ID
$result_top3 = $conn->query($sql_top3);
$top3_cartas = $result_top3->fetch_all(MYSQLI_ASSOC);




// Verificar se há pesquisa na URL
$search_query = isset($_GET['query']) ? trim($_GET['query']) : "";

// Modificar a procura para permitir que haja uma pesquisa parcial
if ($search_query !== "") {
    $sql_cartas = "SELECT id, nome, box_set, preco, imagem, quantidade FROM cartas 
                   WHERE jogo = 'Pokemon' 
                   AND nome LIKE ? 
                   ORDER BY id ASC";
    $stmt = $conn->prepare($sql_cartas);
    $search_param = "%" . $search_query . "%"; // Adiciona wildcard para procura parcial
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $result_cartas = $stmt->get_result();
} else {
    // Consulta padrão se não houver pesquisa
    $sql_cartas = "SELECT id, nome, box_set, preco, imagem, quantidade FROM cartas 
                   WHERE jogo = 'Pokemon' 
                   ORDER BY id ASC";
    $result_cartas = $conn->query($sql_cartas);
}

$cartas = $result_cartas->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Cards</title>
    <link rel="stylesheet" href="static/styles2.css">
    <script defer src="static/scriptCarrinho.js"></script> <!-- Script para Navbar, Pesquisa e Carrinho -->
</head>
<body onclick="closeSidebar()"> <!-- Fecha a sidebar ao clicar na página -->

<!-- Navbar -->
<header onclick="event.stopPropagation()"> <!-- Evita fechar ao clicar na navbar -->
    <div class="navbar-left">
        <button class="menu-btn" onclick="toggleSidebar(event)">☰</button>
        <a href="pokemon.php">
            <img src="static/Pokemon-Logo.png" alt="Pokémon" class="sidebar-logo">
        </a>
        <a href="index.php">
            <img src="static/CarMark.png" alt="CarMark Logo" class="carmark-logo">
        </a>
    </div>

    <!-- Barra de pesquisa -->
    <div class="search-container">
        <input type="text" id="searchBar" placeholder="Pesquisar cartas..." onkeyup="filterCards()">
        <button class="search-btn" onclick="submitSearch()">
            <img src="static/gotcha.png" alt="Search" class="search-icon">
        </button>
    </div>

    <div class="navbar-right">
        <?php if (isset($_SESSION['user_id'])): ?>
        <a href="conta.php"><img src="static/profile.png" alt="Account"></a>
        <?php else: ?>
        <a href="login.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']); ?>">
            <img src="static/profile.png" alt="Login">
        </a>
        <?php endif; ?>

        <a href="cart.php" id="cart-link">
            <img src="static/carrinho.png" alt="Carrinho">
            <span id="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?></span>
        </a>

        
    </div>
</header>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <button class="close-btn" onclick="toggleSidebar()">×</button>
    <a href="vanguard.php"> <img src="static/Vg_new_logo.png" alt="Vanguard Logo" class="sidebar-logo"></a>
    <a href="yugi.php"><img src="static/yugi.png" alt="Yu-Gi-Oh!" class="sidebar-logo"></a>
</div>

<h1>Top 3 Cards</h1>
<div class="top3-container">
    <?php foreach ($top3_cartas as $card): ?>
        <div class="top3-card">
            <img src="<?= htmlspecialchars($card['imagem']); ?>" alt="<?= htmlspecialchars($card['nome']); ?>">
            <p><strong><?= htmlspecialchars($card['nome']); ?></strong></p>
            <p>Preço: € <?= number_format($card['preco'], 2, ',', '.'); ?></p>
        </div>
    <?php endforeach; ?>
</div>

<h1>Top 20 Cards</h1>

<div class="table-container">
    <table id="cardTable">
        <thead>
            <tr>
                <th>Box Set</th>
                <th>Card Name</th>
                <th>Price</th>
                <th>Buy</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($cartas as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['box_set']); ?></td>
            <td class="card-name"><?= htmlspecialchars($row['nome']); ?></td>
            <td>€ <?= number_format($row['preco'], 2, ',', '.'); ?></td>
            <td>
    <?php if ($row['quantidade'] > 0): ?>
        <body onclick="closeSidebar()" data-logged-in="<?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>">

        <button class="buy-btn" onclick="addToCart(<?= $row['id'] ?>)">
    <img src="<?= htmlspecialchars($row['imagem']); ?>" 
         alt="<?= htmlspecialchars($row['nome']); ?>" 
         class="buy-img">
</button>

<body onclick="closeSidebar()" data-logged-in="<?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>">

    <?php else: ?>
        <button class="buy-btn out-of-stock" onclick="alertStock()">
            <img src="<?= htmlspecialchars($row['imagem']); ?>" 
                 alt="<?= htmlspecialchars($row['nome']); ?>" 
                 class="buy-img grayscale">
        </button>
    <?php endif; ?>
</td>

        </tr>
    <?php endforeach; ?>
</tbody>

    </table>
</div>
<!-- Modal de Aviso de Login -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Tem que fazer login para realizar a compra!</p>
    </div>
</div>

</body>
</html>
