<?php
include "libs/load.php";
if (isset($_POST['fname']) and isset($_POST['lname']) and isset($_POST['email']) and isset($_POST['password'])) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $user=new User();
    echo $user->signup($fname,$lname,$email,$password);
}
