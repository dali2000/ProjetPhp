document.addEventListener('DOMContentLoaded', () => {
    const cartButtons = document.querySelectorAll('.add-to-cart-btn');
    const quantityButtons = document.querySelectorAll('.quantity-btn');
    const searchInput = document.getElementById('search-input');
    const menuItems = document.querySelectorAll('.menu-item');
    const filterButtons = document.querySelectorAll('.filter-btn');

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
    function filterAndSearchMenu() {
        const searchTerm = searchInput.value.toLowerCase();
        const activeCategory = document.querySelector('.filter-btn.active')?.getAttribute('data-filter') || 'all';

        console.log('Filtering with:', { searchTerm, activeCategory });

        let visibleItems = 0;
        menuItems.forEach(item => {
            const productName = item.querySelector('h3').textContent.toLowerCase();
            const itemCategory = item.querySelector('h4').textContent.trim().toLowerCase();
            const matchesSearch = productName.includes(searchTerm);
            const matchesCategory = activeCategory === 'all' || itemCategory === activeCategory.toLowerCase();

            console.log('Item:', productName, 'Category:', itemCategory, 'Matches:', { matchesSearch, matchesCategory });

            if (matchesSearch && matchesCategory) {
                item.style.display = 'flex';
                visibleItems++;
            } else {
                item.style.display = 'none';
            }
        });

        console.log('Visible items after filtering:', visibleItems);
    }

    searchInput.addEventListener('input', filterAndSearchMenu);

    filterButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent any default button behavior
            console.log('Button clicked:', button.textContent);
            console.log('Filter value:', button.getAttribute('data-filter'));

            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            console.log('Active category after click:', button.getAttribute('data-filter'));

            filterAndSearchMenu();
        });
    });

    // Add 'all' button programmatically if it doesn't exist
    if (!document.querySelector('.filter-btn[data-filter="all"]')) {
        console.log('Adding "All" button');
        const allButton = document.createElement('button');
        allButton.className = 'filter-btn active';
        allButton.setAttribute('data-filter', 'all');
        allButton.textContent = 'Tous';
        document.querySelector('.filter-buttons').prepend(allButton);

        allButton.addEventListener('click', (event) => {
            event.preventDefault();
            console.log('All button clicked');
            filterButtons.forEach(btn => btn.classList.remove('active'));
            allButton.classList.add('active');
            filterAndSearchMenu();
        });
    }

    // Initialize with 'all' category
    console.log('Initializing with "all" category');
    filterAndSearchMenu();

    // Log initial active category
    const initialActiveCategory = document.querySelector('.filter-btn.active')?.getAttribute('data-filter');
    console.log('Initial active category:', initialActiveCategory);
});
