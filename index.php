<?php

require "database.php";
require "model/user.php";

session_start();
if(isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];
   

    $user = new User(null, $uname, $upass);
    $response = User::logIn($user);
    $row=mysqli_fetch_array($response);

    if($response->num_rows==1) {
        echo '<script>
        console.log("Login success");
    </script>';
    $user->id=$row[0];
    $_SESSION['user_id'] = $user->id;  

    header('Location: home.php');
    exit();
    }else {
        echo '<script language="javascript">
        console.log("Login fail");
    </script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>LearnIT Flashcards</title>
</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <h3>Login page</h3>
                    <label class="username">Username</label>
                    <input type="text" name="username" class="form-control"  required>
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Log in</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>