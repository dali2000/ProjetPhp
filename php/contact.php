<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Village Chef</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
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
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <div class="nav-right">
                <div class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
                <div class="cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                <button class="login-btn"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</button>
            </div>
        </nav>
    </header>

    <!-- Contact Section -->
    <main>
        <section class="contact-hero">
            <h1>Get in Touch</h1>
            <p>We'd love to hear from you! Reach out for any questions or feedback.</p>
        </section>

        <section class="contact-content">
            <div class="contact-form">
                <h2>Send us a message</h2>
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
            <div class="contact-info">
                <h2>Contact Information</h2>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>123 Restaurant Street, Food City, FC 12345</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <p>(123) 456-7890</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>info@villagechef.com</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <p>Mon-Fri: 9am-10pm, Sat-Sun: 10am-11pm</p>
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
    <script src="../assets/js/contact.js"></script>
</body>
</html>
