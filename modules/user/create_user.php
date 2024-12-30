<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new \Classes\User($db);

$data = json_decode(file_get_contents("php://input"));

$user->nom = $data->nom;
$user->prenom = $data->prenom;
$user->email = $data->email;
$user->password = password_hash($data->password, PASSWORD_DEFAULT); // Hash the password
$user->role = $data->role;

if($user->create()) {
    echo json_encode(
        array('message' => 'User Created')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Created')
    );
}

