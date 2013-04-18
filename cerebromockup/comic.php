<?php
require_once "login.php";
session_start();
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error()); 
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());

$comicID=$_GET['comicID'];

$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID, subtitle, isbn, adddate, limitedseries FROM comic WHERE comicID = $comicID";

if (isset($pubselectID) && $pubselectID > 0) {
    $query .= " AND publisherID = '$pubselectID'";
}

if (isset($famselectID) && $famselectID > 0) {
    $query .= " AND familyID = '$famselectID'";
}

/*if (isset($reviewID) && $reviewID > 0) {
    $query .= "AND reviewID = '$reviewID'";
} */

//run the query and output
$result = mysql_query($query);
while ($row = mysql_fetch_row($result) ) {
$comicID = $row[7];
$seriesID = $row[0];
$publisherID = $row[1];
$familyID = $row[2];
$monthid = $row[5];
$query = mysql_query("SELECT seriestitle FROM series WHERE seriesID = '$seriesID'");
$series_row = mysql_fetch_row($query);
$query2 = mysql_query("SELECT publishername FROM publisher WHERE publisherID = '$publisherID'");
$publisher_row = mysql_fetch_row($query2);
$query3 = mysql_query("SELECT familyname FROM family WHERE familyID = '$familyID'");
$family_row = mysql_fetch_row($query3);
$query4 = mysql_query("SELECT name FROM months WHERE monthid = '$monthid'");
$month_row = mysql_fetch_row($query4);

echo('<div id="comicbox" class="grid_1"><span>');
echo('<div class="cover">'."\n");
echo('<img src="../frontend/static/images/Amazing_Spider-Man_Vol_1_688.jpg">'."\n");
echo("</div>\n");
echo('<div id="comicinfo">'."\n");
echo('<div class="rowone"><h4><span class="alignleft">'."\n");
echo($series_row[0]);
echo('<div class="rowone"><h4><span class="alignleft">'."\n");
//display subtitle
if($row[8] != NULL){
	echo($row[8]);
	echo('<div class="rowone"><h4><span class="alignleft">'."\n");
	}
echo('<div class="rowone"><span class="alignright">');
echo('Vol. ');
echo($row[3]);
echo(',&nbsp; &#35;');
echo($row[4]);
echo('</span></div>');
echo('Publisher: '.$publisher_row[0]."\n");
echo('<div class="rowone"><span class="alignleft">');
echo('Family: '.$family_row[0]);
echo('<div class="rowtwo"><span class="alignleft">');
echo('Publication Date: '.$month_row[0]."\n");
echo($row[6]);
echo('<div class="rowtwo"><span class="alignleft">');
//ISBN
if($row[9] != 0 OR NULL){ 
	echo('ISBN: '.$row[9]."\n");
}
echo('<div class="rowtwo"><span class="alignleft">');
//Do we want this in? Probably need to format it nicely if we do
echo('Added On: '.$row[10]."\n");
//Add an "In my library" feature that draws on owned
echo('<div class="rowtwo"><span class="alignleft">');
echo('(#) reviews');
echo('</span></div>');
echo('<div class="rowtwo"><span class="alignright">');
echo('(stars)');
echo('</span></div>');
echo('<div class="rowtwo"><span class="alignleft">');
if (isset($_SESSION['collectorid']) ){
 $string = "SELECT ownedID FROM owned WHERE comicID = $comicID AND collectorID = '".addslashes($_SESSION['collectorid'])."' ";
 $result3=mysql_query($string);
 $owned_result = mysql_num_rows($result3);

 if ($owned_result > 0) {
    $owned = "In My Library";
	echo $owned;
    }
 else {
    $owned = "not owned";
    }
}

echo('<div class="clear"></div>');
echo('</div>');
echo('</span></div>');
}
?>

<!DOCTYPE html>
 <head>
 	<html lang="en">
    <meta charset="UTF-8">
    <title>Cerebro - Your Brain on Comics</title>
    <base href="http://localhost/SI664/cerebromockup/">
    <link rel="stylesheet" type="text/css" href="css/styles.css" title="Default Stylesheet" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/jquery.formalize.js"></script>
 </head>
 <body>
 	<div id="wholecontainer">
    	<header>
    		<div id="header">
    		<!-- search bar -->
    		<div id="searchwrap">
        		<input id="searchbox" type="search" />
                <img src="images/searchicon.png" alt="Search Icon" height="19" width="19">
        		<a href="advancedsearch.html">Advanced Search</a>
        	</div>

        	<div id="logo">
        		<a href="index.php"><img src="images/cerebro_logo.gif" alt="Cerebro Logo"></a>
        	</div>

        	<!-- nav links -->
        	<nav>
            	<ul>
                	<li><a href="index.php">Home</a></li>
                	<li><a href="about.html">About</a></li>
                	<li><a href="signin.php">Log In</a></li>
            	</ul>
        	</nav>
        	</div>
    	</header>
	    <footer>
        	<p>&copy; 2013 Go Team Venture!</p>
    	</footer>
	</div>
 </body>
</html> 
    	