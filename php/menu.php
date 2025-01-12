<?php
include '../classes/Produit.php';
session_start();
$produitClass = new Produit();
$products = $produitClass->getProduits();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Village Chef</title>
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">
                <div class="logo-img"></div>
                <span><span class="highlight">Village</span> CHEF</span>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="nav-right">
                <div class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                <div class="cart-icon"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></li></i></a></div>
                <button class="login-btn"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</button>
            </div>
        </nav>
    </header>

    <!-- Menu Section -->
    <main>
        <section class="menu-hero">
            <h1>Our Menu</h1>
            <p>Discover our delicious offerings</p>
        </section>

        <section class="menu-content">
            <div class="menu-filters">
                <input type="text" id="search-input" placeholder="Search menu items...">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">All</button>
                    <button class="filter-btn" data-filter="appetizers">Appetizers</button>
                    <button class="filter-btn" data-filter="main-course">Main Course</button>
                    <button class="filter-btn" data-filter="desserts">Desserts</button>
                    <button class="filter-btn" data-filter="drinks">Drinks</button>
                </div>
            </div>

            <div class="menu-items">
                <?php foreach ($products as $product): ?>
                    <div class="menu-item" data-id="<?php echo $product['id']; ?>"> <!-- Ajoutez le data-id ici -->
                        <img src="../assets/img/pizza.png" alt="Village Special Burger">
                        <div class="menu-item-content">
                            <h3><?php echo $product['nomProduit']; ?></h3>
                            <p class="price"><?php echo $product['prix']; ?>$</p>
                            <div class="quantity-control">
                                <button class="quantity-btn minus" data-id="<?php echo $product['id']; ?>">-</button>
                                <input type="number" class="quantity-input" value="1" min="1" max="10">
                                <button class="quantity-btn plus" data-id="<?php echo $product['id']; ?>">+</button>
                            </div>
                            <button class="add-to-cart-btn" data-id="<?php echo $product['id']; ?>">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-logo">
                    <div class="logo-img"></div>
                    <span><span class="highlight">Village</span> CHEF</span>
                </div>
                <p>Experience the best cuisine delivered right to your doorstep.</p>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="menu.html">Our Menu</a></li>
                    <li><a href="#offers">Special Offers</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <div class="contact-info">
                    <p>123 Restaurant Street</p>
                    <p>Food City, FC 12345</p>
                    <p>Phone: (123) 456-7890</p>
                    <p>Email: info@villagechef.com</p>
                </div>
            </div>

            <div class="footer-section">
                <h3>Newsletter</h3>
                <p>Subscribe for special offers and updates</p>
                <div class="newsletter-form">
                    <input type="email" placeholder="Enter your email">
                    <button type="submit">Subscribe</button>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 Village Chef. All rights reserved.</p>
        </div>
    </footer>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/menu.js"></script>
</body>
</html>