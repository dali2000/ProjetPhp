<?php
session_start();
include '../classes/Cammande.php';
include '../classes/ItemCommande.php';

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fonction pour logger les erreurs
function logError($message) {
    error_log(date('[Y-m-d H:i:s] ') . $message . "\n", 3, '../error.log');
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit();
}

$commande = new Cammande();
$itemsCommande = new ItemCommande();

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupère les données envoyées par le formulaire
        $totalPrice = isset($_POST['total']) ? floatval($_POST['total']) : 0.0;
        $cartItems = isset($_POST['cart_items']) ? json_decode($_POST['cart_items'], true) : [];

        if (empty($cartItems)) {
            throw new Exception('Le panier est vide');
        }

        $userId = $_SESSION['user_id'];
        $status = "en attente";

        // Prépare les données pour la commande
        $orderData = [
            'status' => $status,
            'totalPrix' => $totalPrice,
            'idClient' => $userId
        ];

        // Crée la commande
        $commandeId = $commande->create($orderData);

        if (!$commandeId) {
            throw new Exception('Erreur lors de la création de la commande');
        }

        foreach ($cartItems as $item) {
            $result = $itemsCommande->createItem($commandeId, $item['id'], $item['quantity'], $item['price']);
            if (!$result) {
                throw new Exception('Erreur lors de la création d\'un article de la commande');
            }
        }

        echo json_encode(['success' => true, 'message' => 'Commande et articles créés avec succès.']);
    } catch (Exception $e) {
        logError('Erreur: ' . $e->getMessage());
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}
?>


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
            <!-- Cart items will be dynamically added here by JavaScript -->
        </div>
        <div class="cart-summary">
            <form id="checkout-form" action="cart.php" method="POST">
                <h2>Order Summary</h2>
                <div class="summary-item">
                    <span>Subtotal:</span>
                    <input type="number" id="subtotal" name="subtotal" value="0.00" step="0.01" readonly>
                </div>
                <div class="summary-item">
                    <span>Delivery Fee:</span>
                    <input type="number" id="delivery-fee" name="delivery_fee" value="5.00" step="0.01" readonly>
                </div>
                <div class="summary-item">
                    <span>Total:</span>
                    <input type="number" id="total" name="total" value="0.00" step="0.01" readonly>
                </div>
                <input type="hidden" id="cart-items" name="cart_items" value="">
                <input type="submit" id="checkout-btn" value="Proceed to Checkout">
            </form>
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
</main>

<!-- Footer -->
<footer>
    <!-- Footer content remains unchanged -->
</footer>
<script src="../assets/js/cart.js"></script>
</body>
</html>
