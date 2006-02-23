<?php

# file: db.inc.php

# create db-connection:
$dbcnx = @mysql_pconnect($db_host,$db_user,$db_pass);

# select db:
@mysql_select_db($db_name);

?>
