<?php
//http://www.9lessons.info/2010/02/php-login-script-with-encryption.html
session_start();
require_once "login.php";
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

//generate error message if it doesn't work
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error()); 

//choose database
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());

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

$sql2="SELECT collectorID FROM collector WHERE username='$username' and password='$password'";
$result2=mysql_query($sql2);
$row2=mysql_fetch_row($result2);
var_dump($row2);
// If result matched $username and $password, table row must be 1 row
if($count==1){
 $_SESSION['username'] = $row[0];
 $_SESSION['collectorid']=$row2[0];

header("location: index.php");
}
else {
 $error="Your Login Name or Password is invalid";
 unset($_SESSION['username']);
 echo $error;
}
}
?>
<form action="signin.php" method="post">
<label>UserName :</label>
<input type="text" name="username"/><br />
<label>Password :</label>
<input type="password" name="password"/><br/>
<input type="submit" value=" Login "/><br />
<p>
Not a member yet? Click <a href='registration.php'>here </a>to register.
</p>
</form>