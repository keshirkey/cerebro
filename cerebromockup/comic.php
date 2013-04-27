<?php
require_once "login.php";
session_start();
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error()); 
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());
?>

<!DOCTYPE html>
 <head>
 	<?php include 'header.php';?>
 </head>
 <body>
 	<div id="wholecontainer">
    	<header>
    		<div id="header">
    		<!-- search bar -->
    		<div id="searchwrap">
        		<input id="searchbox" type="search" />
                <img src="static/images/searchicon.png" alt="Search Icon" height="19" width="19">
        		<a href="advancedsearch.html">Advanced Search</a>
        	</div>

        	<div id="logo">
        		<a href="index.php"><img src="static/images/cerebro_logo.gif" alt="Cerebro Logo"></a>
        	</div>

        	<!-- nav links -->
        	<ul id="username">
                <?php if ( isset($_SESSION['username'])){ ?>
                <li><?php echo ('<p> Welcome ' .htmlentities($_SESSION['username']). '!</p>'); }?></li>
            </ul>

            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <?php if (!isset($_SESSION['username'])){ ?>
                    <li><a href="signin.php">Log In</a></li>
                    <li><a href="registration.php"></a></li>
                    <?php } ?>
                    <?php if ( isset($_SESSION['username'])){ ?>
                    <li><a href="logout.php">Logout</a></li>
                    <?php } ?>
                       
                </ul>
            </nav>
            </div>
    	</header>

        <section id="maincontent">
<?php

$comicID = get_post('comicID');

//clean input
function get_post($var) {
    if (!isset($_REQUEST[$var]) && strlen($_REQUEST[$var]) < 1) {return false;}
    return mysql_real_escape_string($_REQUEST[$var]);
    }

$query = "SELECT seriesID, publisherID, familyID, volume, number, monthid, pubyear, comicID, subtitle, isbn, adddate, limitedseries FROM comic WHERE comicID = $comicID";

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
$image_query = mysql_query("SELECT image FROM image WHERE comicID = '$comicID'");
$image_row = mysql_fetch_row($image_query);

echo('<div id="comicbox_page" class="grid_2"><span>');
echo('<div id="comicpageinfo">'."\n");
echo('<div id="seriestitle"><h2>');
echo($series_row[0]);
echo('</h2>');
//display subtitle
if($row[8] != NULL){
    echo('<div id="subtitle"><h4>');
    echo($row[8]);
    echo('</h4></div>');
    }
echo('<div id="volnuminfo">');
echo('Vol. ');
echo($row[3]);
echo(',&nbsp; &#35;');
echo($row[4]);
echo('</span></div>');
echo('<div class="cover">'."\n");
//change this to dynamic 
if ($image_row[0] == NULL) {
    echo('<img src="static/images/filler/'.rand(1,2).'.gif" alt="No Cover Image Available"></a>'."\n");
    }
    
else {
    echo('<img src="'.$image_row[0].'"></a>'."\n");
    }
echo('</div></div>'."\n");

echo('<div id="comicextrainfo">');
echo('<div id="publisher"><strong>Publisher:</strong> '.$publisher_row[0]."</div>\n");
echo('<div id="family"><strong>Family:</strong> '.$family_row[0].'</div>');
echo('<div id="pubdate">');
echo('<strong>Publication Date:</strong> '.$month_row[0]. ' ');
echo($row[6]);
echo('</div>');
echo('<div id="isbn">');
//ISBN
if($row[9] != 0 OR NULL){ 
    echo('<strong>ISBN:</strong> '.$row[9]."</div>\n");
}
echo('<div class="rowtwo">');
//Do we want this in? Probably need to format it nicely if we do

echo('<strong>Added On:</strong> '.$row[10]."\n");
//Add an "In my library" feature that draws on owned
echo('<div id="reviews">');
echo('(#) reviews');
echo('</span></div>');
echo('<div id="stars">');
echo('<img src="static/images/stars/stars.png">'."\n");
echo('</span></div>');
echo('<div id="owned">');
if (isset($_SESSION['collectorid']) ){
 $string = "SELECT ownedID FROM owned WHERE comicID = $comicID AND collectorID = '".addslashes($_SESSION['collectorid'])."' ";
 $result3=mysql_query($string);
 $owned_result = mysql_num_rows($result3);
    }

 if ($owned_result > 0) {
    $owned = "In My Library";
    echo $owned;
    }
 else {
    $owned = "not owned";
    }
}

//adding artists/authors to the record 

$query_author = "SELECT author.firstname, author.lastname, author.authorID, role.rolename, role.roleID
    FROM authorship JOIN author ON author.authorID = authorship.authorID
    JOIN role ON role.roleID = authorship.roleID WHERE authorship.comicID = '$comicID' AND author.firstname IS NOT NULL";

$result_author = mysql_query($query_author);

while( $row_author = mysql_fetch_row($result_author) ){
    echo ('<span style="text-transform: uppercase; font-weight: bold;">'.$row_author[3].'</span>: '.$row_author[0].'&nbsp;'.$row_author[1]);
    echo('<div class="rowtwo"><span class="alignleft"></div>');
}

echo('<div class="clear"></div>');
echo('</span></div>');

?>
        </section>
	    
		<footer>
        	<p>&copy; 2013 Go Team Venture!</p>
    	</footer>
	</div>
 </body>
</html> 
    	