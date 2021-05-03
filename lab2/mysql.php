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
       if($key==$last){$query.='`'.mysqli_real_escape_string($GLOBALS['connection'],$key).'`';}
       else{$query.='`'.mysqli_real_escape_string($GLOBALS['connection'],$key).'`, ';}
    }
    $query.=") ";
    $query.='VALUES (';
    foreach ($info as $key => $value){
        if($key=="id"&&$value==" "){$query.="NULL,";} 
        else if($key==$last){$query.="'".mysqli_real_escape_string($GLOBALS['connection'],$value)."'";}
        else{$query.="'".mysqli_real_escape_string($GLOBALS['connection'],$value)."', ";}
    }
    $query.=');';
    return mysqli_query($GLOBALS['connection'],$query); 

}

function delete($id){
    $query="DELETE FROM `".$GLOBALS['db']."` WHERE id='";
    $query .=$id;
    $query .="';";
    return mysqli_query($GLOBALS['connection'],$query); 

}
function pull(){
    //var_dump($amazonID);
    $query="SELECT * FROM `".$GLOBALS['db']."`;";
    // var_dump($query);

    $result=mysqli_query($GLOBALS['connection'],$query);

    return $result;

}
function pull_with_username($username){
    //var_dump($amazonID);
    $query="SELECT * FROM `".$GLOBALS['db']."` where username='";
    $query .=$username;
    $query .="';";
    //var_dump($query);

    $result=mysqli_query($GLOBALS['connection'],$query);

    return $result;

}
function update_user($username,$info){
    $query ='UPDATE  '.$GLOBALS['db'].' SET ';

    $keys = array_keys($info);
    $last = end($keys);
    foreach ($info as $key => $value){
       if($key==$last){
           $query.='`'.mysqli_real_escape_string($GLOBALS['connection'],$key).'`=';
           $query.="'".mysqli_real_escape_string($GLOBALS['connection'],$value)."'";
        }
       else{
           $query.='`'.mysqli_real_escape_string($GLOBALS['connection'],$key).'`= ';
           $query.="'".mysqli_real_escape_string($GLOBALS['connection'],$value)."'";
           $query.=",";
        }
    }

    $query .=" where username='";
    $query .=$username;
    $query .="';";

    

    return mysqli_query($GLOBALS['connection'],$query);
}

function close_connection(){
    $connection=$GLOBALS['connection'];
    mysqli_close($connection); 
}
