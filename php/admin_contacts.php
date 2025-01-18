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

    </style>
</head>
<body>
<?php include_once './utils/navbar.php' ?>


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

<?php include_once './utils/footer.php' ?>

</body>
</html>

