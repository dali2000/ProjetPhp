<?php
include_once '../../config/Database.php';
include_once '../../classes/User.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$database = new Database();
$db = $database->getConnection();

$user = new \Classes\User($db);

$register_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->nom = $_POST['nom'];
    $user->prenom = $_POST['prenom'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password']; // Store password as plain text

    $user->role = 'client'; // Default role for new users

    error_log("Attempting to register user: " . $user->email);
    error_log("Password stored for user: " . $user->email); //Update: Removed old error log and added new one.


    if($user->create()) {
        error_log("User registered successfully: " . $user->email);
        header("location: login.php");
        exit();
    } else {
        error_log("Failed to register user: " . $user->email);
        $register_err = "Something went wrong. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Village Chef</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/auth.css">
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
            <li><a href="../../php/index.php">Home</a></li>
            <li><a href="../../php/about.php">About Us</a></li>
            <li><a href="../../php/menu.php">Menu</a></li>
            <li><a href="../../php/contact.php">Contact</a></li>
        </ul>
    </nav>
</header>

<!-- Registration Form -->
<main>
    <br><br><br><br><br>
    <section class="auth-form">
        <h2>Register for Village Chef</h2>
        <?php
        if (!empty($register_err)) {
            echo '<div class="alert">' . $register_err . '</div>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <label for="nom">Last Name</label>
                <input type="text" id="nom" name="nom" placeholder="Enter your last name" required>
            </div>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <label for="prenom">First Name</label>
                <input type="text" id="prenom" name="prenom" placeholder="Enter your first name" required>
            </div>
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
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
</footer>
</body>
</html>

