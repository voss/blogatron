<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/incs/accesscontrol.php');

if(isset($_POST['submit']))
{
	if(($_POST['title'] != "") && ($_POST['text'] != ""))
	{
		$title = $_POST['title'];
		$text = $_POST['text'];
		$text_more = $_POST['text_more'];
		$aid = $_POST['aid'];
		$status = $_POST['status'];
		$comments = $_POST['comments'];
		$text = format_entry($text);
		if(!empty($text_more)):
			$text_more = format_entry($text_more);
		endif;
		$titel = format_entry($titel);
		if(($_POST['month']) == 0)
		{
			$date = time() + ($offset * 3600);
		}
		else
		{
			$date = mktime($_POST['hh'], $_POST['mm'], $_POST['ss'], $_POST['month'], $_POST['day'], $_POST['year']);
		}
		$sql = "
				INSERT INTO entries SET
				title = ('{$title}'),
				text = ('{$text}'),
				text_more = ('{$text_more}'),
				aid = ('{$aid}'),
				date = ('{$date}'),
				status = ('{$status}'),
				comments = ('$comments')";
		$insert_result = mysql_query($sql) or print mysql_error();
#		print '<h1 style="padding: 10px;">Indlægget er postet.</h1>';
#		print '<p>'.stripslashes($sql).'</p>';
#		}

} else {
	print '<p style="padding-left: 10px;">Du skal udfylde alle felter.</p>';
}
}

print_header(". {$blog_title} | Post et indlæg .", "edit", $domain_name, $description, $key_words);
print '<div id="wrapper">';
print '<div id="top">';
print '<p style="float: right;">Bruger: '.$_SESSION['aname'].'</p><h1>Administration af '.$blog_title.' på http://'.$domain_name.'/</h1>';
print "</div>";
# include($inc_path.'includes.inc.php');
print "<div id=\"add\">";
print $edit_menu;
?>
<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" id="edit">
<div style="margin: 0 20px 0 0; padding: 0; border: 0">
		<h1>Post et indlæg</h1>
        <input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />
        <label>Titel</label><br />
        <input tabindex="1" type="text" name="title" size="25" /><br />
		<div id="inputform">
		<label>Kommentarer</label>
		<input tabindex="4" type="checkbox" checked="checked" name="comments" /><br />
        <label>Status</label>
        <select tabindex="5" name="status">
			<option value="0">Kladde</option>
			<option selected="selected" value="1">Postet</option>
		</select>
        <input tabindex="6" type="submit" name="submit" value="Publicér" id="submitpost" />
        <?php
        if(isset($insert_result) && isset($_POST['submit']))
        {
			print '<p style="padding: 10px; color: green;">Indlægget er postet.</p>';
			@include($inc_path.'rss.inc.php');
			@include($inc_path.'xml-rpc.inc.php');
		}
/*        elseif($insert_result == false)
        {
        	print "<p>Der skete en fejl med databasen. MySQL siger: ".mysql_error()."";
        } */
#		@include($inc_path.'rss.inc.php');
#		@include($inc_path.'xml-rpc.inc.php');
        ?>
        </div>
        <label>Tekst</label><br />
        <textarea tabindex="2" cols="55" rows="18" name="text"></textarea><br />
		<label>Udvidet Tekst</label><br />
		<textarea tabindex="3" cols="55" rows="18" name="text_more"></textarea>
    </div>
    		<label>Dato og tid [tomme felter indsætter aktuel tid]</label><br />
		<label>Dag</label><input type="text" name="day" size="2" />
		<select name="month">
		<?php 
		for($i=1;$i<=12;$i++)
		{
			print "<option value=\"{$i}\">".dateify(date('F',mktime(0,0,0,$i)))."</option>\n";
		}		
		?>
		<option value="0" selected="selected">-- Måned --</option>
		</select>
		<label>År</label>
		<input type="text" name="year" size="4" />
		<label>@</label>
		<input type="text" name="hh" size="2" />:
		<input type="text" name="mm" size="2" />:
		<input type="text" name="ss" size="2" />
</form>
</div>
</div>
<?php
	print_footer();
?>