<?php

//load data from login.php and connect to mysql server
require_once 'login.php'; 
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

//generate error message if it doesn't work
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error()); 

//choose database
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());
?>

<!DOCTYPE html>
<html>
<head>
<title>Cerebro - Comic Books and Awesomeness</title>
<link type="text/css" rel="stylesheet" href="static/css/style.css">
</head>


<body>
<h1>CEREBRO!</h1>

<?php

//testing retrieving some stuff from the database
$result = mysql_query("SELECT firstname, lastname, birthyear FROM writer");
while ($row = mysql_fetch_row($result) ) {
echo (htmlentities($row[0]));
echo (htmlentities($row[1]));
echo (htmlentities($row[2]));
echo (htmlentities($row[3]));
}

?>



</body>
</html>


