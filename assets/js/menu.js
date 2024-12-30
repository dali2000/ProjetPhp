document.addEventListener('DOMContentLoaded', function() {
    const menuItems = [
        { id: 1, name: 'Village Special Burger', category: 'main-course', price: 12.99, image: '/img/burger.jpg' },
        { id: 2, name: 'Grilled Chicken Salad', category: 'appetizers', price: 9.99, image: '/img/salad.jpg' },
        { id: 3, name: 'Chocolate Lava Cake', category: 'desserts', price: 6.99, image: '/img/cake.jpg' },
        { id: 4, name: 'Fresh Fruit Smoothie', category: 'drinks', price: 4.99, image: '/img/smoothie.jpg' },
        // Add more menu items as needed
    ];

    const menuItemsContainer = document.querySelector('.menu-items');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('search-input');

    function renderMenuItems(items) {
        menuItemsContainer.innerHTML = '';
        items.forEach(item => {
            const menuItem = document.createElement('div');
            menuItem.classList.add('menu-item');
            menuItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}">
                <div class="menu-item-content">
                    <h3>${item.name}</h3>
                    <p class="price">$${item.price.toFixed(2)}</p>
                    <div class="quantity-control">
                        <button class="quantity-btn minus">-</button>
                        <input type="number" class="quantity-input" value="1" min="1" max="10">
                        <button class="quantity-btn plus">+</button>
                    </div>
                    <button class="add-to-cart-btn" data-id="${item.id}">Add to Cart</button>
                </div>
            `;
            menuItemsContainer.appendChild(menuItem);
        });
    }

    function filterMenuItems(category) {
        if (category === 'all') {
            renderMenuItems(menuItems);
        } else {
            const filteredItems = menuItems.filter(item => item.category === category);
            renderMenuItems(filteredItems);
        }
    }

    function searchMenuItems(query) {
        const searchedItems = menuItems.filter(item => 
            item.name.toLowerCase().includes(query.toLowerCase())
        );
        renderMenuItems(searchedItems);
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            filterMenuItems(button.getAttribute('data-filter'));
        });
    });

    searchInput.addEventListener('input', (e) => {
        searchMenuItems(e.target.value);
    });

    // Initial render
    renderMenuItems(menuItems);

    // Quantity control and Add to Cart functionality
    menuItemsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('quantity-btn')) {
            const input = e.target.parentElement.querySelector('.quantity-input');
            if (e.target.classList.contains('plus')) {
                input.value = Math.min(parseInt(input.value) + 1, 10);
            } else if (e.target.classList.contains('minus')) {
                input.value = Math.max(parseInt(input.value) - 1, 1);
            }
        } else if (e.target.classList.contains('add-to-cart-btn')) {
            const itemId = e.target.getAttribute('data-id');
            const quantity = e.target.parentElement.querySelector('.quantity-input').value;
            addToCart(itemId, quantity);
        }
    });

    function addToCart(itemId, quantity) {
        const item = menuItems.find(item => item.id === parseInt(itemId));
        if (item) {
            const cartItem = {
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: parseInt(quantity)
            };
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingItemIndex = cart.findIndex(i => i.id === cartItem.id);
            if (existingItemIndex > -1) {
                cart[existingItemIndex].quantity += cartItem.quantity;
            } else {
                cart.push(cartItem);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(`Added ${quantity} ${item.name}(s) to cart!`);
        }
    }
});