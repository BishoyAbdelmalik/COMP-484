<?php
include_once 'mysql.php';

function password_verify_with_rehash($username, $password, $hash)
{
    if (!password_verify($password, $hash)) {
        return false;
    }

    if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = array("password" => $hash);
        update_user($username, $user);
    }

    return true;
}

function create_user($username, $password)
{
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $user = array("username" => $username, "password" => $hash);
    $result = insert($user);
    close_connection();
    if (!$result) {
        return false;
    }
    return true;
}
// Takes raw data from the request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);
if (json_last_error() != JSON_ERROR_NONE) {
    die("invalid request2");
}
var_dump($data);


// create_user("test","password");
