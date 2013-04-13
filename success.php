<?php
session_start();
require_once "db.php";

if ( isset($_SESSION['username']) ) {
   echo('<p>Welcome '.htmlentities($_SESSION['username']). ' You have logged in.</p>'."\n");
   echo('<p><a href="logout.php">Logout</a></p>'."\n");
   return;
}
?>

<h1> Success! You logged in properly </h1>
<p>Hello you foolish <? echo('Hola'.htmlentities($_SESSION['username']) ?></p>
<p> <a href="logout.php"> Log Out </a>