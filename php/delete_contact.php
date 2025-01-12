<?php
include_once '../config/Database.php';
include_once '../classes/Contact.php';

$database = new Database();
$db = $database->getConnection();

$contact = new Contact($db);

if (isset($_GET['id'])) {
    $contact->id = $_GET['id'];

    if($contact->delete()) {
        header("Location: admin_contacts.php?message=Contact deleted successfully");
    } else {
        header("Location: admin_contacts.php?message=Unable to delete contact");
    }
} else {
    header("Location: admin_contacts.php?message=No ID specified");
}


