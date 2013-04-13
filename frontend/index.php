<?php
session_start();
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

<hr>
<?php
if (!isset($_SESSION['username'])){
 echo('<p><a href="registration.php">Register</a></p>');
 echo('<p><a href="signin.php">Log In</a></p>');
}
//will allow identification of users via session; currently displaying only this when session is set
if ( isset($_SESSION['username']) ) {
   echo('<p>Welcome '.htmlentities($_SESSION['username']). ' You have logged in.</p>'."\n");
   echo('<p><a href="logout.php">Logout</a></p>'."\n");
   
}
$result = mysql_query("SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY pubyear DESC, monthid DESC");

while ($row = mysql_fetch_row($result) ) {
$seriesID = $row[0];
$query = mysql_query("SELECT seriestitle FROM series WHERE seriesID = '$seriesID'");
$series_row = mysql_fetch_row($query);
echo($series_row[0]);
echo("<br/>");
echo($row[3]);
echo("<br/>");
echo($row[4]);
echo("<br/><br/>");


if (isset($_SESSION['collectorid']) ){
 $string = "SELECT ownedID FROM owned WHERE comicID = '$row[7]' AND collectorID = '".addslashes($_SESSION['collectorid'])."' ";
 $result3=mysql_query($string);

 $owned_result = mysql_num_rows($result3);

 if ($owned_result > 0) {
    $owned = "owned";
	
    }
 else {
    $owned = "not owned";
    }
echo $owned;	
	
}

?>
<div id ="onHover">
    <p>
        <?php
 //       echo($owned);
        echo("<br/>");
        ?>
    review<br/>
    add to list<br/>
    </p>
</div>

    <?php
    }
    ?>

</body>
</html>


