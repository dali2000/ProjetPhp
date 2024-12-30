<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Village Chef</title>
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
                <a href="cart.php"><div class="cart-icon" ><i class="fa fa-shopping-cart" aria-hidden="true" hre></i></div></a>
                <button class="login-btn" onclick="window.location.href='../modules/auth/login.php'"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</button>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Grab Big Deals<br>on <span class="highlight">Yummy Meals!</span></h1>
                <p>Lorem ipsum dolor sit amet consectetur. Aenean mau risnam tortor curabitur phasellus.</p>
                <button class="get-started">Get Started</button>
                
                <div class="customers-section">
                    <h3>Our Happy Customers</h3>
                    <div class="customer-info">
                        <div class="customer-avatars">
                            <img src="../assets/img/avatar1.png" alt="" srcset=""class="avatar">
                            <img src="../assets/img/avatar2.png" alt="" srcset=""class="avatar">
                            <img src="../assets/img/avatar.png" alt="" srcset=""class="avatar">
                        </div>
                        <div class="rating">
                            <span class="star">★</span>
                            <span class="rating-number">4.8</span>
                            <span class="review-count">(16.5k Review)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-image-section">
                <img class="main-dish-img" src="../assets/img/chicken.png" alt="">
                <div class="courier-card">
                    <img class="courier-avatar" src="../assets/img/jon.png" alt="">
                    <div class="courier-info">
                        <h4>Jon Williamson</h4>
                        <p>Food Courier</p>
                    </div>
                    <div class="phone-icon"></div>
                </div>
                <div class="pizza-card">
                    <img class="pizza-img" src="../assets/img/pizza.png" alt="">
                    <div class="pizza-info">
                        <h4>Cheese Pizza</h4>
                        <div class="stars">★★★★★</div>
                        <p class="price">₹299/-</p>
                    </div>
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
                    <li><a href="#menu">Our Menu</a></li>
                    <li><a href="#offers">Special Offers</a></li>
                    <li><a href="#about">About Us</a></li>
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
</body>
</html>