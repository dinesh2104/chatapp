<?php
include_once 'config.php';

$searchTerm=mysqli_real_escape_string($conn, $_POST['searchTerm']);
