<?php
#include('/home/voss/blog/incs/config.inc.php');

$db_host = "mysql.verture.net";
$db_user = "voss";
$db_pass = "cautha";
$db_name = "verture_blog";

# create db-connection:
$dbcnx = @mysql_pconnect($db_host,$db_user,$db_pass);
if(!$dbcnx) {
	print "<p>".mysql_error()."</p>";
}

# select db:
if(!@mysql_select_db($db_name)) {
	Print "<p>Unable to connect to database.".mysql_error()."</p>";
}

# include('/home/voss/public_html/blog/incs/db.inc.php');
$basepath = '/home/voss/stuff/';

if(!$_GET['file']) {
	print 'Nothing to see here, move along.';
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
	$file = $_GET['file'];
	$time = time() + ($offset * 3600);
#	$filename= "vesterby_voss-the_eyes_of_the_beholder.pdf"; // the name the file will have on client computer
	$file_to_download= $basepath.$file; // the name the file has on the server (or an FTP or HTTP request)
    $sql = "INSERT INTO dls SET
	filename = ('{$file}'),
	ip = ('{$ip}'),
	timestamp = ('$time')";
	$result = @mysql_query($sql) or print mysql_error();
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"$file\"");
	header("Content-Description: File Transfert");
	@readfile($file_to_download);
/*	$sql = "INSERT INTO dls SET
		filename = ('{$file}'),
		ip = ('{$ip}'),
		timestamp = ('$time')";
	$result = @mysql_query($sql) or print mysql_error(); */
}
mysql_close($dbcnx);
?>
