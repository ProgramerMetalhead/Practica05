<?php

require "config.php";
require APP_PATH . "data_access/db.php";
require APP_PATH . "register_helper.php";
require APP_PATH . "generate_password.php";

$user = filter_input(INPUT_POST, "user");
$name = filter_input(INPUT_POST,"name");
$lastname = filter_input(INPUT_POST,"lastname");
$gender = filter_input(INPUT_POST,"gender");
$birthday = filter_input(INPUT_POST,"birthday");
$rol = filter_input(INPUT_POST,"rol");
$password = filter_input(INPUT_POST, var_name: "password");

if (!$user || !$name || !$lastname || !$gender || !$birthday || !$rol || !$password) {
    echo json_encode(['message' => 'los campos no son validados', 'error' => 'not validate values']);
    exit;
}

$passwordSumary = encrypt_password($password);
$passwordEncrypt = $passwordSumary['passwordEncrypted'];
$passwordSalt = $passwordSumary['passwordSalt'];
$reg_hour = date('Y-m-d H:i:s');

$register = db_insert_user($user,$passwordEncrypt, $passwordSalt,
$name, $lastname,  $gender, $birthday, $reg_hour, $rol);

if ($register['ErrMess']){
    echo json_encode(value: $register);
    exit;
}

echo json_encode([
    'success' => true
]);
exit();

