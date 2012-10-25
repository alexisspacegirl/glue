<!DOCTYPE html>
<html>
<head>
<title>Glue</title>
<?php
echo "<link rel='stylesheet/less' href='themes/";
if ($_GET["theme"]) { echo $_GET["theme"];
} else { echo "basic"; }
echo ".less' />\n";
?>
<script src='js/less.js'></script>
</head>
<body>
<h1>Glue</h1>
<h2>Minimalistic Pastebin</h2>
<hr />
<?php
echo "<p><a href='read";
if ($_GET["theme"]) echo "?theme=" . $_GET["theme"];
echo"'>Read</a> &ndash; ";
echo "<a href='make";
if ($_GET["theme"]) echo "?theme=" . $_GET["theme"];
echo "'>Make</a> &ndash; ";
echo "<a href='eat";
if ($_GET["theme"]) echo "?theme=" . $_GET["theme"];
echo "'>Eat</a></p>";
?>
<hr />
<p><a href='http://github.com/adamhovorka/glue'>Fork me on GitHub</a></p>
</body>
</html>
