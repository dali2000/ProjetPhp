<?php
session_destroy();
unset($_SESSION['user_session']);
header('location:login.php');
?>