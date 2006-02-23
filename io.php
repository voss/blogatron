<?php

@include('/home/voss/blog/incs/config.inc.php');

$click = $_GET['click'];
$fp = @fopen('/home/voss/linkout.txt', 'a');
@fputs($fp, $click.": ".$_SERVER['REMOTE_ADDR'].":\t".date('r', (time() + ($offset * 3600)))."\n");
@fclose($fp);
header("Location: ".$click."");

?>
