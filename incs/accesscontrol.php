<?php
session_start();
@include('config.inc.php');
@include('db.inc.php');
@include('functions.inc.php');
@include('includes.inc.php');

$aname = isset($_POST['aname']) ? $_POST['aname'] : $_SESSION['aname']; 
$apasswd = isset($_POST['apasswd']) ? $_POST['apasswd'] : $_SESSION['apasswd'];

if(!isset($aname))
{
	print_header(". {$domain_name} | Login","edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
	print '<div id="loginwrapper">';
	print $login_form;
	print '</div>';
	print_footer();
	exit();
}

$_SESSION['aname'] = $aname;
$_SESSION['apasswd'] = $apasswd;

$sql ="SELECT * FROM authors WHERE name = ('{$aname}') AND passwd = MD5('{$apasswd}')";
$result = mysql_query($sql);

if(!$result)
{
	print_header(". {$domain_name} | Login","edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
	print '<div id="loginwrapper">';
	print '<p class="explainerror">Databasefejl &mdash; prøv igen. Hvis problemet vedbliver, kontakt da venligst den ansvarlige på <a href="mailto:'.$admin_address.'">'.$admin_address.'</a>.</p>';
	print $login_form;
	print '</div>';
	print_footer();
	exit();

}

if(mysql_num_rows($result) == 0)
{
	unset($_SESSION['aname']);
	unset($_SESSION['apasswd']);
	print_header(". {$domain_name} | Login .","edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
	print '<div id="loginwrapper">';
	print '<p class="explainerror">Forkert brugerid og/eller password &mdash; prøv igen.</p>';
	print $login_form;
	print '</div>';
	print_footer();
	exit();
}

$_SESSION['aid'] = mysql_result($result,0,'uid'); 
?>
