<?php
session_start();
include_once 'config.php';
$outgoing_id=$_SESSION['unique_id'];
$sql=mysqli_query($conn, "select * from users");
$output="";
if (mysqli_num_rows($sql)==1) {
    $output .="No users are available";
} elseif (mysqli_num_rows($sql)>0) {
    while ($row=mysqli_fetch_assoc($sql)) {
        if ($row['unique_id']!=$outgoing_id) {
            $output .= '<a href="chat.php?user_id='.$row['unique_id'].  '">
        <div class="content">
            <div class="details">
                <span>'.$row['fname']." ".$row['lname'].'</span>
                <p>'.$row['status'].'</p>
            </div>
        </div>
        <div class="status-dot"><i class="fa fa-circle offline"></i></div>
    </a>';
        }
    }
}
echo "$output";
