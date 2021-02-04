<?php 

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php file updates the weight of the user into the database
*/
    session_start();
    include "connect.php";

    $updatedWeight = filter_input(INPUT_POST,"updwt",FILTER_VALIDATE_FLOAT);
    $updatedCalorie = filter_input(INPUT_POST,"cal",FILTER_VALIDATE_FLOAT);
    $usrid = $_SESSION["userid"];

    $updateWtQry = "UPDATE users set Userweight = ? , CalorieIntake = ? where UserId = ?";
    $stmt = $dbh->prepare($updateWtQry);
    $param = [$updatedWeight,$updatedCalorie,$usrid];
    $success = $stmt->execute($param);

?>