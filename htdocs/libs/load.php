<?php
include_once("includes/Database.class.php");
include_once("includes/Chat.class.php");
include_once("includes/Session.class.php");
include_once("includes/Usersession.class.php");
include_once("includes/User.class.php");


// $data=scandir("includes/");
// foreach($data as $d){
//     if($d=='.' or $d=='..'){
//         continue;
//     }else{    
//         include_once('includes/'.$d);
//     }
// }

Session::start();

$config_file=file_get_contents($_SERVER['DOCUMENT_ROOT']."/../workspace/env.json");
// print($config_file);

function get_config($key,$default=NULL){
    global $config_file;
    $data=json_decode($config_file,true);
    if(isset($data[$key])){
        return $data[$key];
    }else{
        return $default;
    }
}

function escape_stringfun($data){
    return mysqli_escape_string(Database::$conn,$data);
}



