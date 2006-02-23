<?php

# Include config:
include('incs/config.inc.php');

if(!empty($_GET['q'])) {
	$q = $_GET['q'];
	$q = urlencode($q);
	header("Location: http://{$domain_name}/search/{$q}");
	exit();
}

?>