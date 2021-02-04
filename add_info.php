<?php 

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php files adds a new user information into the users database

*/

    session_start();
    include "connect.php";

    if(isset($_POST['user_info']))
    {
        $usremail = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    
        if(isset($_POST['user_login'])){
            $weight = filter_input(INPUT_POST,"weight",FILTER_VALIDATE_FLOAT);
            $height = filter_input(INPUT_POST,"height",FILTER_VALIDATE_FLOAT);
            $age = filter_input(INPUT_POST,"age",FILTER_VALIDATE_INT);
            $weight_goal = filter_input(INPUT_POST,"wtgoal",FILTER_VALIDATE_FLOAT);
            $dateregex = '~^\d{2}/\d{2}/\d{4}$~';
            $deadline = filter_input(INPUT_POST,"deadline");
            if($weight!=null && $weight!=0 && $height!=null && $height!=0 && $age!=null && $age!=0 && $weight_goal!=null && $weight_goal!=0 && $deadline!=null){
                
                $insertUserInfo = "INSERT into users(Userheight,Userweight,Userage,WeightGoal,Deadline) values (?,?,?,?,?) where Email = ?";
                $stmt1 = $dbh->prepare($insertUserInfo);
                $param1 = [$height,$weight,$age,$weight_goal,$deadline,$usremail];
                $success1 = $stmt1->execute($param1);
        
                if($success1 && $stmt1->rowCount()){
                    header("location: login.php");
                }
                else{
                    echo "fail";
                }
            }
        }
    }
    else{
        echo "failure";
    }
?>