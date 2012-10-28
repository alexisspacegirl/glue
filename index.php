<!DOCTYPE html>
<html>
<head>
<title>Glue</title>
<?php
echo "<link rel='stylesheet/less' href='themes/";
if ($_GET["theme"]) { if (strlen($_GET["theme"]) <= 8) {
echo $_GET["theme"]; } else { echo "basic"; } } else { echo "basic"; }
echo ".less' />\n";
?>
<script src='js/less.js'></script>
</head>
<body>
<div id='theme'><a href='?<?php
if (!($_GET["theme"])) echo "theme=dark";
?>'>Change Theme</a></div>
<h1>Glue</h1>
<h2>Minimalistic Pastebin</h2>
<hr />
<?php
$theme = ""; if ($_GET["theme"]) {
if (strlen($_GET["theme"]) <= 8) { $theme = "?theme=" . $_GET["theme"]; } }
echo "<p><a href='read$theme'>Read</a> &ndash; ";
echo "<a href='make$theme'>Make</a> &ndash; ";
echo "<a href='eat$theme'>Eat</a></p>";
?>
<hr />
<p><a href='http://github.com/adamhovorka/glue'>Fork me on GitHub</a></p>
</body>
</html>
