<?php

// Connect to the database ====----
include "../php/passwords.php";
$con = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
mysql_select_db($mysql_db, $con);


// Get glue count ====----
$count = mysql_query("SELECT COUNT(*) FROM glue");
list($count) = mysql_fetch_array($count);


// Calculate page ====----
$page = $_GET["page"]; if (!($page)) { $page = 0; $end = $count; } else { $end = $page * 5; }
$begin = $end - 4; if ($begin < 1) $begin = 1; if ($end > $count) $end = $count;

include "../php/ago.php";

// Standard header stuff ====----
echo "<!DOCTYPE html>\n<html>\n<head>\n<title>Reading Glue</title>\n".
     "<link rel='stylesheet/less' href='../themes/";
if ($_GET["theme"]) { if (strlen($_GET["theme"]) <= 8) {
echo $_GET["theme"]; } else { echo "basic"; } } else { echo "basic"; }
echo ".less' />\n".
     "<script src='../js/less.js'></script>\n".
     "<script src='../js/jquery.js'></script>\n".
     "<script src='../js/markup.js'></script>\n".
     "<script>$(function(){ $('p').markup(); });</script>\n".
     "</head>\n<body>\n";

// Title ====----
echo "<h1>Reading Glue</h1>\n";
if ($page == 0) { echo "<h2>Newest</h2>\n"; } else { echo "<h2>Page " . $page . "</h2>\n"; }
echo "<hr />\n";


// Read out glue ====----
$result = mysql_query("SELECT * FROM glue WHERE id BETWEEN " . $begin . " AND " . $end . " ORDER BY id ASC");
while ( list( $id, $content, $date ) = mysql_fetch_array($result) ) {

	// Link to eat ==--
	echo "<h3><a href='../eat?id=" . $id;
	if ($_GET["theme"]) echo "&theme=" . $_GET["theme"];
	echo "'>" . $id . "</a></h3>\n";

	// Date ==--
	echo "<h4>" . ago($date) . "</h4>\n";

	// Content ==--
	$output = explode("\n", htmlentities($content));
	foreach ($output as $line) { if ($line != "\r") echo "<p>" . $line . "</p>\n"; }

	// Separator ==--
	echo "<hr />\n";
}


// Pagination ====----
if ($page == 0) {
	echo  "<h4 id='pagination'><a id='back' href='?page=" . (ceil($count / 5) - 1);
	if ($_GET["theme"]) echo "&theme=" . $_GET["theme"];
	echo "'>Back</a></h4>\n";
} else {
	if ($begin == 1) {
		if ($end != $count) { echo "<h4 id='pagination'><a id='next' href='?page=" . ($page + 1);
		if ($_GET["theme"]) echo "&theme=" . $_GET["theme"];
		echo "'>Next</a></h4>\n"; }
	} else {
		if ($end == $count) {
			echo "<h4 id='pagination'><a id='back' href='?page=" . ($page - 1);
			if ($_GET["theme"]) echo "&theme=" . $_GET["theme"];
			echo "'>Back</a></h4>\n";
		} else {
			echo "<h4 id='pagination'><a id='back' href='?page=" . ($page - 1);
			if ($_GET["theme"]) echo "&theme=" . $_GET["theme"];
			echo "'>Back</a> &ndash; <a id='next' href='?page=" . ($page + 1);
			if ($_GET["theme"]) echo "&theme=" . $_GET["theme"];
			echo "'>Next</a></h4>\n"; } } }


// Standard footer stuff ====----
echo "</body>\n</html>";
mysql_close($con);

?>
