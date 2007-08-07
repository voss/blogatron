<html>
<head>
<title>Filstatistik</title>
</head>
<body>
<?php

# Including settings and db instructions:
include('/home/voss/blog.verture.net/incs/config.inc.php');
include('/home/voss/blog.verture.net/incs/db.inc.php');

# Setting timezone:
putenv("TZ=Europe/Dublin");

$stat_sql = "SELECT * from dls order by timestamp asc";
$result = mysql_query($stat_sql) or print mysql_error();
$numrows = mysql_num_rows($result);
?>
<table border="1">
<th>IP</th><th>filnavn</th><th>klokkeslet</th>
<?php
while($row = mysql_fetch_array($result)) {
	extract($row);
	$date = date('r', $timestamp);
	print "<tr style=\"font-family: monospace\"><td>{$ip}</td><td>{$filename}</td><td>{$date}</td></tr>";
}
?>
</table>
<p><?=$numrows;?> har nedlastet filen</p>
</body>
</html>
<?php
	mysql_close($dbcnx);
?>
