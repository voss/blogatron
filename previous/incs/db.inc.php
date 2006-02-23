<?php

# file: db.inc.php

# create db-connection:
$dbcnx = @mysql_connect($db_host,$db_user,$db_pass);
if(!$dbcnx) {
	print "<p>Der skete en fejl. MySQL siger: ".mysql_error()."</p>";
	print '<p>Hvis du gider må du meget gerne sende mig en <a href="mailto:jonas.voss@gmail.com">mail</a> om det, så jeg kan argumentere min sag for min udbyder. Mvh, Jonas.</p>';
	exit();
}

# select db:
if(!@mysql_select_db($db_name)) {
	Print "<p>Kunne ikke forbinde til Databasen. MySQL siger: ".mysql_error().".</p>";
}

?>
