<?php
session_start();
//--CONNECT TO DATABASE STUFF--
//load data from login.php and connect to mysql server
require_once 'login.php'; 
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

//generate error message if it doesn't work
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error()); 

//choose database
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());

//--PAGINATION STUFF--
//set $pagenum to be the value in the URL/GET array
if(isset($_GET['pagenum'])) {$pagenum = $_GET['pagenum']+0;}
//check if page # is set, if not set to 1
if (!(isset($pagenum))) {$pagenum = 1;}

//count the number of rows that exist in the database
$pagequery = mysql_query("SELECT * FROM comic");
$rows = mysql_num_rows($pagequery);

//how many to display on the page
$page_rows = 8;

//calculate what the last page will be
$last = ceil($rows/$page_rows);

//check if page number is bigger than last or smaller than first
if ($pagenum < 1) {$pagenum = 1;}
elseif ($pagenum > $last) {$pagenum = $last;}

//setting a range using the limit function to insert into query later
$max = 'limit '.($pagenum - 1) * $page_rows.','.$page_rows;
?>

<!-- HTML STARTS HERE -->
<!DOCTYPE html>
 <head>
 	<html lang="en">
    <meta charset="UTF-8">
    <title>Cerebro - Your Brain on Comics</title>
    <base href="http://localhost:8888/cerebro/cerebromockup/">
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
    	
    	<section id="maincontent">
    		<div id="filtertext">
                <p class="alignleft">Sort by most recently:</p> 
                <p class="alignright">Filter by:</p>
                <div class="clear"></div>
            </div>
    		
    		<!-- dynamic filters -->
    		<form name="filters" method="post" action="index.php">
            <div id="filtersleft" class="alignleft">
                <input type="submit" name="sort" value="Published"></input>
                <input type="submit" name="sort" value="Added"></input>
                <input type="submit" name="sort" value="Reviewed"></input>

    			<div id="filtersright" class="alignright">

                        <select name="publisher" id = "publisher" onchange="submit();">
    				 
    				    <?php 
    					    //populate publisher dropdown from database
                            //display blank option if no POST data
                            if (!isset($_POST['publisher']) && !isset($_GET['publisher']) || $_POST['publisher'] == "" && !isset($_GET['publisher'])) {echo('<option value="" selected = "selected">- Publisher -</option>\n');}
                            $query = "SELECT publisherID, publishername FROM publisher WHERE publishername IS NOT NULL";
                            $result = mysql_query($query);
                            //output as dropdown options
                            while ($row = mysql_fetch_row($result)) {
                                //determine if a selected option should be kept in dropdown
                                if ($row[0] == $_POST['publisher'] || $row[0] == $_GET['publisher']) {$selected = "selected = \"selected\"";}
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
                                if (!isset($_POST['family']) && !isset($_GET['family']) || $_POST['family'] == "") {echo('<option value="" selected = "selected">- Family -</option>');echo("\n");}
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
//--SESSSION/LOGIN STUFF--
if (!isset($_SESSION['username'])){
 echo('<p><a href="registration.php">Register</a></p>');
 echo('<p><a href="signin.php">Log In</a></p>');
}
//will allow identification of users via session; currently displaying only this when session is set
if ( isset($_SESSION['username']) ) {
   echo('<p>Welcome '.htmlentities($_SESSION['username']). ' You have logged in.</p>'."\n");
   echo('<p><a href="logout.php">Logout</a></p>'."\n");
   
}

//--FILTER DATA STUFF--
//check for GET or POST data from filters and put into variables    
    
if (isset($_POST['publisher'])) {$pubselectID = get_post('publisher');}

if (isset($_POST['family'])) {$famselectID = get_post('family');}

if (isset($_POST['review'])) {$review = get_post('review');}

if (isset($_POST['sort'])) {$sort = get_post('sort');}

if (isset($_GET['publisher'])) {$pubselectID = get_sort('publisher');}

if (isset($_GET['family'])) {$famselectID = get_sort('family');}

if (isset($_GET['sort1'])) {$publish = get_sort('sort1');}

if (isset($_GET['sort2'])) {$add = get_sort('sort2');}

function get_post($var) {
    if (!isset($_POST[$var]) && strlen($_POST[$var]) < 1) {return false;}
    return mysql_real_escape_string($_POST[$var]);
    }
    
function get_sort($var) {
    if (!isset($_GET[$var]) && strlen($_GET[$var]) < 1) {return false;}
    return mysql_real_escape_string($_GET[$var]);
    }
    
//--MORE PAGINATION--
//output the pagination links
echo ('<p style="font-size: 26px;">--Page '.$pagenum.' of '.$last.'--</p>');

//first page should not display first or previous links
if ($pagenum == 1) {}
else {
    $firstlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=1";
    $prevlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$previous";
    if ($_POST > 0) {
        $firstlink .= "&publisher=$pubselectID&family=$famselectID&sort1=$publish&sort2=$add";
        $prevlink .= "&publisher=$pubselectID&family=$famselectID&sort1=$publish&sort2=$add";
        }
    $firstlink .= "'> <<-First</a>";
    $prevlink .= "'> <-Previous</a>";
    $previous = $pagenum-1;
    echo ($firstlink);
    echo (" ");
    echo($prevlink);
}

//last page should not display last or next links
if ($pagenum == $last) {}
else {
    $next = $pagenum+1;
    $nextlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$next";
    $lastlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$last";
    if ($_POST > 0) {
        $nextlink .= "&publisher=$pubselectID&family=$famselectID&sort1=$publish&sort2=$add";
        $lastlink .= "&publisher=$pubselectID&family=$famselectID&sort1=$publish&sort2=$add";
        }
    $nextlink .="'>Next -></a>";
    $lastlink .="'>Last ->></a>";
    echo ($nextlink);
    echo (" ");
    echo ($lastlink);
    }

//--MAIN QUERY--
//construct the query based on what has been selected    
$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID FROM comic WHERE comicID IS NOT NULL";

if (isset($pubselectID) && $pubselectID > 0) {
    $query .= " AND publisherID = '$pubselectID'";
}

if (isset($famselectID) && $famselectID > 0) {
    $query .= " AND familyID = '$famselectID'";
}

/*if (isset($reviewID) && $reviewID > 0) {
    $query .= "AND reviewID = '$reviewID'";
} */

if (isset($sort) && $sort == "Published") {
    $query .= " ORDER BY pubyear DESC, monthid";
}

if (isset($sort) && $sort == "Added") {
    $query .= " ORDER BY adddate DESC";
}

//add $max to the end of the query for pagination
$query .= " $max";  

//run the query and output
$result = mysql_query($query);
while ($row = mysql_fetch_row($result) ) {
$seriesID = $row[0];
$query = mysql_query("SELECT seriestitle FROM series WHERE seriesID = '$seriesID'");
$series_row = mysql_fetch_row($query);
echo('<div id="comicbox" class="grid_1"><span>');
echo('<div class="cover">'."\n");
echo('<img src="../frontend/static/images/Amazing_Spider-Man_Vol_1_688.jpg">'."\n");
echo("</div>\n");
echo('<div id="comicinfo">'."\n");
echo('<div class="rowone"><h4><span class="alignleft">'."\n");
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