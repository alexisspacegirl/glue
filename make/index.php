<!DOCTYPE html>
<html>
<head>
<title>Making Glue</title>
<?php
echo "<link rel='stylesheet/less' href='../themes/";
if ($_GET["theme"]) { if (strlen($_GET["theme"]) <= 8) {
echo $_GET["theme"]; } else { echo "basic"; } } else { echo "basic"; }
echo ".less' />\n";
?>
<script src='../js/less.js'></script>
</head>
<body>
<h1>Making Glue</h1>
<hr />
<form action='post.php' method='post'>
<input type='hidden' name='theme' value='<?php if ($_GET["theme"]) echo $_GET["theme"]; ?>' />
<textarea name='content' rows=24></textarea>
<br />
<input type='submit' />
</form>
</body>
</html>
