document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.querySelector('.cart-items');
    const subtotalElement = document.getElementById('subtotal');
    const deliveryFeeElement = document.getElementById('delivery-fee');
    const totalElement = document.getElementById('total');

    // Récupérer les produits du panier dans le localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    console.log(cart);

    // Vérifier que les produits ont des valeurs valides
    function validateItem(item) {
        if (!item.price || isNaN(item.price)) {
            item.price = 0; // Valeur par défaut si price est invalide
        }
        if (!item.quantity || isNaN(item.quantity) || item.quantity < 1) {
            item.quantity = 1; // Valeur par défaut si quantity est invalide
        }
        return item;
    }

    // Afficher les produits du panier
    function renderCartItems() {
        // Vider le conteneur des produits du panier avant de les afficher
        cartItemsContainer.innerHTML = '';

        // Calculer le sous-total
        let subtotal = 0;

        // Afficher chaque produit dans le panier
        cart.forEach(item => {
            // Valider chaque élément du panier
            item = validateItem(item);

            const cartItemElement = document.createElement('div');
            cartItemElement.classList.add('cart-item');

            cartItemElement.innerHTML = `
<div class="cart-item">
    <img src="${item.image}" alt="${item.name}" class="cart-item-img">
    <div class="cart-item-details">
        <span class="cart-item-name">${item.name}</span>
        <span class="cart-item-price">$${item.price}</span>
    </div>
    <div class="cart-item-quantity">
        <button class="decrease-btn" data-id="${item.id}">-</button>
        <input type="number" value="${item.quantity}" class="quantity-input" data-id="${item.id}" min="1">
        <button class="increase-btn" data-id="${item.id}">+</button>
    </div>
    <div class="cart-item-total">
        $${(item.price * item.quantity)}
    </div>
    <button class="remove-item" data-id="${item.id}">Remove</button>
</div>

            `;

            cartItemsContainer.appendChild(cartItemElement);

            // Ajouter le prix du produit au sous-total
            subtotal += item.price * item.quantity;
        });

        // Mettre à jour le sous-total
        subtotalElement.textContent = `$${subtotal}`;

        // Les frais de livraison sont fixes à $5.00
        const deliveryFee = 5.00;
        deliveryFeeElement.textContent = `$${deliveryFee}`;

        // Calculer le total (sous-total + frais de livraison)
        const total = subtotal + deliveryFee;
        totalElement.textContent = `$${total}`;
    }

    // Fonction pour mettre à jour la quantité d'un produit
    function updateQuantity(productId, newQuantity) {
        const productIndex = cart.findIndex(item => item.id === productId);
        if (productIndex > -1) {
            cart[productIndex].quantity = newQuantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCartItems();  // Mettre à jour l'affichage
        }
    }

    // Fonction pour supprimer un produit du panier
    function removeItem(productId) {
        cart = cart.filter(item => item.id !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCartItems();  // Mettre à jour l'affichage
    }

    // Ajouter des écouteurs d'événements pour augmenter, diminuer la quantité et supprimer un produit
    cartItemsContainer.addEventListener('click', (event) => {
        const target = event.target;
        const productId = target.getAttribute('data-id');

        if (target.classList.contains('increase-btn')) {
            const quantityInput = document.querySelector(`.quantity-input[data-id="${productId}"]`);
            let quantity = parseInt(quantityInput.value);
            quantity += 1;
            quantityInput.value = quantity;
            updateQuantity(productId, quantity);
        }

        if (target.classList.contains('decrease-btn')) {
            const quantityInput = document.querySelector(`.quantity-input[data-id="${productId}"]`);
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity -= 1;
                quantityInput.value = quantity;
                updateQuantity(productId, quantity);
            }
        }

        if (target.classList.contains('remove-item')) {
            removeItem(productId);
        }
    });

    // Initialiser l'affichage du panier
    renderCartItems();
});
