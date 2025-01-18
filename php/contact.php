<?php
include_once '../config/Database.php';
include_once '../classes/Contact.php';

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact->name = $_POST['name'];
    $contact->email = $_POST['email'];
    $contact->subject = $_POST['subject'];
    $contact->message = $_POST['message'];

    if($contact->create()) {
        $success_message = "Your message has been sent successfully!";
    } else {
        $error_message = "Unable to send your message. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Village Chef</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php include_once './utils/navbar.php' ?>


    <!-- Contact Section -->
    <main>
        <section class="contact-hero">
            <h1>Get in Touch</h1>
            <p>We'd love to hear from you! Reach out for any questions or feedback.</p>
        </section>

        <section class="contact-content">
            <div class="contact-form">
                <h2>Send us a message</h2>
                <?php if(isset($success_message)): ?>
                    <div class="alert alert-success">
                        <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                <?php if(isset($error_message)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form id="contactForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
            <div class="contact-info">
                <h2>Contact Information</h2>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>123 Restaurant Street, Food City, FC 12345</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <p>(123) 456-7890</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>info@villagechef.com</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <p>Mon-Fri: 9am-10pm, Sat-Sun: 10am-11pm</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include_once './utils/footer.php' ?>


</body>
</html>
