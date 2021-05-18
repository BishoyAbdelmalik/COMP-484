<?php
$db = 'user';

//    global  $connection;
$dbhost = "localhost";
$dbuser = "bishoy";
$dbpass = '0011';
$dbname = "users";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
    die("Database connection failes: " .
        mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}

function insert($info)
{
    $db = $GLOBALS['db'];

    $query = "INSERT INTO `$db` (";
    $keys = array_keys($info);
    $last = end($keys);
    foreach ($info as $key => $value) {
        if ($key == $last) {
            $query .= '`' . mysqli_real_escape_string($GLOBALS['connection'], $key) . '`';
        } else {
            $query .= '`' . mysqli_real_escape_string($GLOBALS['connection'], $key) . '`, ';
        }
    }
    $query .= ") ";
    $query .= 'VALUES (';
    foreach ($info as $key => $value) {
        if ($key == "id" && $value == " ") {
            $query .= "NULL,";
        } else if ($key == $last) {
            $query .= "'" . mysqli_real_escape_string($GLOBALS['connection'], $value) . "'";
        } else {
            $query .= "'" . mysqli_real_escape_string($GLOBALS['connection'], $value) . "', ";
        }
    }
    $query .= ');';
    return mysqli_query($GLOBALS['connection'], $query);
}
function pull()
{
    $db = $GLOBALS['db'];
    $query = "SELECT * FROM `$db` ORDER BY username ASC;";
    $result = mysqli_query($GLOBALS['connection'], $query);
    return $result;
}
function pull_with_username($username)
{
    $db = $GLOBALS['db'];
    $username = mysqli_real_escape_string($GLOBALS['connection'],$username);
    $query = "SELECT * FROM `$db` where username='$username';";

    $result = mysqli_query($GLOBALS['connection'], $query);

    return $result;
}

function close_connection()
{
    $connection = $GLOBALS['connection'];
    mysqli_close($connection);
}
