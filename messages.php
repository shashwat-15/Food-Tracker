

<?php  

/*
Name: Shashwat Kumar
Student No.: 000790494
I certify that this is my original work.

This php file stores all the errors during the forgot password process
*/

if (count($errors) > 0) : ?>
  <div class="msg">
  	<?php foreach ($errors as $error) : ?>
  	  <span><?php echo $error ?></span>
  	<?php endforeach ?>
  </div>
<?php  endif ?>