<?php 

// Add.php -- Adds new record to the database and displays add form

//load data from login.php and connect to mysql server
require_once 'login.php'; 
$db_server = mysql_connect($db_hostname, $db_username, $db_password);

//generate error message if it doesn't work
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error()); 

//choose database
mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());

//check for data in POST array, put into variables
session_start();
if (isset($_POST['series']) && isset($_POST['writerfirst']) && isset($_POST['writerlast']) && isset($_POST['artistfirst']) && isset($_POST['artistlast']) &&  isset($_POST['inkerfirst']) && isset($_POST['inkerlast']) && isset($_POST['coloristfirst']) && isset($_POST['coloristlast']) && isset($_POST['lettererfirst']) && isset($_POST['lettererlast']) && isset($_POST['coverartistfirst']) && isset($_POST['coverartistlast']) && isset($_POST['coverinkerfirst']) && isset($_POST['coverinkerlast']) && isset($_POST['covercoloristfirst']) && isset($_POST['covercoloristlast']) && isset($_POST['volume']) && isset($_POST['number']) && isset($_POST['limitedseries']) && isset($_POST['subtitle']) && isset($_POST['pubmonth']) && isset($_POST['pubyear']) &&  isset($_POST['family']) && isset($_POST['publisher']) && isset($_POST['isbn'])
) {
    $series = get_post('series');
    $writerfirst = get_post('writerfirst');
    $writerlast = get_post('writerlast');
    $artistfirst = get_post('artistfirst');
    $artistlast = get_post('artistlast');
    $inkerfirst = get_post('inkerfirst');
    $inkerlast = get_post('inkerlast');
    $coloristfirst = get_post('coloristfirst');
    $coloristlast = get_post('coloristlast');
    $lettererfirst = get_post('lettererfirst');
    $lettererlast = get_post('lettererlast');
    $coverartistfirst = get_post('coverartistfirst');
    $coverartistlast = get_post('coverartistlast');
    $coverinkerfirst = get_post('coverinkerfirst');
    $coverinkerlast = get_post('coverinkerlast');
    $covercoloristfirst = get_post('covercoloristfirst');
    $covercoloristlast = get_post('covercoloristlast');
    $volume = get_post('volume') + 0;
    $number = get_post('number') + 0;
    $limitedseries = get_post('limitedseries');
    $subtitle = get_post('subtitle');  
    $pubmonth = get_post('pubmonth') + 0;  
    $pubyear = get_post('pubyear') + 0;
    $family = get_post('family');
    $publisher = get_post('publisher');
    $isbn = get_post('isbn') + 0; 
           
    
    //retrieve roleIDs from the role table
    $string = "SELECT roleID FROM role WHERE rolename = 'writer'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_writer = $row[0];
    
    $string = "SELECT roleID FROM role WHERE rolename = 'artist'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_artist = $row[0];
    
    $string = "SELECT roleID FROM role WHERE rolename = 'inker'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_inker = $row[0];
    
    $string = "SELECT roleID FROM role WHERE rolename = 'colorist'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_colorist = $row[0];
    
    $string = "SELECT roleID FROM role WHERE rolename = 'letterer'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_letterer = $row[0];
    
    $string = "SELECT roleID FROM role WHERE rolename = 'coverartist'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_coverartist = $row[0];
    
    $string = "SELECT roleID FROM role WHERE rolename = 'coverinker'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_coverinker = $row[0];
    
    $string = "SELECT roleID FROM role WHERE rolename = 'covercolorist'";
    $result = mysql_query($string, $db_server);
    $row = mysql_fetch_row($result);
    $roleID_covercolorist = $row[0];
    
     //insert publisher into db and get ID  
    if ($publisher == "") {$publisher = "NULL";}  
    $query_publisher = "INSERT IGNORE INTO publisher (publishername) VALUES ('$publisher')";
    if (!mysql_query($query_publisher, $db_server)) {echo "INSERT failed: $query_publisher<br />" . mysql_error() . "<br /><br />";}
    $publisherid = mysql_insert_id();
      
    //insert series into db and get ID
    if ($series == "") {$series = "NULL";}  
    $query_series = "INSERT IGNORE INTO series (seriestitle, publisherID) VALUES ('$series', '$publisherid')";
    if (!mysql_query($query_series, $db_server)) {echo "INSERT failed: $query_series<br />" . mysql_error() . "<br /><br />";}
    $seriesid = mysql_insert_id();
        
    //insert family into db and get ID     
    if ($family == "") {$family = "NULL";}  
    $query_family = "INSERT IGNORE INTO family (familyname, publisherID) VALUES ('$family', '$publisherid')";
    if (!mysql_query($query_family, $db_server)) {echo "INSERT failed: $query_family<br />" . mysql_error() . "<br /><br />";}
    $familyid = mysql_insert_id();
    
    //check user-submitted data for blank fields, insert NULL into blanks, otherwise use user data
    $X_subtitle = $subtitle == "" ? "NULL" : "'".$subtitle."'";
    $X_limitedseries = $limitedseries == "" ? "NULL" : "'".$limitedseries."'";
        
    //insert collected information & ids into comic table, collect comicID
    $query_comic = "INSERT INTO comic (seriesID, volume, number, subtitle, limitedseries, monthid, pubyear, isbn, familyID, publisherID) VALUES ('$seriesid', '$volume', '$number', '$X_subtitle', '$X_limitedseries', '$pubmonth', '$pubyear', '$isbn', '$familyid', '$publisherid')";
    if (!mysql_query($query_comic, $db_server)) {echo "INSERT failed: $query_comic<br />" . mysql_error() . "<br /><br />";
    $comicid = mysql_insert_id();
    }
        
   //insert writer info into db and get ID     
    if ($writerfirst == "") {$writerfirst = "NULL";} 
    if ($writerlast == "") {$writerlast = "NULL";}
    $query_writer = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$writerfirst', '$writerlast')";
    if (!mysql_query($query_writer, $db_server)) {echo "INSERT failed: $query_writer<br />" . mysql_error() . "<br /><br />";}
    $writerid = mysql_insert_id();
    
    //insert artist info into db and get ID     
    if ($artistfirst == "") {$artistfirst = "NULL";} 
    if ($artistlast == "") {$artistlast = "NULL";}
    $query_artist = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$artistfirst', '$artistlast')";
    if (!mysql_query($query_artist, $db_server)) {echo "INSERT failed: $query_artist<br />" . mysql_error() . "<br /><br />";}
    $artistid = mysql_insert_id();
    
    //insert inker info into db and get ID     
    if ($inkerfirst == "") {$inkerfirst = "NULL";} 
    if ($inkerlast == "") {$inkerlast = "NULL";}
    $query_inker = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$inkerfirst', '$inkerlast')";
    if (!mysql_query($query_inker, $db_server)) {echo "INSERT failed: $query_inker<br />" . mysql_error() . "<br /><br />";}
    $inkerid = mysql_insert_id();
    
    //insert colorist info into db and get ID     
    if ($coloristfirst == "") {$coloristfirst = "NULL";} 
    if ($coloristlast == "") {$coloristlast = "NULL";}
    $query_colorist = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$coloristfirst', '$coloristlast')";
    if (!mysql_query($query_colorist, $db_server)) {echo "INSERT failed: $query_colorist<br />" . mysql_error() . "<br /><br />";}
    $coloristid = mysql_insert_id();
    
    //insert letterer info into db and get ID     
    if ($lettererfirst == "") {$lettererfirst = "NULL";} 
    if ($lettererlast == "") {$lettererlast = "NULL";}
    $query_letterer = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$lettererfirst', '$lettererlast')";
    if (!mysql_query($query_letterer, $db_server)) {echo "INSERT failed: $query_letterer<br />" . mysql_error() . "<br /><br />";}
    $lettererid = mysql_insert_id();
    
    //insert coverartist info into db and get ID     
    if ($coverartistfirst == "") {$coverartistfirst = "NULL";} 
    if ($coverartistlast == "") {$coverartistlast = "NULL";}
    $query_coverartist = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$coverartistfirst', '$coverartistlast')";
    if (!mysql_query($query_coverartist, $db_server)) {echo "INSERT failed: $query_coverartist<br />" . mysql_error() . "<br /><br />";}
    $coverartistid = mysql_insert_id();
    
    //insert coverinker info into db and get ID     
    if ($coverinkerfirst == "") {$coverinkerfirst = "NULL";} 
    if ($coverinkerlast == "") {$coverinkerlast = "NULL";}
    $query_coverinker = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$coverinkerfirst', '$coverinkerlast')";
    if (!mysql_query($query_coverinker, $db_server)) {echo "INSERT failed: $query_coverinker<br />" . mysql_error() . "<br /><br />";}
    $coverinkerid = mysql_insert_id();
    
    //insert covercolorist info into db and get ID     
    if ($covercoloristfirst == "") {$covercoloristfirst = "NULL";} 
    if ($covercoloristlast == "") {$covercoloristlast = "NULL";}
    $query_covercolorist = "INSERT IGNORE INTO author (firstname, lastname) VALUES ('$covercoloristfirst', '$covercoloristlast')";
    if (!mysql_query($query_covercolorist, $db_server)) {echo "INSERT failed: $query_covercolorist<br />" . mysql_error() . "<br /><br />";}
    $covercoloristid = mysql_insert_id();
    
    //insert info into authorship table
    $query_authorship_writer = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_writer', '$writerid')";
    if (!mysql_query($query_authorship_writer, $db_server)) {echo "INSERT failed: $query_authorship_writer<br />" . mysql_error() . "<br /><br />";}
    
    $query_authorship_artist = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_artist', '$artistid')";
    if (!mysql_query($query_authorship_artist, $db_server)) {echo "INSERT failed: $query_authorship_artist<br />" . mysql_error() . "<br /><br />";}
    
    $query_authorship_inker = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_inker', '$inkerid')";
    if (!mysql_query($query_authorship_inker, $db_server)) {echo "INSERT failed: $query_authorship_inker<br />" . mysql_error() . "<br /><br />";}
    
    $query_authorship_colorist = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_colorist', '$coloristid')";
    if (!mysql_query($query_authorship_colorist, $db_server)) {echo "INSERT failed: $query_authorship_colorist<br />" . mysql_error() . "<br /><br />";}
    
    $query_authorship_letterer = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_letterer', '$lettererid')";
    if (!mysql_query($query_authorship_letterer, $db_server)) {echo "INSERT failed: $query_authorship_letterer<br />" . mysql_error() . "<br /><br />";}
    
    $query_authorship_coverartist = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_coverartist', '$coverartistid')";
    if (!mysql_query($query_authorship_coverartist, $db_server)) {echo "INSERT failed: $query_authorship_coverartist<br />" . mysql_error() . "<br /><br />";}
    
    $query_authorship_coverinker = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_coverinker', '$coverinkerid')";
    if (!mysql_query($query_authorship_coverinker, $db_server)) {echo "INSERT failed: $query_authorship_coverinker<br />" . mysql_error() . "<br /><br />";}
    
    $query_authorship_covercolorist = "INSERT IGNORE INTO authorship (comicID, roleID, authorID) VALUES ('$comicid', '$roleID_covercolorist', '$covercoloristid')";
    if (!mysql_query($query_authorship_covercolorist, $db_server)) {echo "INSERT failed: $query_authorship_covercolorist<br />" . mysql_error() . "<br /><br />";}
    
    //add message to session saying it worked and reload page
    $_SESSION['msg'] = "Record added successfully";
    header('Location: add.php');
    return; 
    }
    
