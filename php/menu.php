<?php
include '../classes/Produit.php';
include '../classes/Categorie.php';
session_start();
$produitClass = new Produit();
$categorieClass = new Categorie();

$products = $produitClass->getProduits();
$categories = $categorieClass->getCategorie();

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

    <!-- Bootstrap CSS -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body >

    <?php include_once './utils/navbar.php' ?>
<!-- Menu Section -->
    <main>
        <section class="menu-hero">
            <h1>Our Menu</h1>
            <p>Discover our delicious offerings</p>
        </section>

        <section class="menu-content">
            <div class="menu-filters">
                <input type="text" id="search-input" placeholder="Rechercher des plats...">
                <div class="filter-buttons">
                    <?php foreach ($categories as $category): ?>
                        <button class="filter-btn" data-filter="<?php echo htmlspecialchars(strtolower($category['nomCategorie'])); ?>">
                            <?php echo htmlspecialchars($category['nomCategorie']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="menu-items">
                <?php foreach ($products as $product): ?>
                    <div class="menu-item" data-id="<?php echo $product['id']; ?>">
                        <img src="../assets/img/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo $product['nomProduit']; ?>">
                        <div class="menu-item-content">
                            <h3><?php echo $product['nomProduit']; ?></h3>
                            <h4><?php echo $product['categorie']; ?></h4>
                            <p class="price"><?php echo $product['prix']; ?>€</p>
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
    <?php include_once './utils/footer.php' ?>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/menu.js"></script>
</body>
</html>