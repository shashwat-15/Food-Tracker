<?php 

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php gets the calories of the selected food item from the database and passes the data to calorie.js file
*/
    session_start();
    include "connect.php";

    $food_name = filter_input(INPUT_POST,"food",FILTER_SANITIZE_STRING);
    //$usrid = $_SESSION["userid"];


    $updateWtQry = "SELECT FoodCalorie from food where FoodName = ?";
    $stmt = $dbh->prepare($updateWtQry);
    $param = [$food_name];
    $success = $stmt->execute($param);


    if($success && $row=$stmt->fetch()){
        $calorie = $row["FoodCalorie"];
        //$intcalorie = (int)$calorie;
    }

    echo $calorie;
?>