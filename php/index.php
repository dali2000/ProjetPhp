<?php

session_start();


?>
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
    <?php include_once './utils/navbar.php' ?>


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
    <?php include_once './utils/footer.php' ?>


    <script src="../assets/js/script.js"></script>
</body>
</html>