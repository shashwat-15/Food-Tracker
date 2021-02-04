<!DOCTYPE html>
<?php 
/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php file serves as the login page for the existing users
*/

    session_start();
    include "connect.php";

    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST,"pass",FILTER_SANITIZE_SPECIAL_CHARS);
    $height = filter_input(INPUT_POST,"height",FILTER_VALIDATE_FLOAT);

    echo $height;

    if($email!=null && $email!="" && $pass!=null && $pass!=""){
        $verifyUser = "SELECT UserId from users where Email = ?";
        $stmt = $dbh->prepare($verifyUser);
        $param = [$email];
        $success = $stmt->execute($param);
    
        $count = $stmt->rowCount();
        if($success && $count == 1 && $row1=$stmt->fetch()){
            $_SESSION["userid"] = $row1["UserId"];
            $verifyPassword = "SELECT Userpassword from users where Email = ?";
            $stmt1 = $dbh->prepare($verifyPassword);
            $param1 = [$email];
            $success1 = $stmt1->execute($param1);

            if($success1 && $row=$stmt1->fetch()){
                $secretPass = $row['Userpassword'];
                if(password_verify($pass, $secretPass)){ //password field length in database should be 60 for this to work!
                    header("location: home.php?email=$email");
                }
                else{
                    session_unset();
                    session_destroy();
                    echo "<p style = 'color: red;text-align: center;font-size: 24px;'>Wrong Password!</p>";
                }
            }
        }
        else{
            session_unset();
            session_destroy();
            echo "<p style = 'color: red;text-align: center;font-size: 24px;'>Email does not exist</p>";
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body style="background-image:url('images/food2.png'); background-size: 100%;">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/img-01.jpg');">
    
        <div class="wrap-login100 p-t-190 p-b-30">
        <div class = "webname">Food Tracker</div>
            <form action="" method="post" id = "login_form">
                <!-- <label for="username">Username</label>
                <input type="text" name = "username" id = "username">
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd">
                <br>
                <input type="submit" value="Login"> -->

                <div class="wrap-input100 validate-input m-b-10" data-validate = "Email is required">
                    <input class="input100" type="email" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                    <i class="fa fa-fw fa-envelope"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                    <input class="input100" type="password" name="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                    <i class="fa fa-fw fa-lock"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn p-t-10">
                    <input class="login100-form-btn" type="submit" value="Login">
                </div>

                <div class="spacing">
                    <a href="enter_email.php" class="txt1">
                        Forgot Username / Password?
                    </a>
                </div>

                <div class="spacing">
                    <a class="txt1" href="signup.php">
                        Create new account
                        <i class="fa fa-fw fa-arrow-right"></i>						
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>