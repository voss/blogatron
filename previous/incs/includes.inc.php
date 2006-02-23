<?php

#file : includes.inc.php

## Add entry form ##

$add_form =
'<form action="'.$_SERVER['PHP_SELF'].'" method="post">
<div style="margin: 0 20px 0 0; padding: 0; border: 0">
		<h1>Post et indlæg</h1>
        <input type="hidden" name="aid" value="1" />
        <label>Titel</label><br />
        <input type="text" name="title" size="25" /><br />
		<label>Dato og tid [tt,mm,ss,dd,mm,yyyy]</label><br />
		<input type="text" name="day" size="2" /><br />
		<div id="inputform">
		<label>Kommentarer</label>
		<input type="checkbox" checked="checked" name="comments" /><br />
        <label>Status:</label>
        <select name="status">
			<option value="0">Kladde</option>
			<option selected="selected" value="1">Postet</option>
		</select><br /><br />
        <input type="submit" name="submit" value="Send" />
        </div>
        <label>Tekst:</label><br />
        <textarea cols="55" rows="20" name="text" style="width: 75%"></textarea><br />
		<label>Udvidet Tekst:</label><br />
		<textarea cols="55" rows="30" name="text_more" style="width: 75%"></textarea>
    </div>
</form>
';

## Login-form ##

$login_form =
"<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">
    <div style=\"font-family: monospace\">
        <p><label style=\"color: #595d0c\">Brugerid:</label> <input type=\"text\" name=\"aname\" /></p>
        <p><label style=\"color: #595d0c\">Password:</label> <input type=\"password\" name=\"apasswd\" /></p>
        <p><input type=\"submit\" value=\"Login\" style=\"width: 95%; display: block;\" /></p>
    </div>
</form>

";

## Mail form ##

$mail_form =
'<form action="." method="post" id="mail">
	<div>
	<p style="padding: 0; margin: 0; font-size: x-small;"><span style="color: #c00; font-weight: bold;">*</span> = skal udfyldes.</p>
	<label>Navn: </label><br />
	<input type="text" name="sender" /><br />
	<label>Email: </label><span style="color: #c00; font-weight: bold;">*</span><br />
	<input type="text" name="addy" /><br />
	<label>Besked: </label><span style="color: #c00; font-weight: bold;">*</span><br />
	<textarea rows="10" cols="40" name="msg"></textarea><br />
	<input type="submit" name="submit" value="Send" />
    </div>
</form>
';

# Checks for cookie-status to check the appropriate box in the comments form:
if(isset($_COOKIE["blogatron_author"])) {
	$checked_status[0] = 'checked="checked"';
	$checked_status[1] = '';
} else {
	$checked_status[0] = '';
	$checked_status[1] = 'checked="checked"';
}

$comments_form =
'<form action="/ac.php" method="post" id="ca">
    <div style="clear: left;">
        <h2 id="comment" style="font-size: medium;">Skriv en kommentar</h2>
        <p style="font-size: x-small;"><span style="color: #c00; font-weight: bold;">*</span> = Skal udfyldes.</p>
        <p>
        <input type="hidden" name="eid" value="'.$id.'" />
        <input type="hidden" name="comment_url" value="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />
        <input type="hidden" name="etitle" value="'.$title.'" />
        <label>Navn</label> <span style="color: #c00; font-weight: bold;">*</span><br />
		<input type="text" name="c_author" value="'.$_COOKIE['blogatron_author'].'" size="30" /></p>
        <p><label>Email</label><br />
        <input type="text" name="c_email" value="'.$_COOKIE['blogatron_email'].'" size="30" /></p>
        <p><label>URL [husk http://]</label><br />
        <input type="text" name="c_url" value="'.$_COOKIE['blogatron_url'].'" size="30" /></p>
        <p>
        <label class="kage">Husk mig</label> <input style="border: 0;" type="radio" name="bakecookie" '.$checked_status[0].' /><br />
        <label class="kage">Husk mig ej</label> <input style="border: 0;" type="radio" name="bakecookie" '.$checked_status[1].' value="off" />
		</p>
        <p id="tilladt">Tilladt HTML: &lt;a href="..."&gt;, &lt;b&gt;, &lt;em&gt;, &lt;q&gt;.</p>
        <p><label>Kommentar</label> <span style="color: #c00; font-weight: bold;">*</span><br />
		<textarea cols="25" rows="10" name="c_text" style="font-size: small;"></textarea></p>
        <p style="text-align: center;">
        	<!-- <input type="reset" value="Slet indhold" onclick="if(!confirm(\'Er du sikker på at du vil slette indholdet?\'))return false;" /> -->
        	<input type="submit" name="c_submit" value="Tilføj kommentar" style="width: 200px;" />
        </p>
    </div>
</form>
';
/*
$edit_form = '
<form action="/ee.php" method="post" id="edit">
	<div style="margin: 0 20px 0 0;; padding: 0; border: 0">
		<h1>Ret et indlæg</h1>
		<label>Titel:</label><br />
		<input type="text" name="title" size="25" value="'.$title.'" /><br />
		<label>Dato og tid [tt,mm,ss,dd,mm,yyyy]:</label><br />
		<input type="text" name="entrytime" size="25" value="'.$date.'" /><br />
	    <div id="inputform">
	    <label>Kommentarer</label><input type="checkbox" checked="checked" name="comments" /><br />
	        <label>Status:</label>
	        <select name="status">
			<option value="0">Kladde</option>
			<option selected="selected" value="1">Postet</option>
		</select><br /><br />
	    <input type="submit" name="submit" value="Send" />
		<input type="hidden" name="aid" value="1" />

	    <input type="hidden" name="entryid" value="'.$entryid.'" />
	    </div>
		<p>
		<label>Tekst:</label><br />
		<textarea cols="55" rows="15" name="text" style="width: 75%;">'.stripslashes(unformat_entry($text)).'</textarea><br />
		<label>Extended Text</label><br />
		<textarea cols="65" rows="25" name="text_more" style="width: 75%">'.stripslashes(unformat_entry($text_more)).'</textarea>
		</p>
    </div>
</form>';
*/

if($_SESSION['aid'] == 1)
{
	$edit_menu = '
	<div id="mlist">
		<ul>
			<li>
				<a accesskey="6" href="/ae.php?action=logout">Log ud</a>
			</li>
			<li>
				<a accesskey="5" href="/">Blogforside</a>
			</li>
			<li>
				<a accesskey="4" href="/au.php"">Tilføj Bruger</a>
			</li>
			<li>
				<a accesskey="3" href="/de/">Slet indlæg</a>
			</li>
			<li>
				<a accesskey="2" href="/ee/">Ret indlæg</a>
			</li>
			<li>
				<a accesskey="1" href="/ae/">Nyt indlæg</a>
			</li>
		</ul>
	</div>';
}
else
{
	$edit_menu = '
	<div id="mlist">
		<ul>
			<li>
				<a accesskey="5" href="/ae.php?action=logout">Log ud</a>
			</li>
			<li>
				<a accesskey="4" href="/">Blogforside</a>
			</li>
			<li>
				<a accesskey="3" href="/de/">Slet indlæg</a>
			</li>
			<li>
				<a accesskey="2" href="/ee/">Ret indlæg</a>
			</li>
			<li>
				<a accesskey="1" href="/ae/">Nyt indlæg</a>
			</li>
		</ul>
	</div>';
}
?>
