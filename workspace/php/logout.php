<?php
include_once 'config.php';
session_start();
if (isset($_SESSION['unique_id'])) {
    $logout_id=mysqli_real_escape_string($conn, $_GET('user_id'));
    $sql=mysqli_query($conn, "update users set status='offline' where unique_id='{$logout_id}'");
    if ($sql) {
        session_unset();
        session_destroy();
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}
echo"$sql";
