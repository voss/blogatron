<?php
@include($_SERVER['DOCUMENT_ROOT'].'/incs/accesscontrol.php');


print_header(". {$blog_title} | blogrulle .", "edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
?>
<div id="container">
<div id="top">
	<p style="float: right;">Bruger: <?=$_SESSION['aname'];?></p>
	<h1>Administration af <?=stripslashes($blog_title);?> på http://<?=$domain_name.$install_path;?>/</h1>
</div>
<div id="leftbar">
<div id="mlist">
<?php
	print_ulist($edit_menu);
?>
</div>
<?php
	display_archive_months_edit();
?>
</div>
<div id="content" style="padding: 15px 5px;">
<?php
if(isset($_GET['delete_link'])) 
{
	$del_link = $_GET['delete_link'];
	$sql = "delete from linkroll where id = {$del_link}";
	if($result_del = mysql_query($sql)) 
	{
		print '<p class="success"><img src="/img/icon_tick.gif" style="vertical-align: middle; width:20px; height:20px" />Linket blev slettet fra rullen</p>';
	#	print "<p>$sql_del</p>";
	}
	else
	{
		print '<p class="explainerror">Houston, we have a problem</p>';
	}
}
if(isset($_POST['submit']))
{
	$title = $_POST['linktitle'];
	$url = $_POST['linkurl'];
	$text = $_POST['linktext'];
	$status = $_POST['status'];
	$linkid = $_POST['linkid'];
	
	if(($_POST['linktitle'] != "") && ($_POST['linktext'] != "") && ($_POST['linkurl'] != "") && ($_POST['linkid'] != ""))
	{
		$sql = "UPDATE linkroll SET
				linktitle = ('{$title}'),
				linkurl = ('{$url}'),
				linktext = ('{$text}'),
				status = ('{$status}')
				WHERE
				id = ('{$linkid}')
				";
		$updatelink = TRUE;
	}
	else
	{
		$sql = "INSERT INTO linkroll SET
				linktitle = ('{$title}'),
				linkurl = ('{$url}'),
				linktext = ('{$text}'),
				status = ('{$status}')
				";
		$insertlink = TRUE;
	}
	$insert_result = @mysql_query($sql);
}

	# Error handling on non-valid form:
	# $success = (isset($_POST['submit']) && $success == false) ? '<p class="redalert">Alle felter skal udfyldes.</p>' : ''; 

if (isset($_GET['editlink']))
{
	$editlink = $_GET['editlink'];
	$sql = 'SELECT * from linkroll where id = '.$editlink.'';
	if($result_del = mysql_query($sql)) 
	{
		while(false !== ($row = @mysql_fetch_array($result_del)))
		{
			extract($row);
			?>
			<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" id="linkForm" name="linkForm" onsubmit="return validPost();">
			<div style="margin: 0 20px 0 0; padding: 0; border: 0">		
			<h1>Tilføj link til blogrulle</h1>
	        <input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />
	        <input type="hidden" name="linkid" value="<?=$id;?>" />
	        <label>URL</label><br />
	        <input tabindex="1" name="linkurl" style="width: 65%;" value="<?=stripslashes($linkurl);?>"><br />
			<label>Anchor</label><br />
			<input tabindex="2" name="linktext" style="width: 65%" value="<?=stripslashes($linktext);?>"><br />
	        <label>Title tag</label><br />
	        <input tabindex="3" type="text" name="linktitle" style="width: 65%;" value="<?=stripslashes($linktitle);?>" /><br />
			<div style="padding-bottom: 25px; padding: 8px;">
	        <label>Status</label>
	        <select tabindex="5" name="status">
				<option value="0">Inaktiv</option>
				<option selected="selected" value="1">Aktiv</option>
			</select>
			<input tabindex="6" type="submit" name="submit" value="Tilføj til linkrulle" />
	        </div>
	    </div>

	</form>
			<?php
		}
	}
	else
	{
		print '<p style="margin: 0; padding: 0; color: #648C50;">Houston, we have a problem</p>';
	}
}
else
{
?>

<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" id="linkForm" name="linkForm" onsubmit="return validPost();">
<div style="margin: 0 20px 0 0; padding: 0; border: 0">		
<h1>Tilføj link til blogrulle</h1>
        <input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />
        <label>URL</label><br />
        <input tabindex="1" name="linkurl" style="width: 65%;" ><br />
		<label>Anchor</label><br />
		<input tabindex="2" name="linktext" style="width: 65%" <br />
        <label>Titel tag</label><br />
        <input tabindex="3" type="text" name="linktitle" style="width: 65%" /><br />
		<div style="padding-bottom: 25px; padding: 8px;">
        <label>Status</label>
        <select tabindex="5" name="status">
			<option value="0">Inaktiv</option>
			<option selected="selected" value="1">Aktiv</option>
		</select>
		<input tabindex="6" type="submit" name="submit" value="Tilføj til linkrulle" />
        </div>
    </div>

</form>
<?php
}
?>
<h1>Eksisterende linkrulle</h1>
	<table class="table" style="border: 1px solid black">
<tr>
	<th>Valg</th>
	<th>linktitle</th>
	<th>linkurl</th>
	<th>linktext</th>
	<th>status</th>
</tr>

<?php

	$sql = 'SELECT * from linkroll';
	if(!$result = mysql_query($sql))
	{
		print "<p>Error: ".mysql_error()."</p>";
	}
	else
	{
		while(false !== ($row = @mysql_fetch_array($result)))
		{
			extract($row);
			$status = ($status == 0) ? ($status = 'Inaktiv') : ($status = 'Aktiv');
print <<<EOD
<tr>
	<td><a href="linkage.php?editlink=$id">Ret</a>/<a href="linkage.php?delete_link=$id">Slet</a></td>
	<td>$linktitle</td>
	<td>$linkurl</td>
	<td>$linktext</td>
	<td>$status</td>
</tr>
EOD;
		}
	}
?>

</table>
</div>
</div>
<?php
	print_footer();
?>