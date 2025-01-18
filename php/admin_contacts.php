<?php
include_once '../config/Database.php';
include_once '../classes/Contact.php';

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);
$stmt = $contact->read();

$alert_message = '';
$alert_type = '';
$updated_id = null;
if (isset($_GET['message'])) {
    $alert_message = $_GET['message'];
    $alert_type = 'success';
    if (isset($_GET['updated_id'])) {
        $updated_id = $_GET['updated_id'];
    }
} elseif (isset($_GET['error'])) {
    $alert_message = $_GET['error'];
    $alert_type = 'error';
}
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
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .contact-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
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
            background-color: #4a4a4a;
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
        .alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            z-index: 1000;
            display: none;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }
        .alert-success {
            background-color: #28a745;
        }
        .alert-error {
            background-color: #dc3545;
        }
        @keyframes highlight {
            0% {
                background-color: #fff;
            }
            50% {
                background-color: #fffacd;
            }
            100% {
                background-color: #fff;
            }
        }
        .highlight-update {
            animation: highlight 2s ease-in-out;
        }
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
        <div class="contact-grid">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="contact-card<?php echo ($row['id'] == $updated_id) ? ' highlight-update' : ''; ?>" id="contact-<?php echo $row['id']; ?>">
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
<div id="alert" class="alert">
    <span id="alertMessage"></span>
</div>

<script>
    function showAlert(message, type) {
        const alert = document.getElementById('alert');
        const alertMessage = document.getElementById('alertMessage');

        alert.className = 'alert alert-' + type;
        alertMessage.textContent = message;
        alert.style.display = 'block';

        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    }

    <?php if ($alert_message && $alert_type): ?>
    showAlert('<?php echo addslashes($alert_message); ?>', '<?php echo $alert_type; ?>');
    <?php endif; ?>

    <?php if ($updated_id): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const updatedContact = document.getElementById('contact-<?php echo $updated_id; ?>');
        if (updatedContact) {
            updatedContact.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
    <?php endif; ?>
</script>

</body>
</html>

