<!DOCTYPE html>

<?php 

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php file inserts the user information into the database
*/

    session_start();
    include "connect.php";
    
    $weight = filter_input(INPUT_POST,"weight",FILTER_VALIDATE_FLOAT);
            $height = filter_input(INPUT_POST,"height",FILTER_VALIDATE_FLOAT);
            $age = filter_input(INPUT_POST,"age",FILTER_VALIDATE_INT);
            $weight_goal = filter_input(INPUT_POST,"wtgoal",FILTER_VALIDATE_FLOAT);
            $dateregex = '~^\d{2}/\d{2}/\d{4}$~';
            $deadline = filter_input(INPUT_POST,"deadline");
            $usremail = filter_input(INPUT_GET,"ema",FILTER_SANITIZE_EMAIL);


            if($weight!=null && $weight!=0 && $height!=null && $height!=0 && $age!=null && $age!=0 && $weight_goal!=null && $weight_goal!=0 && $deadline!=null){
                
                $cal_required = 66 + (6.3 * $weight) + (12.9 * $height) - (6.8 * $age);
                

                $insertUserInfo = "UPDATE users set Userheight = ?, Userweight = ?, Userage = ?, WeightGoal = ?, Deadline = ?, CalorieIntake = ? where Email = ?";
                $stmt1 = $dbh->prepare($insertUserInfo);
                
                $param1 = [$height,$weight,$age,$weight_goal,$deadline,$cal_required,$usremail];
                $success1 = $stmt1->execute($param1);
        
                if($success1 && $stmt1->rowCount()){
                    header("location: login.php");
                }
                else{
                    echo "email: $usremail";
                    echo "fail";
                }
            }
        
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<body style="background-image:url('images/food2.png'); background-size: 100%;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/img-01.jpg');">
        
            <div class="wrap-login100 p-t-190 p-b-30">
            <div class = "webname">Food Tracker</div>
                <form action="user_info.php?ema=<?=$usremail?>" method="post">
                    
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Weight is required">
                        <input class="input100" type="number" step = "0.01" name="weight" id="weight" placeholder="Your Weight(kg)" min =1>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-balance-scale"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Height is required">
                        <input class="input100" type="number" step = "0.01" name="height" id="height" placeholder="Your Height(cm)" min=1>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-arrows-v"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Age is required">
                        <input class="input100" type="number" name="age" id="age" placeholder="Your Age" min = 1>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-birthday-cake"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Weight Goal is required">
                        <input class="input100" type="number" step = "0.01" name="wtgoal" id="wtgoal" placeholder="Weight Goal(kg)" min =1>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-bullseye"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Deadline is required">
                        <input class="input100" type="text" onfocus="(this.type='date')" name="deadline" id="deadline" placeholder="Deadline">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fa fa-fw fa-calendar"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn p-t-10">
                        <input class="login100-form-btn" type="submit" name = "user_login" value="Submit">
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>