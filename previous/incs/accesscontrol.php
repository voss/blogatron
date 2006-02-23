<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/incs/config.inc.php');
include_once($inc_path.'db.inc.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/functions/functions.inc.php');
include_once($inc_path.'includes.inc.php');
/*
print '<pre>';
print_r($_SESSION);
print '</pre>';
*/
$aname = isset($_POST['aname']) ? $_POST['aname'] : $_SESSION['aname']; 
$apasswd = isset($_POST['apasswd']) ? $_POST['apasswd'] : $_SESSION['apasswd'];

if(!isset($aname))
{
	print_header(". {$domain_name} | Login","edit", $domain_name, $description, $key_words);
	print "<div id=\"wrapper\">";
	print '<div id="top">';
	print '<h1>Login for at administrere '.$blog_title.' på http://'.$domain_name.'/</h1>';
	print "</div>";
	print "<div id=\"add\">";
	print $login_form;
	print "</div>";
	print "</div>";
	print_footer();
	exit();
}

$_SESSION['aname'] = $aname;
$_SESSION['apasswd'] = $apasswd;

$sql ="SELECT * FROM authors WHERE name = ('{$aname}') AND passwd = MD5('{$apasswd}')";
$result = mysql_query($sql);

if(!$result)
{
	print_header(". {$domain_name} | Login","edit", $domain_name, $description, $key_words);
	print "<div id=\"wrapper\">";
	print '<div id="top">';
	print '<h1>Login for at administrere '.$blog_title.' på http://'.$domain_name.'/</h1>';
	print "</div>";
	print "<div id=\"add\">";
	print '<p style="color: red;">Databasefejl &mdash; prøv igen. Hvis problemet vedbliver, kontakt da venligst den ansvarlige på <a href="mailto:'.$admin_address.'">'.$admin_address.'</a>.</p>';
	print $login_form;
	print "</div>";
	print "</div>";
	print_footer();
	exit();

}

if(mysql_num_rows($result) == 0)
{
	unset($_SESSION['aname']);
	unset($_SESSION['apasswd']);
	print_header(". {$domain_name} | Login .","edit", $domain_name, $description, $key_words);
	print "<div id=\"wrapper\">";
	print '<div id="top">';
	print '<h1>Login for at administrere '.$blog_title.' på http://'.$domain_name.'/</h1>';
	print "</div>";
	print "<div id=\"add\">";
	print '<p style="color: red;">Forkert brugerid og/eller password &mdash; prøv igen.</p>';
	print $login_form;
	print "</div>";
	print "</div>";
	print_footer();
	exit();
}

$_SESSION['aid'] = mysql_result($result,0,'uid'); 
#print $_SESSION['aid'];
?>
