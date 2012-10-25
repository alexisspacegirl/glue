<?php

// Break if there's no content ====----
if ($_POST["theme"] != "") { $theme = "?theme=" . $_POST["theme"]; } else { $theme = ""; }
if (!($_POST["content"])) { header("Location: ../make$theme"); exit; }
if ($_POST["theme"] != "") { $theme = "&theme=" . $_POST["theme"]; } else { $theme = ""; }


// Function to sanitize input ====----
function check_input($value) {
if (get_magic_quotes_gpc()) { $value = stripslashes($value); }
if (!is_numeric($value)) { $value = "'" . mysql_real_escape_string($value) . "'"; }
return $value; }

// Connect to the database ====----
include "../php/passwords.php";
$con = mysql_connect($mysql_server, $mysql_user, $mysql_pass);
mysql_select_db($mysql_db, $con);

// Assemble SQL query ====----
$content = check_input($_POST['content']);
$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO glue VALUES(NULL, $content, '$date')";
mysql_query($sql);

// Redirect to new post ====----
$id = mysql_query("SELECT COUNT(*) FROM glue");
list($id) = mysql_fetch_array($id);
header("Location: ../eat?id=$id" . $theme);

?>
