<?php

require "config.php";
require APP_PATH . "data_access/db.php";
require APP_PATH . "register_helper.php";

$user = filter_input(INPUT_POST, "user");
$name = filter_input(INPUT_POST,"name");
$lastname = filter_input(INPUT_POST,"lastname");
$gender = filter_input(INPUT_POST,"gender");
$birthday = filter_input(INPUT_POST,"birthday");
$password = filter_input(INPUT_POST, var_name: "password-encrypt");

if (!$user || !$name || !$lastname || !$gender || !$birthday || !$password) {
    echo json_encode(['message' => 'los campos no son validados', 'error' => 'not validate values']);
}

$passwordSumary = encrypt_password($password);
$passwordEncrypt = $passwordSumary['passwordEncrypted'];
$passwordSalt = $passwordSumary['passwordMasSalt'];
$reg_hour = date('Y-m-d H:i:s');

$register = db_insert_user($name,$passwordEncrypt, $passwordSalt,
$name, lastname: $lastname, gender: $gender, birthday: $birthday, reg_hour: $reg_hour);

if ($register['error'] != 0){
    echo json_encode($register);
}

