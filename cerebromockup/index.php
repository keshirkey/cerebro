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
    <base href="http://localhost:8888/cerebro/">
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
        		<img src="images/cerebrologo.png" alt="Cerebro Logo" height="116" width="250">
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
$n = 0;
while ($row = mysql_fetch_row($result) ) {
$seriesID = $row[0];
$query = mysql_query("SELECT seriestitle FROM series WHERE seriesID = '$seriesID'");
$series_row = mysql_fetch_row($query);
$n = $n + 1;
echo('<div class="grid_1"><span>Comic ');
echo($n);
echo("<br/>");
echo($series_row[0]);
echo("<br/>");
echo($row[3]);
echo("<br/>");
echo($row[4]);
echo("<br/><br/>");
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
 <!--   			<div class="grid_1"><span>Comic 1
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
				</span></div>

    			<div class="grid_1"><span>Comic 2
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_1"><span>Comic 3
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_1"><span>Comic 4
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_2"><span>Comic 5
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_2"><span>Comic 6
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_2"><span>Comic 7
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_2"><span>Comic 8
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_3"><span>Comic 9
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_3"><span>Comic 10
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_3"><span>Comic 11
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_3"><span>Comic 12
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_4"><span>Comic 13
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_4"><span>Comic 14
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_4"><span>Comic 15
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div>

    			<div class="grid_4"><span>Comic 16
    				<p>
    					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis urna leo, placerat eget iaculis at, convallis vitae purus. Sed sapien massa, elementum id accumsan quis, fringilla volutpat urna. Mauris nec leo vitae odio ornare aliquet eu in elit. Sed dui nibh, congue at egestas ut, congue quis leo. Fusce dictum fermentum fermentum. Nunc aliquam pharetra odio, vel malesuada neque convallis a. In nec dolor nulla.
    				</p>
    			</span></div> -->
    	</section>

    	<footer>
        	<p>&copy; 2013 Go Team Venture!</p>
    	</footer>
	</div>
 </body>
</html>