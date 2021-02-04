<!DOCTYPE html>
<?php 

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php file is activated once user clicks on forgot password link. It checks if the email provided by the user exists in the database, and if it does then sends an email to the user, from where he/she can change their password
*/

  session_start();
  $errors = [];
  // connect to database
  include "connect.php";
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<?php 
/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset-password'])) {
    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
    
  // ensure that the user exists on our system
  $query = "SELECT Email FROM users WHERE Email = ?";
  $param = [$email];
  $stmt = $dbh->prepare($query);
  $success = $stmt->execute($param);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if($stmt->rowCount()<= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(60));
  $_SESSION['token'] = $token;
  $count = $stmt->rowCount();
  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_reset (email, token) VALUES (?,?)";
    $stmt1 = $dbh->prepare($sql);
    $param1 = [$email,$token];
    $success1 = $stmt1->execute($param1);

    // Send email to user with the token in a link they can click on
    $to = $email;
    $subject = "Reset your password on foodtracker.com";
    $msg = "Hi there, click on this <a href=\"localhost/finalproject/new_password.php?token=" . $token . "\">link</a> to reset your password on our site";
    $msg = wordwrap($msg,70);
    $headers = "From: shashwatkumar1996@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";
    if(mail($to, $subject,$msg, $headers)){
      echo "success";
      header('location: pending.php?email=' . $email);
    }
    else{
      echo "fail";
    }
  }
}


// ENTER A NEW PASSWORD
if (isset($_POST['new_password'])) {
  $new_pass = filter_input(INPUT_POST,"new_pass",FILTER_SANITIZE_SPECIAL_CHARS);
  $new_pass_c = filter_input(INPUT_POST,"new_pass_c",FILTER_SANITIZE_SPECIAL_CHARS);

  // Grab to token that came from the email link
  //$token = filter_input(INPUT_GET,"token",FILTER_SANITIZE_SPECIAL_CHARS);
    $token = $_SESSION['token'];

  if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
  if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_reset WHERE token=? LIMIT 1";
    $stmt2 = $dbh->prepare($sql);
    $param2 = [$token];
    $success2 = $stmt2->execute($param2);

    if($success2 && $row=$stmt2->fetch()){
        $email = $row['email'];
    }

    if ($email) {
      $new_pass = password_hash($new_pass,PASSWORD_DEFAULT);
      $sql = "UPDATE users SET Userpassword=? WHERE Email=?";
      $stmt3=$dbh->prepare($sql);
      $param3 = [$new_pass,$email];
      $success3 = $stmt3->execute($param3);
      header('location: login.php');
    }
  }
}
?>
</body>
</html>

