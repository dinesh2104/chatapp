<?php
session_start();
include_once 'config.php';

$fname=mysqli_real_escape_string($conn, $_POST['fname']);
$lname=mysqli_real_escape_string($conn, $_POST['lname']);
$email=mysqli_real_escape_string($conn, $_POST['email']);
$password=mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql=mysqli_query($conn, "select email from users where email='{$email}'");
        if (mysqli_num_rows($sql)>0) {
            echo "$email already exist";
        } else {
            if (isset($_FILES['image'])) {
                $img_name=$_FILES['image']['name'];
                $img_type=$_FILES['image']['type'];
                $tmp_name=$_FILES['image']['tmp_name'];

                $img_explode=explode('.', $img_name);
                $img_ext=end($img_explode);

                $extension=['png','jpeg','jpg'];
                if (in_array($img_ext, $extension)==true) {
                    $time=time();
                    $new_img=$time.$img_name;
                    if (copy($tmp_name, __DIR__."/images/$new_img")) {
                        $status="Active";
                        $random_id=rand(time(), 10000000);

                        // Insert the data
                        $sql2=mysqli_query($conn, "Insert into users(unique_id,fname,lname,email,password,image,status) values('{$random_id}','{$fname}','{$lname}','{$email}','{$password}','{$new_img}','{$status}')");
                        if ($sql2) {
                            $sql3=mysqli_query($conn, "select * from users where email='{$email}'");
                            if (mysqli_num_rows($sql3)>0) {
                                $row=mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id']=$row['unique_id'];
                                echo "success";
                            }
                        } else {
                            echo "No record inserted";
                        }
                    } else {
                        echo "Image not moved";
                    }
                } else {
                    echo "please select an image file .jpeg .jpg .png";
                }
            } else {
                echo "Please select an image";
            }
        }
    } else {
        echo " $email-Please enter valid email";
    }
} else {
    echo "Please enter all required fields";
}
