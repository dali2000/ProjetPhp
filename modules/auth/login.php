<?php
session_start();
include_once '../../config/Database.php';
include_once '../../classes/User.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$database = new Database();
$db = $database->getConnection();

$user = new \Classes\User($db);

$login_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    error_log("Login attempt for email: " . $email);

    $query = "SELECT * FROM user WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("User found in database for email: " . $email);

        if ($password === $row['password']) {
            error_log("Login successful for user: " . $email);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("location: ../../php/menu.php");
            exit();
        } else {
            error_log("Login failed for user: " . $email);
            $login_err = "Invalid email or password.";
        }
    } else {
        error_log("No user found with email: " . $email);
        $login_err = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Village Chef</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<!-- Header -->
<header>
    <nav>
        <div class="logo">
            <div class="logo-img"> <img class="logo-img" src="../../assets/img/logo.png" alt="Village Chef Restaurant Interior" /></div>
            <span><span class="highlight">Village</span> CHEF</span>
        </div>
        <ul class="nav-links">
            <li><a href="../../php/index.php">Home</a></li>
            <li><a href="../../php/about.php">About Us</a></li>
            <li><a href="../../php/menu.php">Menu</a></li>
            <li><a href="../../php/contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- Login Form -->
<main>
    <div class="container">
        <div class="auth-form">
            <h2>Login to Village Chef</h2>
            <!-- Display Error Message -->
            <?php if (!empty($login_err)) : ?>
                <div class="alert"><?php echo $login_err; ?></div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>

            <!-- Additional Links -->
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
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
                <li><a href="../../php/index.php">Home</a></li>
                <li><a href="../../php/about.php">About Us</a></li>
                <li><a href="../../php/menu.php">Menu</a></li>
                <li><a href="../../php/contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>123 Restaurant Street, Food City, FC 12345</p>
            <p>Phone: (123) 456-7890</p>
            <p>Email: info@villagechef.com</p>
        </div>
    </div>

    <div class="falling-icons">
        <i class="fa fa-bars hamburger-icon"></i>
        <i class="fa-solid fa-pizza-slice pizza-icon"></i>
    </div>
</footer>
</body>
</html>

