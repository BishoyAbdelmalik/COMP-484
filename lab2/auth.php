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
    $username=trim($username);
    $password=trim($password);
    if(strlen($username)<=0 ||strlen($password)<=0){
        return false;
    }
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
    $username=trim($username);
    $password=trim($password);
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
$type = $data["type"];

$username = $data["username"];
$password = $data["password"];
$isAdmin = false;
if (strcmp($type, "sign-in") == 0) {
    // echo("sign in");
    if (login($username, $password)) {
        session_start();
        if(strcmp($username,"Administrator")==0){

            $isAdmin=true;
        }
        $_SESSION["admin"]=$isAdmin;
        echo (json_encode(array("status" => "sign-in success","username"=>$username,"isAdmin"=>$isAdmin)));
    } else {
        echo (json_encode(array("status" => "error signing in")));
    }
} else if (strcmp($type, "sign-up") == 0) {
    if (create_user($username, $password)) {
        echo (json_encode(array("status" => "user created")));
    } else {
        echo (json_encode(array("status" => "error creating user")));
    }
}else{
    session_start();
    $_SESSION["admin"]=false;

}

