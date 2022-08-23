<?php
include "libs/load.php";
$conn=Database::getConnection();
$outgoing_id=mysqli_real_escape_string($conn, $_POST['outgoing_id']);
$incoming_id=mysqli_real_escape_string($conn, $_POST['incoming_id']);

$ch=new Chat();

echo $ch->insert_chat($outgoing_id,$incoming_id);