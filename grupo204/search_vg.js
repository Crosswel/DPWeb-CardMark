document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");
    const tableBody = document.querySelector("table tbody");

    // Função para carregar e exibir todas as cartas
    function loadAllCards() {
        fetch("fetch_cards.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erro ao procurar os dados: " + response.status);
                }
                return response.json();
            })
            .then(cards => {
                console.log("Dados recebidos para carregar todas as cartas:", cards);

                // Ordenar as cartas por ID (crescente)
                cards.sort((a, b) => a.id_vg_carta - b.id_vg_carta);

                // Limpar a tabela
                tableBody.innerHTML = "";

                // Exibir todas as cartas
                cards.forEach(card => {
                    const imgSrc = card.imagem && card.imagem.trim() !== "" ? `http://localhost/static/${card.imagem.trim()}` : `http://localhost/static/placeholder.png`;
                    const preco = isNaN(card.preco) ? 0 : Number(card.preco); // Tratar valores inválidos como 0
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${card.id_vg_carta}</td>
                        <td>${card.nome_carta}</td>
                        <td>€ ${preco.toFixed(2)}</td>
                        <td><button class="btn"><img src="${imgSrc}" alt="${card.nome_carta}" style="max-width: 50px; border: 1px solid #ccc; border-radius: 5px;"/></button></td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                console.error("Erro ao carregar todas as cartas:", error);
            });
    }

    // Carregar todas as cartas inicialmente
    loadAllCards();

    // Evento de clique no botão "Gotcha"
    searchButton.addEventListener("click", function () {
        const query = searchInput.value.trim().toLowerCase();

        // Caso o campo de procura esteja vazio, carregar todas as cartas
        if (!query) {
            loadAllCards();
            return;
        }

        // Fazer uma requisição para procurar as cartas
        fetch("fetch_cards.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erro ao procurar os dados: " + response.status);
                }
                return response.json();
            })
            .then(cards => {
                console.log("Dados recebidos para procura:", cards);

                // Filtrar as cartas com base na procura
                const filteredCards = cards.filter(card =>
                    card.nome_carta.toLowerCase().includes(query)
                );

                // Limpar a tabela
                tableBody.innerHTML = "";

                // Exibir os resultados filtrados
                if (filteredCards.length > 0) {
                    filteredCards.forEach(card => {
                        const imgSrc = card.imagem && card.imagem.trim() !== "" ? `http://localhost/static/${card.imagem.trim()}` : `http://localhost/static/placeholder.png`;
                        const preco = isNaN(card.preco) ? 0 : Number(card.preco); // Tratar valores inválidos como 0
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${card.id_vg_carta}</td>
                            <td>${card.nome_carta}</td>
                            <td>€ ${preco.toFixed(2)}</td>
                            <td><button class="btn"><img src="${imgSrc}" alt="${card.nome_carta}" style="max-width: 50px; border: 1px solid #ccc; border-radius: 5px;"/></button></td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    // Caso nenhum resultado seja encontrado
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td colspan="4" style="text-align: center;">Nenhuma carta encontrada para "${query}"</td>
                    `;
                    tableBody.appendChild(row);
                }
            })
            .catch(error => {
                console.error("Erro ao carregar os dados das cartas:", error);
            });
    });
});
