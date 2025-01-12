document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.querySelector('.cart-items');
    const subtotalElement = document.getElementById('subtotal');
    const deliveryFeeElement = document.getElementById('delivery-fee');
    const totalElement = document.getElementById('total');
    const checkoutForm = document.getElementById('checkout-form');

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function validateItem(item) {
        if (!item.price || isNaN(item.price)) {
            item.price = 0;
        }
        if (!item.quantity || isNaN(item.quantity) || item.quantity < 1) {
            item.quantity = 1;
        }
        return item;
    }

    function renderCartItems() {
        cartItemsContainer.innerHTML = '';
        let subtotal = 0;

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Votre panier est vide.</p>';
            return;
        }

        cart.forEach(item => {
            item = validateItem(item);

            const cartItemElement = document.createElement('div');
            cartItemElement.classList.add('cart-item');
            cartItemElement.innerHTML = `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                    <div class="cart-item-details">
                        <span class="cart-item-name">${item.name}</span>
                        <span class="cart-item-price">$${item.price.toFixed(2)}</span>
                    </div>
                    <div class="cart-item-quantity">
                        <button class="decrease-btn" data-id="${item.id}">-</button>
                        <input type="number" value="${item.quantity}" class="quantity-input" data-id="${item.id}" min="1">
                        <button class="increase-btn" data-id="${item.id}">+</button>
                    </div>
                    <div class="cart-item-total">
                        $${(item.price * item.quantity).toFixed(2)}
                    </div>
                    <button class="remove-item" data-id="${item.id}">Remove</button>
                </div>
            `;

            cartItemsContainer.appendChild(cartItemElement);
            subtotal += item.price * item.quantity;
        });

        subtotalElement.value = subtotal.toFixed(2);
        const deliveryFee = 5.00;
        deliveryFeeElement.value = deliveryFee.toFixed(2);
        const total = subtotal + deliveryFee;
        totalElement.value = total.toFixed(2);

        // Update hidden input for cart items
        document.getElementById('cart-items').value = JSON.stringify(cart);
    }

    function updateQuantity(productId, newQuantity) {
        const productIndex = cart.findIndex(item => item.id === productId);
        if (productIndex > -1) {
            cart[productIndex].quantity = newQuantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCartItems();
        }
    }

    function removeItem(productId) {
        cart = cart.filter(item => item.id !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCartItems();
    }

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

    checkoutForm.addEventListener('submit', (event) => {
        event.preventDefault();

        if (cart.length === 0) {
            alert('Votre panier est vide. Veuillez ajouter des articles avant de passer commande.');
            return;
        }

        const formData = new FormData(checkoutForm);
        formData.append('cart_items', JSON.stringify(cart));

        fetch('cart.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert(result.message);
                    localStorage.removeItem('cart');
                    cart = [];
                    renderCartItems();
                } else {
                    throw new Error(result.error || 'Une erreur est survenue lors de la création de la commande.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message);
            });
    });

    renderCartItems();
});

