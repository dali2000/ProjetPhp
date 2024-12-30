<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new \Classes\User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

$user->read_single();

$user_arr = array(
    'id' => $user->id,
    'nom' => $user->nom,
    'prenom' => $user->prenom,
    'email' => $user->email,
    'role' => $user->role
);

print_r(json_encode($user_arr));


?>

