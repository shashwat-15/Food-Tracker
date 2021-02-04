

<!-- Verify users email address, by sending email -->


<!DOCTYPE html>
<?php 
/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php file creates the registration page for the new users
*/

    //session_start();
    include "connect.php";
    include "user.php";

    $usrname = filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    $pass = filter_input(INPUT_POST,"newpwd",FILTER_SANITIZE_SPECIAL_CHARS);
    $repass = filter_input(INPUT_POST,"repwd",FILTER_SANITIZE_SPECIAL_CHARS);
    
    
    $users = [];
    $emails = [];
    $email_unique = true;
    $allUsers = "SELECT * from users";
    $stmt1 = $dbh->prepare($allUsers);
    $success1 = $stmt1->execute();

    while($success1 && $row=$stmt1->fetch()){
        $e = $row["Email"];
        //$_SESSION['email'] = $row["Email"];
        array_push($emails,$e);
        // $user = new User($row["Email"],$row["Username"],$row["Userpassword"],$row["Verified"]);
        // array_push($users,$user);
    }

    if($pass != $repass){
        echo "<p style = 'color: red;text-align: center;font-size: 24px;'> Passwords do not match</p>";
    }

    for($i=0;$i<count($emails);$i++){
        if($emails[$i] == $email){
            $email_unique = false;
            echo "<p style = 'color: red;text-align: center;font-size: 24px;'>Email already exists!</p>";
            echo "<span style = 'font-size: 24px;'>You can login <a style = 'font-size: 24px; color: blue;' href = 'login.php'>here</a></span>";
        }
    }

    if($usrname!=null && $usrname!="" && $email!=null && $email!="" && $pass!=null && $pass!="" && $pass == $repass && $email_unique){
        $pass_encode = password_hash($pass,PASSWORD_DEFAULT);
        $insertUser = "INSERT into users(Username,Userpassword,Email) values (?,?,?)";
        $stmt = $dbh->prepare($insertUser);
        $param = [$usrname,$pass_encode,$email];
        $success = $stmt->execute($param);
        
        if($success && $stmt->rowCount()){
            header("location: user_info.php?ema=$email");
            
        }
        else{
            echo "fail";
            $action = "signup.php";
        }
    }

    
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body style="background-image:url('images/food2.png'); background-size: 100%;">
    <?php 
        
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/img-01.jpg');">
        
            <div class="wrap-login100 p-t-190 p-b-30">
            <div class = "webname">Food Tracker</div>
                <form action="signup.php" method="post">
                    <!-- <label for="username">Username</label>
                    <input type="text" name = "username" id = "username">
                    <label for="pwd">Password</label>
                    <input type="password" name="pwd" id="pwd">
                    <br>
                    <input type="submit" value="Login"> -->
                    
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
                        <input class="input100" type="text" name="name" id="name" placeholder="Your Name">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-user"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Email is required">
                        <input class="input100" type="email" name="email" id="email" placeholder="Your Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-envelope"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                        <input class="input100" type="password" name="newpwd" id="newpwd" placeholder="New Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-lock"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Password does not match">
                        <input class="input100" type="password" name="repwd" id="repwd" placeholder="Re-Enter Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-lock"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn p-t-10">
                        <input class="login100-form-btn" type="submit" name = "user_info" value="Sign Up">
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>