//display session messages
if (isset($_SESSION['msg'])) {
    echo ('<p style="color:green;">' . $_SESSION['msg'] . '</p>');
    unset($_SESSION['msg']);
    }

//create form and output to browser    
echo <<<_END
<form style="font-size: 24px; action="index.php" method="post">
<pre>
Publisher: <input type="text" name="publisher"/>
Family: <input type="text" name="family"/>
Series: <input type="text" name="series"/>
Volume: <input type="text" name="volume"/>
Number: <input type="text" name="number"/>
Subtitle: <input type="text" name="subtitle"/>
Writer: <input type="text" name="writerfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="writerlast"/>(last name)
Artist: <input type="text" name="artistfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="artistlast"/>(last name)
Inker: <input type="text" name="inkerfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="inkerlast"/>(last name)
Colorist: <input type="text" name="coloristfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="coloristlast"/>(last name)
Letterer: <input type="text" name="lettererfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="lettererlast"/>(last name)
Cover Artist: <input type="text" name="coverartistfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="coverartistlast"/>(last name)
Cover Inker: <input type="text" name="coverinkerfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="coverinkerlast"/>(last name)
Cover Colorist: <input type="text" name="covercoloristfirst"/>(first name)&nbsp;&nbsp;<input type="text" name="covercoloristlast"/>(last name)
Limited Series?: <input type="radio" name="limitedseries" value="Yes"/>Yes&nbsp;&nbsp;<input type="radio" name="limitedseries" value="No"/>No
Published date: <input type="text" name="pubmonth"/>mm&nbsp;&nbsp;<input type="text" name="pubyear"/>yyyy
ISBN: <input type="text" name="isbn"/>
<input type="submit" value="Add comic"/>
</pre>
</form>
_END;

//close connection to mysql
mysql_close($db_server);

//get_post function to sanitize user data
function get_post($var) {
    if (!isset($_POST[$var]) && strlen($_POST[$var]) < 1) {return false;}
    return mysql_real_escape_string($_POST[$var]);
    }

?>