<?php

@include($_SERVER['DOCUMENT_ROOT'].'/incs/accesscontrol.php');

print_header(". {$blog_title} | Tilf�j bruger", 'edit.css', $domain_name, $description, $key_words, $dc_title, $install_path);

?>
<div id="wrapper">
<div id="top">
<p style="float: right;">Bruger: <?=$_SESSION['aname'];?></p>
<h1 style="color: white;">Administration af <?=stripslashes($blog_title);?> p� http://<?=$domain_name.$install_path;?>/</h1>
</div>
<?=$edit_menu;?>
<div id="add">
<form action="<?=$install_path;?>/au.php" method="POST" id="adduser">
<div>
<h1>Tilf�j bruger</h1>
<p>Skriv brugernavn, password og email for den person du gerne vil tilf�je som forfatter.</p>
</div>
<div style="font-family: monospace;">
<label>Brugerid:</label><input type="text" name="new_name" /><br />
<label>Password:</label><input type="password" name="new_passwd" /><br />
<label>Email:</label><input type="text" name="new_email" /><br />

<input type="submit" name="submit" value="Tilf�j bruger" style="width: 95%; display: block;" />
</div>
</form>
</div>
</div>
<?php
	if(isset($_POST['submit'])) {
		if(($_POST['new_name'] != "") && ($_POST['new_passwd'] != "") && ($_POST['new_email']) != '') {
			$nname = $_POST['new_name'];
			$npasswd = $_POST['new_passwd'];
			$nemail = $_POST['new_email'];
			$sql = "
					INSERT INTO authors SET
					name = ('{$nname}'),
					email = ('{$nemail}'),
					passwd = md5('{$npasswd}')";
			if(!$result = mysql_query($sql)) {
				print '<p style="padding-left: 10px;">An error occured. '.mysql_error().'</p>';
			} else {
				print '<p style="padding: 10px;">Brugeren '.$nname.' er tilf�jet med emailadressen: '.$nemail.'.</p><p>';
			}
			} else {
		print '<p style="padding-left: 10px;">Du skal udfylde alle felter.</p>';
	}
}
?>
</div>
<?php
print_footer();
?>
