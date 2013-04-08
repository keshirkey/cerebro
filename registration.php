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
   
   if(empty($_POST['username']) || empty($_POST['firstname']) || empty($_POST['lastname'])
    || empty($_POST['email']) || empty($_POST['password'])){
    echo '<b>Please fill out all fields.</b>';
   }else{
    $dup = mysql_query("SELECT username FROM collector WHERE username='".$c."'");
	$dup2 = mysql_query("SELECT email FROM collector WHERE email='".$d."'");
    if(mysql_num_rows($dup) >0){
     echo '<b>Username Already Used.</b>';
    }
	elseif(mysql_num_rows($dup2) >0){
	 echo '<b>Email Address Already in Use.</b>';
	} 

	else{	
     $sql = "INSERT INTO collector (firstname, lastname, username, email, password) 
              VALUES ('$a', '$b', '$c', '$d', '$f')";
     mysql_query($sql);
     $_SESSION['success'] = 'Record Added';
     header( 'Location: index.php' ) ;
     return;
	}   
}
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