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

?>

<!-- HTML STARTS HERE -->
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
    		<div id="filtertext">
                <p class="alignleft">Sort by most recently:</p> 
                <p class="alignright">Filter by:</p>
                <div class="clear"></div>
            </div>
    		
    		<!-- dynamic filters -->
            <div id="filters">
                <form name="filters" method="post" action="index.php">
                <div id="filtersleft" class="alignleft">
                    <input type="submit" name="sort" value="Published"></input>
                    <input type="submit" name="sort" value="Added"></input>
                    <input type="submit" name="sort" value="Reviewed"></input>
                </div>

                <div id="filtersright" class="alignright">

                    <select name="publisher" id = "publisher" onchange="submit();">
    				 
    				    <?php 
    					    //populate publisher dropdown from database
                            //display blank option if no POST data
                            if (!isset($_REQUEST['publisher']) || $_GET['publisher'] == "") {echo('<option value="" selected = "selected">- Publisher -</option>'."\n");}
                            $query = "SELECT publisherID, publishername FROM publisher WHERE publishername IS NOT NULL";
                            $result = mysql_query($query);
                            //output as dropdown options
                            while ($row = mysql_fetch_row($result)) {
                                //determine if a selected option should be kept in dropdown
                                if ($row[0] == $_REQUEST['publisher']) {$selected = "selected = \"selected\"";}
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
                                if (!isset($_REQUEST['family']) || $_GET['family'] == "") {echo('<option value="" selected = "selected">- Family -</option>');echo("\n");}
                                if (isset($_REQUEST['publisher']) && $_REQUEST['publisher'] != "") {
                                    $p = get_post('publisher');
                                    $query = "SELECT familyID, familyname, publisherID FROM family WHERE familyname IS NOT NULL AND publisherID = '$p'";
                                    }
                                else {
                                    $query = "SELECT familyID, familyname FROM family WHERE familyname IS NOT NULL";
                                    }
                                $result = mysql_query($query);
                                //output as dropdown options
                                while ($row = mysql_fetch_row($result)) {
                                    //determine if a selected option should be kept in dropdown
                                    if ($row[0] == $_REQUEST['family']) {$selected = "selected = \"selected\"";}
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


<?php

//--FILTER DATA STUFF--
//check for GET or POST data from filters and put into variables    
    
if (isset($_REQUEST['publisher'])) {$pubselectID = get_post('publisher');}

if (isset($_REQUEST['family'])) {$famselectID = get_post('family');}

if (isset($_REQUEST['review'])) {$review = get_post('review');}

if (isset($_REQUEST['sort'])) {$sort = get_post('sort');}

function get_post($var) {
    if (!isset($_REQUEST[$var]) && strlen($_REQUEST[$var]) < 1) {return false;}
    return mysql_real_escape_string($_REQUEST[$var]);
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

//--PAGINATION STUFF--
//set $pagenum to be the value in the URL/GET array
if(isset($_GET['pagenum'])) {$pagenum = $_GET['pagenum']+0;}
//check if page # is set, if not set to 1
if (!(isset($pagenum))) {$pagenum = 1;}

//count number of rows from query with filters
$count = mysql_query($query);
$num_rows = mysql_num_rows($count);

//how many to display on the page
$page_rows = 8;

//calculate what the last page will be
$last = ceil($num_rows/$page_rows);

//check if page number is bigger than last or smaller than first
if ($pagenum < 1) {$pagenum = 1;}
elseif ($pagenum > $last) {$pagenum = $last;}

//setting a range using the limit function to insert into query later
$max = 'limit '.($pagenum - 1) * $page_rows.','.$page_rows;

//add $max to the end of the query for pagination
$query .= " $max";  


//--MORE PAGINATION--
//output the pagination links

//first page should not display first or previous links
echo ('<div id="pagestop">');
echo ('<div id="pagesleft"><span class="alignleft">');
if ($pagenum == 1) {}
else {
    $previous = $pagenum-1;
    $firstlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=1";
    $prevlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$previous";
     if ($_REQUEST > 0) {
        @$firstlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        @$prevlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        }
    $firstlink .= "'> &#171; First</a>";
    $prevlink .= "'> &lsaquo; Previous</a>";
    echo ($firstlink);
    echo (" ");
    echo($prevlink);
}
echo ('</span></div>');

//last page should not display last or next links
echo ('<div id="pagesright"><span class="alignright">');
if ($pagenum == $last) {}
else {
    $next = $pagenum+1;
    $nextlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$next";
    $lastlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$last";
    if ($_REQUEST > 0) {
        @$nextlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        @$lastlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        }
    $nextlink .="'>Next &rsaquo;</a>";
    $lastlink .="'>Last &#187;</a>";
    echo ($nextlink);
    echo (" ");
    echo ($lastlink);
}
echo ('</span></div>');

echo ('<div id="pagescenter"><span class="aligncenter">');
echo ('<p id="pages">Page '.$pagenum.' of '.$last.'</p>');
echo ('</span></div>');

echo ('<div class="clear">');
echo ('</div></div>');



//run the query and output
$result = mysql_query($query);
while ($row = mysql_fetch_row($result) ) {
$comicID = $row[7];
$seriesID = $row[0];
$query = mysql_query("SELECT seriestitle FROM series WHERE seriesID = '$seriesID'");
$image_query = mysql_query("SELECT image FROM image WHERE comicID = '$comicID'");
$image_row = mysql_fetch_row($image_query);
$series_row = mysql_fetch_row($query);
echo('<div id="comicgrid">');
echo('<div id="comicbox" class="grid_1"><span>'); 


echo('<div class="actions">'."\n");
echo('<form name="owned" method="post" action="index.php">'."\n");
echo('<a class="review-button" href="#">'."\n");

$string = "SELECT ownedID FROM owned WHERE comicID = '$row[7]' AND collectorID = 5";
$result3 = mysql_query($string);
$owned_result = mysql_num_rows($result3);

if ($owned_result > 0) {
    $owned = "static/images/owned.png";
    $b_value = "owned";
}
else {
    $owned = "static/images/not-owned.png";
    $b_value = "notowned";
}

echo ('<input type="hidden" name="collectorID" value="5"></input>');      
echo ('<input type="hidden" name="comicID" value="'.$row[7].'"></input>');  
echo ('<input class="owned-button" type="image" src="'.$owned.'" width="30" height="30" name="owned" value="'.$b_value.'" />'."\n");

$hiddencollectorID = $_POST['collectorID'];
$hiddencomicID = $_POST['comicID'];
if(isset($_POST['owned']) && $_POST['owned'] == "owned") {
    $query = "DELETE FROM owned WHERE collectorID = '$hiddencollectorID'";
}
elseif(isset($_POST['owned']) && $_POST['owned'] == "notowned") {
    $query = "INSERT INTO owned (comicID, collectorID) VALUES ('$hiddencomicID', '$hiddencollectorID')";
}
mysql_query($query);
?>         
    </a>

    <a class="review-button" href="#review-dialog" name="modal">
        <span>Review</span>
    </a>

    <a class="review-button" href="#review-dialog" name="modal">
    <span>Add to List</span>
    </a>
    </div>
    </form>
    
<?php
echo('<div class="cover">'."\n");
if ($image_row[0] == NULL) {
    echo('<a href="comic.php?comicID='.$comicID.'"><img src="static/images/filler/'.rand(1,2).'.gif" alt="No Cover Image Available"></a>'."\n");
    }
else {
    echo('<a href="comic.php?comicID='.$comicID.'"><img src="'.$image_row[0].'" alt="Comic cover image"/></a>'."\n");
    }
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
//Attempts at dynamic linking
echo('</span></div>');
echo('<div class="rowtwo"><span class="alignleft">');
echo('(#) reviews');
echo('</span></div>');
echo('<div class="rowtwo"><span class="alignright">');
echo('<img src="static/images/stars/stars.png">'."\n");

/*if (isset($_SESSION['collectorid']) ){
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
    }*/ ?>
        <div id="boxes">
            <div id="review-dialog" class="window">
                <b>Modal Window</b>
                <a href="#" class="close">cancel</a>
            </div>
            <div id="mask"></div>
        </div>   
<?php
echo('</span></div>');
echo('<div class="clear"></div>');
echo('</div>');
echo('</span></div></div>');
}
?>

<?php
//--MORE PAGINATION--
//output the pagination links

//first page should not display first or previous links
echo ('<div id="pagesbottom">');
echo ('<div id="pagesleft"><span class="alignleft">');
if ($pagenum == 1) {}
else {
    $previous = $pagenum-1;
    $firstlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=1";
    $prevlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$previous";
     if ($_REQUEST > 0) {
        @$firstlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        @$prevlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        }
    $firstlink .= "'> &#171; First</a>";
    $prevlink .= "'> &lsaquo; Previous</a>";
    echo ($firstlink);
    echo (" ");
    echo($prevlink);
}
echo ('</span></div>');

//last page should not display last or next links
echo ('<div id="pagesright"><span class="alignright">');
if ($pagenum == $last) {}
else {
    $next = $pagenum+1;
    $nextlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$next";
    $lastlink = "<a href='{$_SERVER['PHP_SELF']}?pagenum=$last";
    if ($_REQUEST > 0) {
        @$nextlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        @$lastlink .= "&publisher=$pubselectID&family=$famselectID&sort=$sort";
        }
    $nextlink .="'>Next &rsaquo;</a>";
    $lastlink .="'>Last &#187;</a>";
    echo ($nextlink);
    echo (" ");
    echo ($lastlink);
}
echo ('</span></div>');

echo ('<div id="pagescenter"><span class="aligncenter">');
echo ('<p id="pages"> Page '.$pagenum.' of '.$last.'</p>');
echo ('</span></div>');

echo ('<div class="clear">');
echo ('</div></div>');
?>

    	</section>

    	<footer>
        	<p>&copy; 2013 Go Team Venture!</p>
    	</footer>
	</div>
 </body>
 <script>

            $(document).ready(function() {	

                //select all the a tag with name equal to modal
                $('a[name=modal]').click(function(e) {
                    //Cancel the link behavior
                    e.preventDefault();
                    //Get the A tag
                    var id = $(this).attr('href');
                
                    //Get the screen height and width
                    var maskHeight = $(document).height();
                    var maskWidth = $(window).width();
                
                    //Set height and width to mask to fill up the whole screen
                    $('#mask').css({'width':maskWidth,'height':maskHeight});
                    
                    //transition effect		
                    $('#mask').fadeIn(500);	
                    $('#mask').fadeTo("fast",0.6);	
                
                    //Get the window height and width
                    var winH = $(window).height();
                    var winW = $(window).width();
                          
                    //Set the popup window to center
                    $(id).css('top',  winH/2-$(id).height()/2);
                    $(id).css('left', winW/2-$(id).width()/2);
                
                    //transition effect
                    $(id).fadeIn(500); 
                
                });
                
                //if close button is clicked
                $('.window .close').click(function (e) {
                    //Cancel the link behavior
                    e.preventDefault();
                    $('#mask, .window').hide();
                });		
                
                //if mask is clicked
                $('#mask').click(function () {
                    $(this).hide();
                    $('.window').hide();
                });			
                
            });

        </script>
</html>