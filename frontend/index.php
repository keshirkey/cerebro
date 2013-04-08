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
<hr>
<?php

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
$string = "SELECT * FROM owned WHERE comicID = '$row[7]' AND collectorID = '5'";
$owned_result = mysql_num_rows($string);
if ($owned_result > 0) {
    $owned = "owned";
    }
else {
    $owned = "not owned";
    }

//$owned = !$owned_result ? "owned" : "not owned";
?>
<div id ="onHover">
    <p>
        <?php
        echo($owned);
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


