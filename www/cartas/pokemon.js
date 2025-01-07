// URL do script PHP para buscar os dados dos Pokémon do ID 4 ao 10
const tablePokemonsApiUrl = "http://localhost/cartas/getTablePokemons.php";

// Função para carregar os Pokémon na tabela (IDs 4 ao 10)
async function carregarTabelaPokemons() {
    try {
        const response = await fetch(tablePokemonsApiUrl); // Faz a requisição ao PHP
        const pokemons = await response.json(); // Converte a resposta para JSON

        // Seleciona todas as linhas da tabela
        const linhas = document.querySelectorAll("tbody tr");

        // Itera pelos dados dos Pokémon retornados e atualiza as linhas
        pokemons.forEach((pokemon, index) => {
            const linha = linhas[index]; // Cada linha corresponde a um registro
            if (linha) {
                linha.children[1].textContent = pokemon.nome; // Atualiza o nome
                linha.children[2].textContent = `€ ${pokemon.preco.toFixed(2)}`; // Atualiza o preço
            }
        });
    } catch (error) {
        console.error("Erro ao carregar os Pokémon da tabela:", error);
    }
}

// Executa a função quando a página carregar
document.addEventListener("DOMContentLoaded", carregarTabelaPokemons);
