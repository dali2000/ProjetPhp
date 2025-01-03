<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Village Chef</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
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
                <div class="cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                <button class="login-btn"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</button>
            </div>
        </nav>
    </header>

    <!-- Cart Section -->
    <main>
        <section class="cart-hero">
            <h1>Your Cart</h1>
            <p>Review and complete your order</p>
        </section>

        <section class="cart-content">
            <div class="cart-items">
                <!-- Cart items will be dynamically added here -->
            </div>
            <div class="cart-summary">
                <h2>Order Summary</h2>
                <div class="summary-item">
                    <span>Subtotal:</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div class="summary-item<div class="summary-item">
                    <span>Delivery Fee:</span>
                    <span id="delivery-fee">$5.00</span>
                </div>
                <div class="summary-item">
                    <span>Total:</span>
                    <span id="total">$0.00</span>
                </div>
                <button id="checkout-btn">Proceed to Checkout</button>
            </div>
        </section>

        <section class="delivery-info">
            <h2>Delivery Information</h2>
            <form id="delivery-form">
                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="instructions">Delivery Instructions (Optional)</label>
                    <textarea id="instructions" name="instructions"></textarea>
                </div>
            </form>
        </section>

        <section class="order-status">
            <h2>Order Status</h2>
            <div id="status-tracker">
                <div class="status-step active">
                    <i class="fas fa-receipt"></i>
                    <span>Order Received</span>
                </div>
                <div class="status-step">
                    <i class="fas fa-utensils"></i>
                    <span>Preparing</span>
                </div>
                <div class="status-step">
                    <i class="fas fa-motorcycle"></i>
                    <span>On the Way</span>
                </div>
                <div class="status-step">
                    <i class="fas fa-home"></i>
                    <span>Delivered</span>
                </div>
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="contact.php">Contact</a></li>
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
    <script src="../assets/js/cart.js"></script>
</body>
</html>
