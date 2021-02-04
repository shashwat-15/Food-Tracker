<?php
/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

Once the user clicks logout, he/she is directed to this page
*/

   session_start();
   
   if(session_destroy()) {
      header("Location: login.php");
   }
?>