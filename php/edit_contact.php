<?php
include_once '../config/Database.php';
include_once '../classes/Contact.php';

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact->id = $_POST['id'];
    $contact->name = $_POST['name'];
    $contact->email = $_POST['email'];
    $contact->subject = $_POST['subject'];
    $contact->message = $_POST['message'];

    if($contact->update()) {
        $success_message = "Contact updated successfully.";
    } else {
        $error_message = "Unable to update contact. Please try again.";
    }
} elseif (isset($_GET['id'])) {
    $stmt = $contact->read($_GET['id']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
        $contact->id = $row['id'];
        $contact->name = $row['name'];
        $contact->email = $row['email'];
        $contact->subject = $row['subject'];
        $contact->message = $row['message'];
    } else {
        echo "No contact found with this ID.";
        exit;
    }
} else {
    echo "No ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact - Village Chef</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <h1>Edit Contact</h1>
        <p>Update the contact information below.</p>
    </section>

    <section class="contact-content">
        <div class="contact-form">
            <?php
            if (isset($success_message)) {
                echo "<p class='success-message'>$success_message</p>";
            } elseif (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $contact->id; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $contact->name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $contact->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" value="<?php echo $contact->subject; ?>" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required><?php echo $contact->message; ?></textarea>
                </div>
                <button type="submit" class="submit-btn">Update Contact</button>
            </form>
            <a href="admin_contacts.php" class="back-link">Back to Contacts List</a>
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

