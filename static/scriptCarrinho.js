// Sidebar menu literal
// Abre e fecha a sidebar ao clicar no botão do menu
function toggleSidebar(event) {
    event.stopPropagation(); 
    let sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("active");
}

// Fecha a sidebar ao clicar fora dela
function closeSidebar() {
    document.getElementById("sidebar").classList.remove("active");
}

// Fecha sidebar ao clicar na página
document.addEventListener("click", function(event) {
    let sidebar = document.getElementById("sidebar");
    let menuButton = document.querySelector(".menu-btn");

    if (!sidebar.contains(event.target) && !menuButton.contains(event.target)) {
        sidebar.classList.remove("active");
    }
});


// Search Bar
// Mostra os resultados APENAS quando pressionar ENTER ou clicar no botão Gotcha
function submitSearch() {
    let query = document.getElementById("searchBar").value.trim().toLowerCase();
    let rows = document.querySelectorAll("#cardTable tbody tr");

    if (query === "") {
        // Se a barra de pesquisa estiver vazia, mostra todas as cartas
        rows.forEach(row => {
            row.style.display = "";
        });
    } else {
        // Filtrar as cartas pelo nome
        rows.forEach(row => {
            let cardName = row.querySelector(".card-name").textContent.toLowerCase();
            row.style.display = cardName.includes(query) ? "" : "none";
        });
    }
}

// Deteta a tecla ENTER na search bar
document.getElementById("searchBar").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Evita o envio de formulário
        submitSearch();
    }
});

// Aciona a pesquisa ao clicar no botão "Gotcha"
document.getElementById("searchBtn").addEventListener("click", function() {
    submitSearch();
});

// CARRINHO DE COMPRAS Carrinho de compras
// Adiciona carta ao carrinho
function addToCart(cardId) {
    let isLoggedIn = document.body.dataset.loggedIn === "true";

    if (!isLoggedIn) {
        openModal(); // Exibe o aviso de login
        return;
    }

    // Se o user estiiver com o login ativo, adiciona a carta ao carrinho
    fetch("add_to_cart.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id_carta=" + cardId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount(data.cart_total);
            alert("Item adicionado ao carrinho!");
        } else {
            alert("Erro ao adicionar ao carrinho.");
        }
    })
    .catch(error => console.error("Erro:", error));
}


// Atualiza o contador do carrinho
function updateCartCount(count) {
    let cartCount = document.getElementById("cart-count");
    if (cartCount) {
        cartCount.textContent = count;
    }
}



// Modal de Login
function openModal() {
    let modal = document.getElementById("loginModal");
    if (modal) {
        modal.classList.add("show");
    } else {
        alert("⚠️ Você precisa fazer login para comprar!");
    }
}

function closeModal() {
    document.getElementById("loginModal").classList.remove("show");
}



// Fecha a modal
window.onclick = function(event) {
    let modal = document.getElementById("loginModal");
    if (event.target === modal) {
        closeModal();
    }
};


function alertStock() {
    alert("❌ Esta carta está out of stock!");
}
