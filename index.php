<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCGMark - Home</title>
    <link rel="stylesheet" href="static/styles.css">
    <script defer src="static/script.js"></script>
</head>
<body>

    <header>
        <img src="static/CarMark.png" alt="Logo CardMark" class="site-logo">
    </header>

    <div class="carousel-container">
        <button class="carousel-btn left" onclick="changeSlide(-1)">&#10094;</button>
        <a id="carousel-link" href="vanguard.php"> <!-- Link que muda com o carrossel -->
            <img id="carousel-image" src="static/Vg_new_logo.png" alt="Vanguard Logo">
        </a>
        <button class="carousel-btn right" onclick="changeSlide(1)">&#10095;</button>
    </div>

    <footer>
        <p>Caso queira entrar em contato conosco:</p>
        <p>Email: <a href="mailto:CardMark@gmail.com">CardMark@gmail.com</a></p>
        <p>Telefone: <a href="tel:+351904235896">+351 904 235 896</a></p>
    </footer>

</body>
</html>
