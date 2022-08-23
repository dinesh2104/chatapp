<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-text" hidden></div>
                <div class="name-details">
                    <div class="field">
                        <label>First Name</label>
                        <input type="text" name='fname' placeholder="First Name" required>
                    </div>
                    <div class="field">
                        <label>Last Name</label>
                        <input type="text" name='lname' placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field">
                    <label>Email</label>
                    <input type="text" name='email' placeholder="Email" required>
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="password" name='password' placeholder="New Password" required>
                </div>
                <div class="field">
                    <label>Select Image</label>
                    <input type="file" name='image' required>
                </div>
                <div class="field button  ">
                    <input type="submit" value="Start chat">
                </div>
                <div class="link ">Already signed up? <a href="login.php">Login now</a></div>
            </form>
        </section>
    </div>
    <script src="asset/js/signup.js"></script>
</body>

</html>