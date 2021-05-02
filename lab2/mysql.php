<?php
$db='user';

//    global  $connection;
$dbhost="localhost";
$dbuser="bishoy";
$dbpass='0011';
$dbname="users";
$connection= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(mysqli_connect_errno()){
die("Database connection failes: ".
mysqli_connect_error(). " (" . mysqli_connect_errno().")"
);
}


function insert($info){
    $query="INSERT INTO `".$GLOBALS['db']."` (";
    $keys = array_keys($info);
    $last = end($keys);
    foreach ($info as $key => $value){
       if($key==$last){$query.='`'.$key.'`';}
       else{$query.='`'.mysqli_real_escape_string($GLOBALS['connection'],$key).'`, ';}
    }
    $query.=") ";
    $query.='VALUES (';
    foreach ($info as $key => $value){
        if($key=="id"&&$value==" "){$query.="NULL,";} 
        else if($key==$last){$query.="'".$value."'";}
        else{$query.="'".mysqli_real_escape_string($GLOBALS['connection'],$value)."', ";}
    }
    $query.=');';
    mysqli_query($GLOBALS['connection'],$query); 

}

function delete($id){
    $query="DELETE FROM `".$GLOBALS['db']."` WHERE id='";
    $query .=$id;
    $query .="';";
    mysqli_query($GLOBALS['connection'],$query); 

}
function pull(){
    //var_dump($amazonID);
    mysqli_free_result($result);
    $query="SELECT * FROM `".$GLOBALS['db']."`;";
    // var_dump($query);

    $result=mysqli_query($GLOBALS['connection'],$query);

    return $result;

}
function pullWithUsername($username){
    //var_dump($amazonID);
    mysqli_free_result($result);
    $query="SELECT * FROM `".$GLOBALS['db']."` where username='";
    $query .=$username;
    $query .="';";
    //var_dump($query);

    $result=mysqli_query($GLOBALS['connection'],$query);

    return $result;

}


function closeConnection(){
    $connection=$GLOBALS['connection'];
    mysqli_close($connection); 
}
