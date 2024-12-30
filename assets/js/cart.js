document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.querySelector('.cart-items');
    const subtotalElement = document.getElementById('subtotal');
    const totalElement = document.getElementById('total');
    const checkoutBtn = document.getElementById('checkout-btn');
    const deliveryForm = document.getElementById('delivery-form');
    const statusTracker = document.getElementById('status-tracker');

    function renderCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartItemsContainer.innerHTML = '';
        let subtotal = 0;

        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <img src="/img/${item.id}.jpg" alt="${item.name}">
                <div class="cart-item-details">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn minus" data-id="${item.id}">-</button>
                        <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="10" data-id="${item.id}">
                        <button class="quantity-btn plus" data-id="${item.id}">+</button>
                    </div>
                </div>
                <button class="remove-item" data-id="${item.id}">Remove</button>
            `;
            cartItemsContainer.appendChild(cartItem);
            subtotal += item.price * item.quantity;
        });

        subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
        const total = subtotal + 5; // Assuming $5 delivery fee
        totalElement.textContent = `$${total.toFixed(2)}`;
    }

    function updateCart(itemId, newQuantity) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const itemIndex = cart.findIndex(item => item.id === parseInt(itemId));
        if (itemIndex > -1) {
            if (newQuantity > 0) {
                cart[itemIndex].quantity = newQuantity;
            } else {
                cart.splice(itemIndex, 1);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }
    }

    cartItemsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('quantity-btn')) {
            const itemId = e.target.getAttribute('data-id');
            const input = e.target.parentElement.querySelector('.quantity-input');
            let newQuantity = parseInt(input.value);
            if (e.target.classList.contains('plus')) {
                newQuantity++;
            } else if (e.target.classList.contains('minus')) {
                newQuantity = Math.max(newQuantity - 1, 0);
            }
            updateCart(itemId, newQuantity);
        } else if (e.target.classList.contains('remove-item')) {
            const itemId = e.target.getAttribute('data-id');
            updateCart(itemId, 0);
        }
    });

    cartItemsContainer.addEventListener('change', (e) => {
        if (e.target.classList.contains('quantity-input')) {
            const itemId = e.target.getAttribute('data-id');
            const newQuantity = parseInt(e.target.value);
            updateCart(itemId, newQuantity);
        }
    });

    checkoutBtn.addEventListener('click', () => {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length === 0) {
            alert('Your cart is empty. Add some items before checking out.');
            return;
        }
        // Here you would typically process the order, send it to a server, etc.
        // For this example, we'll just simulate order processing
        alert('Order placed successfully! Check the order status below.');
        simulateOrderProcess();
    });

    deliveryForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Here you would typically validate and process the delivery information
        alert('Delivery information saved!');
    });

    function simulateOrderProcess() {
        const steps = statusTracker.querySelectorAll('.status-step');
        let currentStep = 0;

        function updateStatus() {
            if (currentStep < steps.length) {
                steps[currentStep].classList.add('active');
                currentStep++;
                setTimeout(updateStatus, 3000); // Update status every 3 seconds
            }
        }

        updateStatus();
    }

    // Initial render
    renderCart();
});

