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


// Standard header stuff ====----
echo "<!DOCTYPE html>\n<html>\n<head>\n<title>Reading Glue</title>\n".
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
	echo "<h3><a href='../eat?id=" . $id . "'>" . $id . "</a></h3>\n";

	// Date ==--
	echo "<h4>" . $date . "</h4>\n";

	// Content ==--
	$output = explode("\n", htmlentities($content));
	foreach ($output as $line) { if ($line != "\r") echo "<p>" . $line . "</p>\n"; }

	// Separator ==--
	echo "<hr />\n";
}


// Pagination ====----
if ($page == 0) { echo  "<h4><a href='?page=" . ceil($count / 5) . "'>Back</a></h4>\n"; } else {
if ($begin == 1) { if ($end != $count) echo "<h4><a href='?page=" . ($page + 1) . "'>Next</a></h4>\n";
} else { if ($end == $count) { echo "<h4><a href='?page=" . ($page - 1) . "'>Back</a></h4>\n";
} else { echo "<h4><a href='?page=" . ($page - 1) . "'>Back</a> &ndash; <a href='?page=" .
($page + 1) . "'>Next</a></h4>\n";  } } }


// Standard footer stuff ====----
echo "</body>\n</html>";
mysql_close($con);

?>
