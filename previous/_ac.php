<?php

# file: add_comment.php
# Include config:
include_once($_SERVER['DOCUMENT_ROOT'].'/incs/config.inc.php');
include_once($_SERVER['DOCUMENT_ROOT']."/incs/db.inc.php");
include_once($_SERVER['DOCUMENT_ROOT']."/functions/functions.inc.php");
include_once($_SERVER['DOCUMENT_ROOT']."/incs/includes.inc.php");

if(isset($_POST['eid']) && isset($_POST['c_submit'])) {
	if(empty($_POST['c_text']) || empty($_POST['c_author'])) {
		print_header(". {$domain_name} | fejl .","edit", $description, $key_words, $dc_title);
#		@include($_SERVER['DOCUMENT_ROOT'].'/incs/menu_top.inc');
		@include($_SERVER['DOCUMENT_ROOT'].'/incs/rightc.inc');
		print "<div style=\"padding:20px; \">\n";
		print "<h1>Fejl</h1>\n";
		print "<p>Du glemte at udfylde et af felterne.<br />Gå <a href=\"javascript:history.back(-1)\">tilbage</a> og udfyld det manglende felt</p>\n</div>\n";
		@include($_SERVER['DOCUMENT_ROOT']."/incs/postpost.inc");
		print_footer();
		exit();
	} else {
		$c_author = $_POST['c_author'];
		$c_text = $_POST['c_text'];
		$c_email = $_POST['c_email'];
		$c_url = $_POST['c_url'];
		$c_ip = $_SERVER['REMOTE_ADDR'];
		$eid = $_POST['eid'];
		$comment_url = stripslashes(stripslashes($_POST['comment_url']));
		$etitle = stripslashes(stripslashes($_POST['etitle']));
		$c_msg = "Browser: {$_SERVER['HTTP_USER_AGENT']}\n";
		$c_msg .= "IP:     {$c_ip}\n";
		$c_msg .= "Navn:   {$c_author}\n";
		$c_msg .= "email:  {$c_email}\n";
		$c_msg .= "URL:    {$c_url}\n\n";
		$c_msg .= "Besked:\n\n";
		$c_msg .= stripslashes($c_text)."\n\n";
		$c_msg .= "Indlæg:	{$comment_url}#c\n\n";
		$c_msg .= "-- \nDrevet af mig og PHP v".phpversion();
		$subject = "[verture.net] Kommentar til '{$etitle}'";
		$c_msg = strip_tags($c_msg, '<a>');
		
		# Initiate mail-settings:
		$headers = "From: $c_author <$c_email>\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: quoted-printable";
		@mail($comments_address,$subject,$c_msg,$headers);
		if($_POST['bakecookie'] == 'on') {
			setcookie("blogatron_author","{$c_author}", time()+3600*24*365, "/");
			setcookie("blogatron_email","{$c_email}", time()+3600*24*365, "/");
			setcookie("blogatron_url","{$c_url}", time()+3600*24*365, "/");
		} 
		if($_POST['bakecookie'] == 'off') {
			setcookie("blogatron_author","", time()-3600*24, "/");
			setcookie("blogatron_email","", time()-3600*24, "/");
			setcookie("blogatron_url","", time()-3600*24, "/");
		}
		$c_text = format_comment($c_text);
		$c_author = format_comment($c_author);
		$c_email = format_email($c_email);
		$c_url = format_url($c_url);				
		$date = time() + ($offset * 3600);
		$sql = "
			INSERT INTO comments set 
			c_author = ('{$c_author}'),
			c_text = ('{$c_text}'),
			c_email = ('{$c_email}'),
			c_url = ('{$c_url}'),
			c_ip = ('{$c_ip}'),
			date = ('$date'),
			eid = ('{$eid}')";
			if(!$result = @mysql_query($sql)) {
				print "<p>Der skete en fejl: ".mysql_error()."</p>";
				print "<p>{$sql}</p>";
			}
		header("Location: ".stripslashes($comment_url)."#c");
	}
	
} else {
	print_header(". {$domain_name} | kukabuxilah .","", $domain_name, $description, $key_words);
	include($_SERVER['DOCUMENT_ROOT'].'/incs/menu_top.inc');
	include($_SERVER['DOCUMENT_ROOT'].'/incs/links.inc');
	print "<p>Hello World</p>";
	include($_SERVER['DOCUMENT_ROOT']."/incs/postpost.inc");
	print_footer();
}
?>
<?php
	mysql_close($dbcnx);
?>
