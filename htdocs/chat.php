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
        <section class="chat-area">
            <header>
                <?php
                include_once "libs/load.php";
                $conn=Database::getConnection();
                $user_id=mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql=mysqli_query($conn, "Select * from users where unique_id={$user_id}");
                if (mysqli_num_rows($sql)>0) {
                    $row=mysqli_fetch_assoc($sql);
                }

                ?>
                <a href="users.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="asset/image/<?=$row['image']?>"
                    alt="">
                <div class="details">
                    <span><?=$row['fname']." ".$row['lname']?></span>
                    <p><?=$row['status']?>
                    </p>
                </div>
            </header>
            <div class="chat-box">


            </div>
            <form action="#" class="typing-area">
                <input type='hidden' name='outgoing_id'
                    value="<?php echo $_SESSION['unique_id']?>">
                <input type='hidden' name='incoming_id'
                    value="<?php echo $user_id?>">
                <input type="text" name='message' class='input-field' placeholder="Type your message">
                <input type="submit" class="button">
            </form>
        </section>
    </div>
    <script src="asset/js/chat.js"></script>
</body>

</html>