document.addEventListener('DOMContentLoaded', () => {
    const cartButtons = document.querySelectorAll('.add-to-cart-btn');
    const quantityButtons = document.querySelectorAll('.quantity-btn');
    const searchInput = document.getElementById('search-input');
    const menuItems = document.querySelectorAll('.menu-item');

    // Fonction pour ajouter au panier
    function addToCart(productId, quantity) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const existingProductIndex = cart.findIndex(item => item.id === productId);

        if (existingProductIndex > -1) {
            // Si le produit existe déjà, on met à jour la quantité
            cart[existingProductIndex].quantity += quantity;
        } else {
            // Si le produit n'existe pas, on l'ajoute avec toutes les informations
            const productElement = document.querySelector(`.menu-item[data-id='${productId}']`);
            const productName = productElement.querySelector('h3').textContent;
            const productPrice = productElement.querySelector('.price').textContent;
            const productImage = productElement.querySelector('img').src;

            cart.push({
                id: productId,
                name: productName,
                price: parseFloat(productPrice.replace('$', '')), // Convertir le prix en nombre
                quantity: quantity,
                image: productImage
            });
        }

        // Sauvegarder le panier mis à jour dans localStorage
        localStorage.setItem('cart', JSON.stringify(cart));
    }


    // Fonction pour mettre à jour la quantité du produit
    function updateQuantity(productId, quantity) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const existingProductIndex = cart.findIndex(item => item.id === productId);
        if (existingProductIndex > -1) {
            if (quantity > 0) {
                cart[existingProductIndex].quantity = quantity;
            } else {
                cart.splice(existingProductIndex, 1);
            }
        }

        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Gestion des boutons "plus" et "moins"
    quantityButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const productId = button.getAttribute('data-id');
            const quantityInput = button.closest('.quantity-control').querySelector('.quantity-input');
            let quantity = parseInt(quantityInput.value);

            if (button.classList.contains('plus')) {
                quantity += 1;
            } else if (button.classList.contains('minus') && quantity > 1) {
                quantity -= 1;
            }

            quantityInput.value = quantity;

            updateQuantity(productId, quantity);
        });
    });

    // Événement pour ajouter un produit au panier
    cartButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const productId = button.getAttribute('data-id');
            const quantityInput = button.previousElementSibling.querySelector('.quantity-input');
            const quantity = parseInt(quantityInput.value);

            if (quantity > 0) {
                addToCart(productId, quantity);
                alert('Produit ajouté au panier');
            }
        });
    });

    // Fonction de filtrage par nom de produit
    searchInput.addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase();

        menuItems.forEach(item => {
            const productName = item.querySelector('h3').textContent.toLowerCase();
            if (productName.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
