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
 <head>
 	<html lang="en">
    <meta charset="UTF-8">
    <title>Cerebro - Your Brain on Comics</title>
    <base href="http://localhost:8888/cerebro/cerebromockup/">
    <link rel="stylesheet" type="text/css" href="css/styles.css" title="Default Stylesheet" media="all"/>
 </head>
 <body>
 	<div id="wholecontainer">
    	<header>
    		<div id="header">
    		<div id="searchwrap">
        		<input id="searchbox" type="search" /><img src="images/searchicon.png" alt="Search Icon" height="19" width="19">
        		<a href="advancedsearch.html">Advanced Search</a>
        	</div>

        	<div id="logo">
        		<img src="images/cerebro_logo.gif" alt="Cerebro Logo" height="116" width="250">
        	</div>

        	<nav>
            	<ul>
                	<li><a href="index.html">Home</a></li>
                	<li><a href="about.html">About</a></li>
                	<li><a href="login.html">Log In</a></li>
            	</ul>
        	</nav>
        	</div>
    	</header>
    	
    	<section id="maincontent">
    		<div id="rowone">
    			<p id="pleft">Sort by most recently:</p> <p id="pright">Filter by:</p>
    		</div>
    		
    		<div id="rowtwo">
    			<ul>
    				<li><a href="index.php?sort=publish">Published</a></li>
    				<li><a href="index.php?sort=add">Added</a></li>
    				<li><a href="index.php?sort=review">Reviewed</a></li>
    			</ul>

    			<div id="filters">
    				<select>
    					<option value="publisher">- Publisher -</option>
    				</select>

    				<select>
    					<option value="family">- Family -</option>
    				</select>

    				<select>
    					<option value="ratings">- Ratings -</option>
    				</select>
    			</div>
    		</div>

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

//clean user input and put into sort variable
if (isset($_GET['sort'])) {

function get_sort($var) {
    if (!isset($_GET[$var]) && strlen($_GET[$var]) < 1) {return false;}
    return mysql_real_escape_string($_GET[$var]);
    }
    
$sort = get_sort('sort');
}
    
//check the value of the sort variable and set query based on it    
if ($sort == "add") {
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY adddate DESC";
}

elseif ($sort == "review") {
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY ";
}

elseif ($sort == "publish") {
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY pubyear DESC, monthid DESC";
}
     
else {
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY pubyear DESC, monthid DESC";
}

//run the query and output
$result = mysql_query($query);
while ($row = mysql_fetch_row($result) ) {
$seriesID = $row[0];
$query = mysql_query("SELECT seriestitle FROM series WHERE seriesID = '$seriesID'");
$series_row = mysql_fetch_row($query);
echo('<div class="grid_1"><span>');
?>

<div class="cover">
    <img src="../frontend/static/images/Amazing_Spider-Man_Vol_1_688.jpg" height="400">
</div>

<div id="textbox">
    <p class="alignleft">

<?php
echo($series_row[0]);
echo('</p><p class="alignright">');
echo($row[3]);
echo(", &nbsp");
echo($row[4]);
echo("</p>");
echo('<div class="clear"></div></div>');
echo("</span></div>");


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
}

?>
    	</section>

    	<footer>
        	<p>&copy; 2013 Go Team Venture!</p>
    	</footer>
	</div>
 </body>
</html>