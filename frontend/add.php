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
if (isset($_POST['series']) && isset($_POST['writerfirst']) && isset($_POST['writerlast']) && isset($_POST['artistfirst']) && isset($_POST['artistlast']) &&  isset($_POST['inkerfirst']) && isset($_POST['inkerlast']) && isset($_POST['coloristfirst']) && isset($_POST['coloristlast']) && isset($_POST['lettererfirst']) && isset($_POST['lettererlast']) && isset($_POST['coverartistfirst']) && isset($_POST['coverartistlast']) && isset($_POST['covercoloristfirst']) && isset($_POST['covercoloristlast']) && isset($_POST['volume']) && isset($_POST['number']) && isset($_POST['limitedseries']) && isset($_POST['subtitle']) && isset($_POST['pubmonth']) && isset($_POST['pubyear']) &&  isset($_POST['family']) && isset($_POST['publisher']) && isset($_POST['isbn'])
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
    $covercoloristfirst = get_post('covercoloristfirst');
    $covercoloristlast = get_post('covercoloristlast');
    $volume = get_post('volume');
    $number = get_post('number');
    $limitedseries = get_post('limitedseries');
    $subtitle = get_post('subtitle');  
    $pubmonth = get_post('pubmonth');  
    $pubyear = get_post('pubyear');
    $family = get_post('family');
    $publisher = get_post('publisher');
    $isbn = get_post('isbn');
           
    //check if records are already there
    $check_series = mysql_query("SELECT * FROM series WHERE seriestitle = '$series'");
    $check_volume = mysql_query("SELECT * FROM comic WHERE volume = '$volume'");
    $check_number = mysql_query("SELECT * FROM comic WHERE number = '$number'");
    $check_writer = mysql_query("SELECT * FROM writer WHERE firstname = '$writerfirst' AND lastname = '$writerlast'");
    $check_artist = mysql_query("SELECT * FROM artist WHERE firstname = '$artistfirst' AND lastname = '$artistlast'");
    $check_inker = mysql_query("SELECT * FROM inker WHERE firstname = '$inkerfirst' AND lastname = '$inkerlast'");
    $check_colorist = mysql_query("SELECT * FROM colorist WHERE firstname = '$coloristfirst' AND lastname = '$coloristlast'");
    $check_letterer = mysql_query("SELECT * FROM letterer WHERE firstname = '$lettererfirst' AND lastname = '$lettererlast'");
    $check_coverartist = mysql_query("SELECT * FROM coverartist WHERE firstname = '$coverartistfirst' AND lastname = '$coverartistlast'");
    $check_covercolorist = mysql_query("SELECT * FROM covercolorist WHERE firstname = '$covercoloristfirst' AND lastname = '$covercoloristlast'");
    $check_family = mysql_query("SELECT * FROM family WHERE familyname = '$family'");
    $check_publisher = mysql_query("SELECT * FROM publisher WHERE publishername = '$publisher'");
    
     //check if publisher exists in db. if so, get publisher ID. if not, add and get publisher ID.     
    if (mysql_num_rows($check_publisher) > 0) {
        $string = "SELECT * FROM publisher WHERE publishername = '$publisher'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $publisherID = $row[4];
        }
    else {
        $query_publisher = "INSERT INTO publisher (publishername) VALUES ('$publisher')";
        $result = mysql_query("SELECT publishername FROM publisher");
        if (!mysql_query($query_publisher, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $publisherID = mysql_insert_id();
        }
    
    //if series is there, save seriesID to pass to comic table
    if (mysql_num_rows($check_series) > 0) {
        $string = "SELECT * FROM series WHERE seriestitle = '$series'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $seriesID = $row[1];
        //check if series, volume, and number all exist at once; if so, do not add
        if (mysql_num_rows($check_series) > 0 && mysql_num_rows($check_volume) > 0 && mysql_num_rows($check_number) > 0) {
            echo("Comic already exists in the database.");
            return;
            }
        }
    
    //if series is not there, insert series record
    //run the actual query, generate error if it doesn't work. if it works, get the generated ID.
    else {
        $query_series = "INSERT INTO series (seriestitle, publisherID) VALUES ('$series', '$publisherID')";
        $result = mysql_query("SELECT seriestitle FROM series");
            if (!mysql_query($query_series, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $seriesID = mysql_insert_id();
        }
        
   //check if writer exists in db. if so, get writer ID. if not, add and get writer ID.     
    if (mysql_num_rows($check_writer) > 0) {
        $string = "SELECT * FROM writer WHERE firstname = '$writerfirst' AND lastname = '$writerlast'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $writerID = $row[3];
        }
    else {
        $query_writer = "INSERT INTO writer (firstname, lastname) VALUES ('$writerfirst', '$writerlast')";
        $result = mysql_query("SELECT firstname, lastname FROM writer");
        if (!mysql_query($query_writer, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $writerID = mysql_insert_id();
        }
    
    //check if artist exists in db. if so, get artist ID. if not, add and get artist ID.     
    if (mysql_num_rows($check_artist) > 0) {
        $string = "SELECT * FROM artist WHERE firstname = '$artistfirst' AND lastname = '$artistlast'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $artistID = $row[2];
        }
    else {
        $query_artist = "INSERT INTO artist (firstname, lastname) VALUES ('$artistfirst', '$artistlast')";
        $result = mysql_query("SELECT firstname, lastname FROM artist");
        if (!mysql_query($query_artist, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $artistID = mysql_insert_id();
        }
        
    //check if inker exists in db. if so, get inker ID. if not, add and get inker ID.     
    if (mysql_num_rows($check_inker) > 0) {
        $string = "SELECT * FROM inker WHERE firstname = '$inkerfirst' AND lastname = '$inkerlast'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $inkerID = $row[2];
        }
    else {
        $query_inker = "INSERT INTO inker (firstname, lastname) VALUES ('$inkerfirst', '$inkerlast')";
        $result = mysql_query("SELECT firstname, lastname FROM inker");
        if (!mysql_query($query_inker, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $inkerID = mysql_insert_id();
        }
        
     //check if colorist exists in db. if so, get colorist ID. if not, add and get colorist ID.     
    if (mysql_num_rows($check_colorist) > 0) {
        $string = "SELECT * FROM colorist WHERE firstname = '$coloristfirst' AND lastname = '$coloristlast'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $coloristID = $row[2];
        }
    else {
        $query_colorist = "INSERT INTO colorist (firstname, lastname) VALUES ('$coloristfirst', '$coloristlast')";
        $result = mysql_query("SELECT firstname, lastname FROM colorist");
        if (!mysql_query($query_colorist, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $coloristID = mysql_insert_id();
        }
        
    //check if letterer exists in db. if so, get letterer ID. if not, add and get letterer ID.     
    if (mysql_num_rows($check_letterer) > 0) {
        $string = "SELECT * FROM letterer WHERE firstname = '$lettererfirst' AND lastname = '$lettererlast'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $lettererID = $row[2];
        }
    else {
        $query_letterer = "INSERT INTO letterer (firstname, lastname) VALUES ('$lettererfirst', '$lettererlast')";
        $result = mysql_query("SELECT firstname, lastname FROM letterer");
        if (!mysql_query($query_letterer, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $lettererID = mysql_insert_id();
        }
        
    //check if coverartist exists in db. if so, get coverartist ID. if not, add and get coverartist ID.     
    if (mysql_num_rows($check_coverartist) > 0) {
        $string = "SELECT * FROM coverartist WHERE firstname = '$coverartistfirst' AND lastname = '$coverartistlast'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $coverartistID = $row[2];
        }
    else {
        $query_coverartist = "INSERT INTO coverartist (firstname, lastname) VALUES ('$coverartistfirst', '$coverartistlast')";
        $result = mysql_query("SELECT firstname, lastname FROM coverartist");
        if (!mysql_query($query_coverartist, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $coverartistID = mysql_insert_id();
        }
        
    //check if covercolorist exists in db. if so, get covercolorist ID. if not, add and get covercolorist ID.     
    if (mysql_num_rows($check_covercolorist) > 0) {
        $string = "SELECT * FROM covercolorist WHERE firstname = '$covercoloristfirst' AND lastname = '$covercoloristlast'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $covercoloristID = $row[2];
        }
    else {
        $query_covercolorist = "INSERT INTO covercolorist (firstname, lastname) VALUES ('$covercoloristfirst', '$covercoloristlast')";
        $result = mysql_query("SELECT firstname, lastname FROM covercolorist");
        if (!mysql_query($query_covercolorist, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $covercoloristID = mysql_insert_id();
        }
    
    //check if family exists in db. if so, get family ID. if not, add and get family ID.     
    if (mysql_num_rows($check_family) > 0) {
        $string = "SELECT * FROM family WHERE familyname = '$family'";
        $result = mysql_query($string, $db_server);
        $row = mysql_fetch_row($result);
        $familyID = $row[2];
        }
    else {
        $query_family = "INSERT INTO family (familyname, publisherID) VALUES ('$family', '$publisherID')";
        $result = mysql_query("SELECT familyname FROM family");
        if (!mysql_query($query_family, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
        $familyID = mysql_insert_id();
        }
        
        
    //insert all collected information & ids into comic table
    $query_comic = "INSERT INTO comic (seriesID, volume, number, subtitle, limitedseries, pubmonth, pubyear, isbn, writerID, artistID, inkerID, coloristID, lettererID, coverartistID, covercoloristID, familyID, publisherID) VALUES ('$seriesID', '$volume', '$number', '$subtitle', '$limitedseries', '$pubmonth', '$pubyear', '$isbn', '$writerID', '$artistID', '$inkerID', '$coloristID', '$lettererID', '$coverartistID', '$covercoloristID', '$familyID', '$publisherID')";
    $result = mysql_query("SELECT seriesID FROM comic");
    if (!mysql_query($query_comic, $db_server)) {echo "INSERT failed: $query<br />" . mysql_error() . "<br /><br />";}
    
    //add message to session saying it worked and go back to index
    session_start();
    $_SESSION['msg'] = "Record added successfully";
    header('Location: add.php');
    return; 
    }
    
//display session messages
session_start();
if (isset($_SESSION['msg'])) {
    echo ('<p style="color:green;">' . $_SESSION['msg'] . '</p>');
    unset($_SESSION['msg']);


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
    return mysql_real_escape_string($_POST[$var]);
}

?>