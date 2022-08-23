<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header('location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                include_once "libs/load.php";
                $conn=Database::getConnection();
                $sql=mysqli_query($conn, "Select * from users where unique_id={$_SESSION['unique_id']}");
                if (mysqli_num_rows($sql)>0) {
                    $row=mysqli_fetch_assoc($sql);
                }

                ?>
                <div class="content">
                    <img src="asset/image/<?=$row['image']?>"
                        alt="">
                    <div class="details">
                        <span><?=$row['fname']." ".$row['lname']?></span>
                        <p><?=$row['status']?>
                        </p>
                    </div>
                </div>
                <a href="logout.php?user_id=<?=$row['unique_id']?>"
                    class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search..">
                <button><i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>
    <script src="asset/js/users.js"></script>
</body>

</html>