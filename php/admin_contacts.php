<?php
include_once '../config/Database.php';
include_once '../classes/Contact.php';

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);
$stmt = $contact->read();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Contact Messages - Village Chef</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(600px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .contact-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .contact-card:hover {
            transform: translateY(-5px);
        }
        .contact-card h3 {
            margin-top: 0;
            color: #333;
            font-size: 1.2em;
        }
        .contact-info {
            margin-bottom: 15px;
        }
        .contact-info p {
            margin: 5px 0;
            color: #666;
        }
        .contact-message {
            background-color: #5f5d5d;
            border-left: 4px solid #007bff;
            padding: 10px;
            margin-bottom: 15px;
        }
        .contact-actions {
            display: flex;
            justify-content: flex-end;
        }
        .contact-actions a {
            margin-left: 10px;
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .edit-btn {
            background-color: #28a745;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
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
    </nav>
</header>

<main>
    <section class="contact-hero">
        <h1>Admin - Contact Messages</h1>
        <p>Manage and review all contact form submissions.</p>
    </section>

    <section class="contact-content">
        <?php
        if (isset($_GET['message'])) {
            echo "<p class='success-message'>" . htmlspecialchars($_GET['message']) . "</p>";
        }
        ?>
        <div class="contact-grid">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="contact-card">
                    <h3><?php echo htmlspecialchars($row['subject']); ?></h3>
                    <div class="contact-info">
                        <p><strong>From:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                        <p><strong>Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></p>
                    </div>
                    <div class="contact-message">
                        <p><?php echo nl2br(htmlspecialchars(substr($row['message'], 0, 150))) . (strlen($row['message']) > 150 ? '...' : ''); ?></p>
                    </div>
                    <div class="contact-actions">
                        <a href="edit_contact.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete_contact.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>

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
            <p>123 Restaurant Street, Food City, FC 12345</p>
            <p>Phone: (123) 456-7890</p>
            <p>Email: info@villagechef.com</p>
        </div>
    </div>
</footer>
</body>
</html>

