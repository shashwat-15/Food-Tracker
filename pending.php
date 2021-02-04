
<!DOCTYPE html>
<?php 
/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.


This php file confirms that an email is sent after user enters their email if they have forgotten their password
*/

    include('send_password.php'); 
    $e = filter_input(INPUT_GET,"email",FILTER_SANITIZE_EMAIL);
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

	<form class="login-form" action="login.php" method="post" style="text-align: center;">
		<p>
			We sent an email to  <b><?php echo $e ?></b> to help you recover your account. 
		</p>
	    <p>Please login into your email account and click on the link we sent to reset your password</p>
	</form>
		
</body>
</html>