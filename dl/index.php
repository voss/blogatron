<?php
# Including settings and db instructions:
include('/home/voss/blog.verture.net/incs/config.inc.php');
include('/home/voss/blog.verture.net/incs/db.inc.php');

# Set timezone:
putenv("TZ=Europe/Dublin");

$basepath = '/home/voss/stuff/';

if(!$_GET['file'])
{
	print 'Nothing to see here, move along.';
} 
else {
	$ip = $_SERVER['REMOTE_ADDR'];
	$file = $_GET['file'];
	$time = time(); // + ($offset * 3600);
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
	header("Content-Description: File Transfer");
	header("Content-Length: ". filesize($file_to_download) ."");
	@readfile($file_to_download);
/*	$sql = "INSERT INTO dls SET
		filename = ('{$file}'),
		ip = ('{$ip}'),
		timestamp = ('$time')";
	$result = @mysql_query($sql) or print mysql_error(); */
}
mysql_close($dbcnx);
?>
