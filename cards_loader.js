document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_cards.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Erro ao buscar os dados: " + response.status);
            }
            return response.json();
        })
        .then(cards => {
            console.log("Dados recebidos:", cards);
            const topCardsContainer = document.querySelector(".top-cards");
            const tableBody = document.querySelector("table tbody");

            // Limpar conteúdo existente
            topCardsContainer.innerHTML = "";
            tableBody.innerHTML = "";

            // Adicionar os 3 primeiros cards na seção "Top 3"
            cards.slice(0, 3).forEach((card, index) => {
                const imgSrc = card.imagem && card.imagem.trim() !== "" 
                    ? `http://localhost/static/${card.imagem.trim()}` 
                    : `http://localhost/static/placeholder.png`;
                const cardDiv = document.createElement("div");
                cardDiv.classList.add("card");
                cardDiv.innerHTML = `
                    <img src="${imgSrc}" alt="${card.nome_carta}" style="width: auto; height: auto; border: 2px solid #ccc; border-radius: 10px;">
                    <p>Top ${index + 1}: ${card.nome_carta}</p>
                `;
                topCardsContainer.appendChild(cardDiv);
            });

            // Adicionar todos os cards na tabela
            cards.forEach(card => {
    const imgSrc = card.imagem && card.imagem.trim() !== "" ? `http://localhost/static/${card.imagem.trim()}` : `http://localhost/static/placeholder.png`;
    console.log(`Imagem para ${card.nome_carta}: ${imgSrc}`);
    console.log(`Box Set para ${card.nome_carta}: ${card.box_set}`); // Log para verificar o valor de box_set

    const row = document.createElement("tr");
    row.innerHTML = `
        <td>${card.box_set || "Sem informação"}</td> <!-- Exibindo o box_set -->
        <td>${card.nome_carta}</td>
        <td>€ ${isNaN(card.preco) ? 0 : Number(card.preco).toFixed(2)}</td>
        <td><button class="btn"><img src="${imgSrc}" alt="${card.nome_carta}" style="max-width: 50px;"/></button></td>
    `;
    tableBody.appendChild(row);
});

            
        })
        .catch(error => {
            console.error("Erro ao carregar os dados das cartas:", error);
        });
});
