<?php
//http://www.9lessons.info/2010/02/php-login-script-with-encryption.html
require_once "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$username=mysql_real_escape_string($_POST['username']); 
$password=mysql_real_escape_string($_POST['password']); 
$password=sha1($password); // Encrypted Password
$sql="SELECT collectorid FROM collector WHERE username='$username' and password='$password'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);

// If result matched $username and $password, table row must be 1 row
if($count==1)
{
//change this once we have a main page
header("location: success.php");
}
else 
{
$error="Your Login Name or Password is invalid";
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
</form>