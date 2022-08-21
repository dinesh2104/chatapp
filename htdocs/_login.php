<?php
include "libs/load.php";
if (isset($_POST['email']) and isset($_POST['password'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $user=new User();
    echo $user->login($email,$password);
}