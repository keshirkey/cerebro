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
        		<input id="searchbox" type="search" />
                <img src="images/searchicon.png" alt="Search Icon" height="19" width="19">
        		<a href="advancedsearch.html">Advanced Search</a>
        	</div>

        	<div id="logo">
        		<img src="images/cerebro_logo.gif" alt="Cerebro Logo">
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
    		<div id="filtertext">
                <p class="alignleft">Sort by most recently:</p> 
                <p class="alignright">Filter by:</p>
                <div class="clear"></div>
            </div>
    		
    		<div id="filters">
                <ul id="filtersleft" class="alignleft">
                    <li><a href="index.php?sort=publish">Published</a></li>
                    <li><a href="index.php?sort=add">Added</a></li>
                    <li><a href="index.php?sort=review">Reviewed</a></li>
                </ul>

    			<div id="filtersright" class="alignright">
                    <form name="filters" method="post" action="index.php">
                        <select name="publisher" id = "publisher" onchange="submit();">
    				 
    				    <?php 
    					    //populate publisher dropdown from database
                            //display blank option if no POST data
                            if (!isset($_POST['publisher']) || $_POST['publisher'] == "") {echo('<option value="" selected = "selected">- Publisher -</option>\n');}
                            $query = "SELECT publisherID, publishername FROM publisher WHERE publishername IS NOT NULL";
                            $result = mysql_query($query);
                            //output as dropdown options
                            while ($row = mysql_fetch_row($result)) {
                                //determine if a selected option should be kept in dropdown
                                if ($row[0] == $_POST['publisher']) {$selected = "selected = \"selected\"";}
                                else {$selected = "";}
                                echo('<option value="'.$row[0].'"'.$selected.'>'.$row[1].'</option>');
                                echo("\n");
                            }
    				    ?>
    				
    				    </select>

    				    <select name="family" id="family" onchange="submit();">
    					
                            <?php 
    					       //populate family dropdown from database
                                //display blank option if no POST data
                                if (!isset($_POST['family']) || $_POST['family'] == "") {echo('<option value="" selected = "selected">- Family -</option>');echo("\n");}
                                $query = "SELECT familyID, familyname FROM family WHERE familyname IS NOT NULL";
                                $result = mysql_query($query);
                                //output as dropdown options
                                while ($row = mysql_fetch_row($result)) {
                                    //determine if a selected option should be kept in dropdown
                                    if ($row[0] == $_POST['family']) {$selected = "selected = \"selected\"";}
                                    else {$selected = "";}
                                    echo('<option value="'.$row[0].'"'.$selected.'>'.$row[1].'</option>');
                                    echo("\n");
                                }
    				        ?>
                            
    				    </select>

    				    <select>
    					   <option value="ratings">- Ratings -</option>
    					   <option value = "5">5 stars</option>
    					   <option value = "4">4 stars</option>
    					   <option value = "3">3 stars</option>
    					   <option value = "2">2 stars</option>
    					   <option value = "1">1 stars</option>
    				    </select>
                    </form>
                </div>

                <div class="clear"></div>

                <div id="clearlink" class="alignright">
                    <a href="index.php">Clear Filters</a>


                </div>
            </div>

            <div class="clear"></div>

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

//check for POST data from filters and put into variables    
    
if (isset($_POST['publisher'])) {$pubselectID = get_post('publisher');}

if (isset($_POST['family'])) {$famselectID = get_post('family');}

function get_post($var) {
    if (!isset($_POST[$var]) && strlen($_POST[$var]) < 1) {return false;}
    return mysql_real_escape_string($_POST[$var]);
    }
    
//check the value of the sort variable and filter variables and set query based on it    
if (isset($sort) && $sort == "add") {
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY adddate DESC";
}

elseif (isset($sort) && $sort == "review") {
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY ";
}

elseif (isset($sort) && $sort == "publish") {
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic ORDER BY pubyear DESC, monthid DESC";
}

elseif (isset($pubselectID) && $pubselectID > 0) {
    $query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic WHERE publisherID = '$pubselectID'";
}

elseif (isset($famselectID) && $famselectID > 0) {
    $query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic WHERE familyID = '$famselectID'";
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
    <img src="../frontend/static/images/Amazing_Spider-Man_Vol_1_688.jpg">
</div>

<div id="comicinfo">
    <div class="rowone"><h4><span class="alignleft">
<?php
echo($series_row[0]);
echo('</span></h4></div>');
echo('<div class="rowone"><span class="alignright">');
echo('Vol. ');
echo($row[3]);
echo(',&nbsp; &#35;');
echo($row[4]);
echo('</span></div>');
echo('<div class="rowtwo"><span class="alignleft">');
echo('(#) reviews');
echo('</span></div>');
echo('<div class="rowtwo"><span class="alignright">');
echo('(stars)');
echo('</span></div>');
echo('<div class="clear"></div>');
echo('</div>');
echo('</span></div>');


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