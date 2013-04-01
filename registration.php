<?php
require_once "db.php";
session_start();
	
if ( isset($_POST['firstname']) && isset($_POST['lastname']) &&
     isset($_POST['username']) && isset($_POST['email']) &&
	 isset($_POST['password'])) {
   $a = mysql_real_escape_string($_POST['firstname']);
   $b = mysql_real_escape_string($_POST['lastname']);
   $c = mysql_real_escape_string($_POST['username']);
   $d = mysql_real_escape_string($_POST['email']);
   $e = mysql_real_escape_string($_POST['password']);
   $f = sha1($e);
   $sql = "INSERT INTO collector (firstname, lastname, username, email, password) 
              VALUES ('$a', '$b', '$c', '$d', '$f')";
   mysql_query($sql);
   $_SESSION['success'] = 'Record Added';
   header( 'Location: index.php' ) ;
   return;
   
}
?>

<p>Register</p>
<form method="post">
<p>First name:
<input type="text" name="firstname" required></p>
<p>Last name:
<input type="text" name="lastname" required></p>
<p>Username:
<input type="text" name="username" required></p>
<p>Email:
<input type="text" name="email" required></p>
<p>Password:
<input type="password" name="password" required></p>
<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form> 