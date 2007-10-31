<?php

@include('/home/voss/blog.verture.net/incs/config.inc.php');

# Set timezone:
putenv("TZ=Europe/Dublin");

$click = $_GET['click'];
$fp = @fopen('/home/voss/linkout.txt', 'a');
@fputs($fp, $click.": ".$_SERVER['REMOTE_ADDR'].":\t".date('r',time())."\n");
@fclose($fp);
header("Location: ".$click."");

?>
