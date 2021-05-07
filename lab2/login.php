<?php
header('Content-Type: application/json');
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
function login($username, $password)
{
    $result = mysqli_fetch_assoc(pull_with_username($username));
    // var_dump($result);
    if ($result == null) {
        return false;
    }
    if (!password_verify_with_rehash($username, $password, $result["password"])) {
        return false;
    }
    return true;
}
// Takes raw data from the request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json, true);
if (json_last_error() != JSON_ERROR_NONE) {
    echo (json_encode(array("status" => "invalid request")));
    die();
}
// var_dump($data);
$type = $data["type"];
// array(3) {
//     ["username"]=>
//     string(6) "bishoy"
//     ["password"]=>
//     string(4) "0011"
//     ["type"]=>
//     string(7) "sign-up"
//   }
$username = $data["username"];
$password = $data["password"];

if (strcmp($type, "sign-in") == 0) {
    // echo("sign in");
    if (login($username, $password)) {
        echo (json_encode(array("status" => "sign-in success")));
    } else {
        echo (json_encode(array("status" => "error signing in")));
    }
} else if (strcmp($type, "sign-up") == 0) {
    if (create_user($username, $password)) {
        echo (json_encode(array("status" => "user created")));
    } else {
        echo (json_encode(array("status" => "error creating user")));
    }
}

// create_user("test","password");
