<?php

$db_host = "mysql.verture.net";
$db_user = 'voss';
$db_pass = 'cautha';
$db_name = 'verture_blog';
$tbl_name = 'tblDivinyls';

$wax_dbcnx = @mysql_connect($db_host,$db_user, $db_pass) or print "<p>Der skete en fejl, MySQL siger ".mysql_error()."</p>";

@mysql_select_db($db_name) or print "<p>Kunne ikke forbinde til databasen {$db_name}</p>";

	$x = mysql_query("SELECT * FROM ".$tbl_name."");
	$y = mysql_num_rows($x);
	$z = $y - 10;
	$sql = "SELECT * FROM ".$tbl_name." where format != 'CD' ORDER BY 'id' DESC limit 0,10";
	$result = @mysql_query($sql) or print "<p>Ups, der er sket en fejl</p>";
  print "<h1 style=\"margin:10px 0;\">&raquo; Har senest erhvervet</h1>";
#  print "<p style='padding-bottom: 3px; margin-top: 0; margin-bottom: 2px;'>via <a href='wax.verture.net'>Plader</a></p>";
  print "<ul>\n";
  while($row = @mysql_fetch_array($result)) {
    print "<li>\n";
    print "<strong>".htmlspecialchars(stripslashes($row[artist]))."</strong><br />\n";
    print "<em>".htmlspecialchars(stripslashes($row[title]))."</em>\n";
    print "</li>\n";
	}
  print "</ul>\n";

?>
