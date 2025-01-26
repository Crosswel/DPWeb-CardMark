document.addEventListener("DOMContentLoaded", function () {
    // Fazendo uma requisição para o arquivo PHP específico de Pokémon
    fetch("fetch_pokemon_cards.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Erro ao buscar os dados: " + response.status);
            }
            return response.json();
        })
        .then(cards => {
            console.log("Dados recebidos:", cards); // Log para depuração
            const topCardsContainer = document.querySelector(".top-cards");
            const tableBody = document.querySelector("table tbody");

            // Ordenar as cartas por ID (crescente)
            cards.sort((a, b) => a.id_pk_carta - b.id_pk_carta);

            // Limpar conteúdo existente
            topCardsContainer.innerHTML = "";
            tableBody.innerHTML = "";

            // Adicionar as 3 primeiras cartas na seção "Top 3"
            cards.slice(0, 3).forEach((card, index) => {
                const imgSrc = card.imagem && card.imagem.trim() !== "" ? `http://localhost/static/${card.imagem.trim()}` : `http://localhost/static/placeholder.png`;
                console.log(`Imagem para Top ${index + 1}: ${imgSrc}`); // Log do caminho da imagem
                const cardDiv = document.createElement("div");
                cardDiv.classList.add("card");
                cardDiv.innerHTML = `
                    <img src="${imgSrc}" alt="${card.nome_carta}" style="max-width: 300px;">
                    <p>Top ${index + 1}: ${card.nome_carta}</p>
                `;
                topCardsContainer.appendChild(cardDiv);
            });

            // Adicionar todas as 20 cartas na tabela
            cards.forEach(card => {
                const imgSrc = card.imagem && card.imagem.trim() !== "" ? `http://localhost/static/${card.imagem.trim()}` : `http://localhost/static/placeholder.png`;
                console.log(`Imagem para ID ${card.id_pk_carta}: ${imgSrc}`); // Log do caminho da imagem
                const preco = isNaN(card.preco) ? 0 : Number(card.preco); // Tratar valores inválidos como 0
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${card.id_pk_carta}</td>
                    <td>${card.nome_carta}</td>
                    <td>€ ${preco.toFixed(2)}</td>
                    <td><button class="btn"><img src="${imgSrc}" alt="${card.nome_carta}" style="max-width: 50px;"/></button></td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar os dados das cartas:", error);
        });
});
