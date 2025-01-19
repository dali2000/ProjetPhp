<?php
if (isset($_SESSION['nom'])) {
    $userId = $_SESSION['user_id'] ?? null;
    $nom = $_SESSION['nom'] ?? '';
    $prenom = $_SESSION['prenom'] ?? '';
    $role = $_SESSION['role'] ?? '';
}
?>
<header>
    <nav>
        <div class="logo">
            <div class="logo-img">
                <img class="logo-img" src="../assets/img/logo.png" alt="Village Chef Restaurant Interior" />
            </div>
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
            <div class="cart-icon"><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="../modules/auth/login.php" class="login-btn">
                    <i class="fa fa-sign-in" aria-hidden="true"></i>Login
                </a>
            <?php else: ?>
                <div class="ms-3">
                    <h4 class="mb-0"><?= htmlspecialchars($nom) . ' ' . htmlspecialchars($prenom) ?></h4>
                </div>
                <div class="cart-icon"><a href="../modules/auth/logout.php"> <i class="fa fa-sign-out" aria-hidden="true"></i></a></div>

            <?php endif; ?>
        </div>
    </nav>
</header>
