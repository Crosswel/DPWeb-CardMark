document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");
    const tableBody = document.querySelector("table tbody");

    // Adicionar evento ao botão de busca
    searchButton.addEventListener("click", function () {
        realizarBusca();
    });

    // Adicionar evento para buscar ao pressionar Enter
    searchInput.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            realizarBusca();
        }
    });

    function realizarBusca() {
        const termoBusca = searchInput.value.trim().toLowerCase();

        // Se o campo estiver vazio, mostrar todos os resultados
        if (termoBusca === "") {
            Array.from(tableBody.children).forEach(row => {
                row.style.display = ""; // Mostrar todas as linhas
            });
            return;
        }

        // Iterar pelas linhas da tabela e verificar se o termo existe
        Array.from(tableBody.children).forEach(row => {
            const nomeCarta = row.children[1].textContent.trim().toLowerCase();
            if (nomeCarta.includes(termoBusca)) {
                row.style.display = ""; // Mostrar linha correspondente
            } else {
                row.style.display = "none"; // Ocultar linha
            }
        });
    }
});
