<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Village Chef</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php include_once './utils/navbar.php' ?>
    <!-- About Us Section -->
    <main>
        <section class="about-hero">
            <h1>Our Story</h1>
            <p>Bringing the flavors of the village to your doorstep</p>
        </section>

        <section class="about-content">
            <div class="about-text">
                <h2>Welcome to Village Chef</h2>
                <p>Founded in 2010, Village Chef started as a small family-owned restaurant with a big dream: to bring authentic village flavors to the bustling city. Our journey began with a passion for traditional recipes passed down through generations, combined with a modern twist to cater to contemporary tastes.</p>
                <p>Today, we've grown into a beloved culinary destination, known for our farm-to-table approach and commitment to quality. We source our ingredients from local farmers and artisans, ensuring that every dish is fresh, flavorful, and supports our community.</p>
            </div>
            <div class="about-image">
                <img src="../assets/img/logo.png" alt="Village Chef Restaurant Interior" style="width:21rem;margin: auto;display: block"/>
            </div>
        </section>

        <section class="our-values">
            <h2>Our Values</h2>
            <div class="values-grid">
                <div class="value-item">
                    <i class="fas fa-leaf"></i>
                    <h3>Sustainability</h3>
                    <p>We're committed to eco-friendly practices and reducing our carbon footprint.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-users"></i>
                    <h3>Community</h3>
                    <p>We support local farmers and give back to our community through various initiatives.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-utensils"></i>
                    <h3>Quality</h3>
                    <p>We never compromise on the quality of our ingredients or our cooking.</p>
                </div>
                <div class="value-item">
                    <i class="fas fa-heart"></i>
                    <h3>Passion</h3>
                    <p>Our love for food and hospitality is at the heart of everything we do.</p>
                </div>
            </div>
        </section>

        <section class="team">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="../assets/img/chef2.jpg" alt="Chef John Doe" />
                    <h3>John Doe</h3>
                    <p>Head Chef</p>
                </div>
                <div class="team-member">
                    <img src="../assets/img/chef1.jpg" alt="Chef Jane Smith" />
                    <h3>Jane Smith</h3>
                    <p>Pastry Chef</p>
                </div>
                <div class="team-member">
                    <img src="../assets/img/manager.jpg" alt="Manager Mike Johnson" />
                    <h3>Mike Johnson</h3>
                    <p>Restaurant Manager</p>
                </div>
                <div class="team-member">
                    <img src="../assets/img/sommelier.jpg" alt="Sommelier Sarah Brown" />
                    <h3>Sarah Brown</h3>
                    <p>Sommelier</p>
                </div>
            </div>
        </section>
    </main>

    <?php include_once './utils/footer.php' ?>

    <script src="../assetsjs/script.js"></script>
    <script src="../assets/js/about.js"></script>
</body>
</html>
