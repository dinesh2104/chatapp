<?php

Class User{
    private $conn;

    public function __construct()
    {
        $this->conn=Database::getConnection();
    }

    public function signup($fname,$lname,$email,$password){
        $fname=escape_stringfun($fname);
        $lname=escape_stringfun($lname);
        $email=escape_stringfun($email);
        $password=escape_stringfun($password);
        print_r($email);
        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql=mysqli_query($this->conn, "select email from users where email='{$email}'");
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
                            if (copy($tmp_name, $_SERVER['DOCUMENT_ROOT']."/asset/image/$new_img")) {
                                $status="Active";
                                $random_id=rand(time(), 10000000);

                                // Insert the data
                                $sql2=mysqli_query($this->conn, "Insert into users(unique_id,fname,lname,email,password,image,status) values('{$random_id}','{$fname}','{$lname}','{$email}','{$password}','{$new_img}','{$status}')");
                                if ($sql2) {
                                    $sql3=mysqli_query($this->conn, "select * from users where email='{$email}'");
                                    if (mysqli_num_rows($sql3)>0) {
                                        $row=mysqli_fetch_assoc($sql3);
                                        $_SESSION['unique_id']=$row['unique_id'];
                                        return "success";
                                    }
                                } else {
                                    return "No record inserted";
                                }
                            } else {
                                return "Image not moved";
                            }
                        } else {
                            return "please select an image file .jpeg .jpg .png";
                        }
                    } else {
                        return "Please select an image";
                    }
                }
            } else {
                return " $email-Please enter valid email";
            }
        } else {
            return "Please enter all required fields";
        }

    }

    public function login($email,$password){
        $email=escape_stringfun($email);
        $password=escape_stringfun($password);

        if (!empty($email)&&!empty($password)) {
            $sql=mysqli_query($this->conn, "select * from users where email='{$email}' and password='{$password}'");
            if (mysqli_num_rows($sql)>0) {
                $row=mysqli_fetch_assoc($sql);
                $_SESSION['unique_id']=$row['unique_id'];
                echo "success";
            } else {
                echo "Incorrect Email and Password";
            }
        } else {
            echo "Please enter data in all the field";
        }
    }

    public function logout(){
        if (isset($_SESSION['unique_id'])) {
            $logout_id=mysqli_real_escape_string($this->conn, $_GET('user_id'));
            $sql=mysqli_query($this->conn, "update users set status='offline' where unique_id='{$logout_id}'");
            if ($sql) {
                Session::unset();
                Session::destroy();
                header("location: ../login.php");
            }
        } else {
            header("location: ../login.php");
        }
        echo"$sql";
    }

    public function get_user(){
        $outgoing_id=$_SESSION['unique_id'];
        $sql=mysqli_query($this->conn, "select * from users");
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
    }
}