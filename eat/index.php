<?php

// Connect to the database ====----
include "../php/passwords.php";
$con = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
mysql_select_db($mysql_db, $con);


// Get glue count ====----
$count = mysql_query("SELECT COUNT(*) FROM glue");
list($count) = mysql_fetch_array($count);


// Make sure glue exists ====----
if ($_GET["id"]) { $id = $_GET["id"]; } else { $id = 1; }
if ($id > $count) $id = $count;


// Spit out the raw glue ====----
if ($_GET["raw"]) { header("Content-type: text/plain");
$result = mysql_query("SELECT * FROM glue WHERE id = " . $id);
while ( list( $theID, $content, $date ) = mysql_fetch_array($result) ) {
echo $content; }


} else {


// Standard header stuff ====----
echo "<!DOCTYPE html>\n<html>\n<head>\n<title>Eating Glue</title>\n".
     "<link rel='stylesheet/less' href='../themes/";
if ($_GET["theme"]) { echo $_GET["theme"]; } else { echo "basic"; }
echo ".less' />\n<script src='../js/less.js'></script>\n".
     "<script src='../js/jquery.js'></script>\n".
     "<script src='../js/markup.js'></script>\n".
     "<script>$(function(){ $('p').markup(); });</script>\n".
     "</head>\n<body>\n";


// Title ====----
echo "<h1>Eating Glue</h1>\n";
echo "<hr />\n";


// Read out glue ====----
$result = mysql_query("SELECT * FROM glue WHERE id = " . $id);
while ( list( $theID, $content, $date ) = mysql_fetch_array($result) ) {

	// Link to eat raw ==--
	echo "<h3>" . $id . " &ndash; <a href='?id=" . $id . "&raw=true'>RAW</a></h3>\n";

	// Date ==--
	include "../php/ago.php";
	echo "<h4>$date UTC &ndash; " . ago($date) . "</h3>\n";

	// Content ==--
	$output = explode("\n", htmlentities($content));
	foreach ($output as $line) { if ($line != "\r") echo "<p>" . $line . "</p>\n"; }

	// Separator ==--
	echo "<hr />\n";
}


// Pagination ====----
if ($_GET["theme"]) { $theme = "&theme=" . $_GET["theme"]; } else { $theme = ""; }
if ($id == 1) { echo "<h4 id='pagination'><a id='next' href='?id=" . ($id + 1) . $theme . "'>Next</a></h4>\n"; } else {
if ($id == $count) { echo "<h4 id='pagination'><a id='back' href='?id=" . ($id - 1) . $theme . "'>Back</a></h4>\n"; } else {
echo "<h4 id='pagination'><a id='back' href='?id=" . ($id - 1) . $theme . "'>Back</a> &ndash; <a id='next' href='?id=" . ($id + 1) . $theme . "'>Next</a></h4>\n"; } }


// Standard footer stuff ====----
echo "</body>\n</html>";
mysql_close($con);

} ?>
