<?php
//http://www.9lessons.info/2010/02/php-login-script-with-encryption.html
session_start();
require_once "db.php";

if(isset($_POST['username']) && isset($_POST['password'])  )
{
// username and password sent from Form
$username=mysql_real_escape_string($_POST['username']); 
$password=mysql_real_escape_string($_POST['password']); 
$password=sha1($password); // Encrypted Password
$sql="SELECT username FROM collector WHERE username='$username' and password='$password'";

$result=mysql_query($sql);
$count=mysql_num_rows($result);
$row=mysql_fetch_row($result);
var_dump($row);
// If result matched $username and $password, table row must be 1 row
if($count==1){
 $_SESSION['username'] = $row[0];
//change this once we have a main page
header("location: success.php");
}
else {
 $error="Your Login Name or Password is invalid";
 unset($_SESSION['username']);
 echo $error;
}
}
?>
<form action="login.php" method="post">
<label>UserName :</label>
<input type="text" name="username"/><br />
<label>Password :</label>
<input type="password" name="password"/><br/>
<input type="submit" value=" Login "/><br />
<p>
Not a member yet? Click <a href='registration.php'>here </a>to register.
</p>
</form>