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
'<form action="/contact/#mail" method="post" id="mail">
	<fieldset>
		<legend id="required">Required field</legend>
		<p><label>Name:</label><br />
		<input type="text" name="sender" id="sender" /></p>
		<p><label>Email:</label><br />
		<input type="text" name="addy" id="addy"/></p>
    <p><label>Subject:</label><br />
    <input type="text" name="subject" id="subject" /></p>
		<label>Message:</label><br />
		<div style="width: 99%;"><textarea rows="10" cols="40" name="msg" id="message" style="font-size: small; width: 100%"></textarea><br />
			<p style="display:inline; text-align: right"><label>Do a little math: 3 x 3 =</label> <input type="text" name="humanoid" id="humanoid" size="1" /> <input type="submit"
name="submit" value="Send &rArr; " style="padding: 5px;font-weight:
bold; font-size: medium;"/></p>
		</div>
    </fieldset>
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
'<div id="comment">
<h2>Leave a comment</h2>
<form action="'.$install_path.'/opraab.php" method="post" id="ca" onsubmit="validateComment(); return false;">
    <fieldset>
    <div style="clear: left; width: 100%;">
    <input type="hidden" name="comment_url" value="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />
    <input type="hidden" name="etitle" value="'.$title.'" />
        <legend style="border: 1px solid #eee; background: white"><span style="font-size: x-small;"><span style="color: #c00; font-weight: bold;">*</span> = Required</span></legend>
        <p><label><span style="color: #c00; font-weight: bold;">*</span>Name</label><br />
        <input type="text" name="c_author" value="'.$_COOKIE['blogatron_author'].'" size="30" /></p>
        <p><label>Email</label><br />
        <input type="text" name="c_email" value="'.$_COOKIE['blogatron_email'].'" size="30" /></p>
        <p><label>URL [don\'t forget http://]</label><br />
        <input type="text" name="c_url" value="'.$_COOKIE['blogatron_url'].'" size="30" /></p>
		<p><label>Do a little math:<span style="color: #c00; font-weight: bold;">*</span> 3 x 3 = </label>
        <input type="text" name="c_humanoid" value="'.$_COOKIE['blogatron_humanoid'].'" size="1" /></p>
        <p>
        <input type="hidden" name="eid" value="'.$id.'" />
		<label>Remember info?</label>
        <label class="kage">Yes </label> <input style="border: 0;" type="radio" name="bakecookie" '.$checked_status[0].' />
        <label class="kage">No</label> <input style="border: 0;" type="radio" name="bakecookie" '.$checked_status[1].' value="off" />
        </p>
	    <p style="margin-bottom: 0;padding-bottom;"><label>Comment</label> <span style="color: #c00; font-weight: bold;">*</span><br />
	    <textarea cols="23" rows="10" name="c_text" style="font-size: small; width: 90%;"></textarea></p>
	    <p id="tilladt">Some HTML allowed: &lt;a href="..."&gt;,
&lt;b&gt;, &lt;em&gt;, &lt;q&gt;. <input type="submit" name="c_submit"
value="Submit comment &rarr;" style="margin-left: 20%;padding-right:
12px;" /></p>
    </div>
    </fieldset>
</form>
</div>
';


## edit_menu

$edit_menu = array
(
	'Nyt indlæg' => $install_path.'/add/',
	'Indlægshåndtering' => $install_path.'/edit/',
	'Linkrulle' => $install_path.'/sheriff/linkage.php',
	'Se bloggen' => $install_path.'/',
	'Logud' => $install_path.'/sheriff/ae.php?action=logout',
	'Tilføj bruger' => $install_path.'/adduser/'
);

if($_SESSION['aid'] != 1)
{
	array_pop($edit_menu);
}
# Flip the key->value pair to print the proper values in editmenu:
$edit_menu = array_flip($edit_menu);
?>
