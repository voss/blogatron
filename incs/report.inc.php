<?php
/*
130.226.186.12
if($_SERVER['REMOTE_ADDR'] == '130.225.208.205' || $_SERVER['REMOTE_ADDR'] == '192.38.106.174' || $_SERVER['REMOTE_ADDR'] == '62.243.38.186' || $_SERVER['REMOTE_ADDR'] == '130.226.186.100') {
	putenv("TZ=CET");
	$msg = date("r", time());
	$msg .= "\n\n";
	$msg .= "Referer:\n";
	$msg .= $_SERVER['HTTP_REFERER'];
	$msg .= "\n\n";
	$msg .= "User agent:\n";
	$msg .= $_SERVER['HTTP_USER_AGENT'];
	$msg .= "\n\n";
	$msg .= "Remote address:\n";
	$msg .= $_SERVER['REMOTE_ADDR'];
	$msg .= "\n\n";
	$msg .= "Request URI:\n";
	$msg .= $_SERVER['REQUEST_URI'];
	$msg .= "\n\n";
	$msg .= "Remote host:\n";
	$msg .= $_SERVER['REMOTE_HOST'];
	$to = 'jonas@verture.net';
	$headers = "From: Your friendly reporter <reporter.bot@verture.net>\n";
	$subject = 'visitor: '.$_SERVER['REMOTE_ADDR'].'';
	@mail($to,$subject,$msg,$headers);
}
*/
?>
