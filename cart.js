document.addEventListener("DOMContentLoaded", function () {
    const articleValueElement = document.getElementById("article-value");
    const shippingCostElement = document.getElementById("shipping-cost");
    const totalPriceElement = document.getElementById("total-price");
    const clearCartButton = document.getElementById("clear-cart");

    function loadCart() {
        fetch("get_cart.php")
            .then(response => response.json())
            .then(data => {
                const articleValue = data.total || 0;
                const shippingCost = 7.0; // taxa de entrega
                const totalPrice = articleValue + shippingCost;

                articleValueElement.textContent = `${articleValue.toFixed(2)} €`;
                totalPriceElement.textContent = `${totalPrice.toFixed(2)} €`;
            })
            .catch(err => console.error("Erro ao carregar o carrinho:", err));
    }

    clearCartButton.addEventListener("click", function () {
        if (confirm("Tem certeza de que deseja remover todos os itens do carrinho?")) {
            fetch("clear_cart.php", { method: "POST" })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Todos os itens foram removidos do carrinho!");
                        loadCart();
                    } else {
                        alert("Erro ao limpar o carrinho.");
                    }
                })
                .catch(err => console.error("Erro ao limpar o carrinho:", err));
        }
    });

    loadCart();
});
