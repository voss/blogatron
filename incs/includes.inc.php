<?php
#file : includes.inc.php

global $install_path;

## Login-form ##

$login_form =
'
<form action="'.$_SERVER['PHP_SELF'].'" method="post">
	<dl>
        <dt><label style="color: #595d0c">Brugerid:</label></dt> <dd><input type="text" name="aname" /></dd>
        <dt><label style="color: #595d0c">Password:</label><dt> <dd><input type="password" name="apasswd" /></dd>
		<dd><input type="submit" value="Login" style="" /></dd>
    </dl>
</form>
';

## Mail form ##

$mail_form =
'<form action="/kontakt/#mail" method="post" id="mail">
	<div>
	<p style="padding: 0; margin: 0; font-size: x-small;"><span style="color: #c00; font-weight: bold;">*</span> = skal udfyldes.</p>
	<label>Navn: </label><br />
	<input type="text" name="sender" /><br />
	<label>Email: </label><span style="color: #c00; font-weight: bold;">*</span><br />
	<input type="text" name="addy" /><br />
	Indsæt Æ i dette felt: 	<input type="text" name="humanoid" size="1" /><br />
	<label>Besked: </label><span style="color: #c00; font-weight: bold;">*</span><br />
	<textarea rows="10" cols="40" name="msg"></textarea><br />
	<input type="submit" name="submit" value="Send" />
    </div>
</form>
';

# Checks for cookie-status to display the appropriate box in the comments form:
if(isset($_COOKIE["blogatron_author"])) {
	$checked_status[0] = 'checked="checked"';
	$checked_status[1] = '';
} else {
	$checked_status[0] = '';
	$checked_status[1] = 'checked="checked"';
}

$comments_form =
'<h2 id="comment">Skriv en kommentar</h2>
<form action="'.$install_path.'/opraab.php" method="post" id="ca">
    <div style="clear: left; width: 100%;">
    <input type="hidden" name="comment_url" value="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />
    <input type="hidden" name="etitle" value="'.$title.'" />
    <fieldset>
        <legend style="border: 1px solid #eee; background: white">( <span style="font-size: x-small;"><span style="color: #c00; font-weight: bold;">*</span> = Skal udfyldes</span> )</legend>
        <p><label>Navn</label> <span style="color: #c00; font-weight: bold;">*</span><br />
        <input type="text" name="c_author" value="'.$_COOKIE['blogatron_author'].'" size="30" /></p>
        <p><label>Email</label><br />
        <input type="text" name="c_email" value="'.$_COOKIE['blogatron_email'].'" size="30" /></p>
        <p><label>URL [husk http://]</label><br />
        <input type="text" name="c_url" value="'.$_COOKIE['blogatron_url'].'" size="30" /></p>
		<p><label>Anti-spam! Indsæt Æ i dette felt: <span style="color: #c00; font-weight: bold;">*</span></label>
        <input type="text" name="c_humanoid" value="'.$_COOKIE['blogatron_humanoid'].'" size="1" /></p>
        <p>
        <input type="hidden" name="eid" value="'.$id.'" />
        <label class="kage">Husk mig</label> <input style="border: 0;" type="radio" name="bakecookie" '.$checked_status[0].' />
        <label class="kage">Husk mig ej</label> <input style="border: 0;" type="radio" name="bakecookie" '.$checked_status[1].' value="off" />
        </p>
    </fieldset>
    <p style="margin-bottom: 0;padding-bottom;"><label>Kommentar</label> <span style="color: #c00; font-weight: bold;">*</span><br />
    <textarea cols="23" rows="10" name="c_text" style="font-size: small; width: 90%"></textarea></p>
    <p id="tilladt">Tilladt HTML: &lt;a href="..."&gt;, &lt;b&gt;, &lt;em&gt;, &lt;q&gt;.</p>
    <p>
        <input type="submit" name="c_submit" value="Tilføj kommentar" style="margin-left: 60%;" />
    </p>
    <br />
    </div>
</form>
';


## edit_menu
if($_SESSION['aid'] == 1)
{
	$edit_menu = array
	(
		'Nyt indlæg' => $install_path.'/add/',
		'Indlægshåndtering' => $install_path.'/edit/',
		'Tilføj bruger' => $install_path.'/adduser/',
		'Se bloggen' => $install_path.'/',
		'Logud' => $install_path.'/ae.php?action=logout');
}
else
{
	$edit_menu = array
	(
		'Nyt indlæg' => $install_path.'/add/',
		'Indlægshåndtering' => $install_path.'/edit/',
		'Se bloggen' => $install_path.'/',
		'Logud' => $install_path.'/ae.php?action=logout'
	);
}
#$edit_menu = array_reverse($edit_menu);

# Flip the key->value pair to print the proper values in editmenu:
$edit_menu = array_flip($edit_menu);
?>
