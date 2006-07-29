<?php

@include($_SERVER['DOCUMENT_ROOT'].'/incs/accesscontrol.php');


# Is it an admin-user logging in? If yes, set $admin to true.
$admin = ($_SESSION['aid'] != 1) ? FALSE : TRUE;

# Whats in the URL:
if ( isset($_GET['arcmonth']) )
{
	list($req_month,$req_year) = explode('.',$_GET['arcmonth']);
	if ( $admin == TRUE )
	{
		$req_sql = "SELECT
			*
		FROM
			entries, authors
		WHERE
			FROM_UNIXTIME(entries.date, '%M') = '{$req_month}'
		AND
			FROM_UNIXTIME(entries.date, '%Y') = '{$req_year}'
		AND
			authors.uid = entries.aid
		ORDER BY
			entries.date
		DESC";
	}
	else
	{
		# If the user is non-admin, select only the entries they have authored.
		$req_sql = "SELECT
			*
		FROM
			entries, authors
		WHERE
			FROM_UNIXTIME(entries.date, '%M') = '{$req_month}'
		AND
			FROM_UNIXTIME(entries.date, '%Y') = '{$req_year}'
		AND
			authors.uid = entries.aid
		AND
			entries.aid = {$_SESSION['aid']}
		ORDER BY
			entries.date
		DESC";
	}
}
else
{
		$req_sql = "SELECT
			*
		FROM
			entries, authors
		WHERE
		authors.uid = entries.aid
		AND
			entries.aid = {$_SESSION['aid']}
		ORDER BY
			entries.date
		DESC
		LIMIT 0,15";
}

# print $admin;
print_header(". {$blog_title} | Ret et indlæg .", "edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
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
<div style="padding-left: 5px;">
<?php
	display_archive_months_edit();
?>
</div>


</div>
<div id="content">
<?php

# delete entry-bit
if(isset($_GET['delete_entry'])) {
	$entryid = $_GET['delete_entry'];
	$sql = "DELETE from entries where id = {$entryid}";
	if(!$result = @mysql_query($sql)) : 
		print "<p>Error: ".mysql_error()."</p>";
	else :
			print '<p class="success"><img src="'.$install_path.'/sheriff/img/icon_tick.gif" style="vertical-align: middle; width:20px; height:20px" />Posten med ID #'.$entryid.' er slettet fra databasen.</p>';
	endif;
}


# delete comment-bit.
if(isset($_GET['delete_comment'])) 
{
	$del_e = $_GET['delete_comment'];
	$sql_del = "delete from comments where c_id = {$del_e}";
	if($result_del = mysql_query($sql_del)) 
	{
		print '<p class="success"><img src="'.$install_path.'/sheriff/img/icon_tick.gif" style="vertical-align: middle; width:20px; height:20px" />Kommentaren blev slettet fra databasen</p>';
	#	print "<p>$sql_del</p>";
	}
	else
	{
		print '<p style="margin: 0; padding: 0; color: #648C50;">Houston, we have a problem</p>';
	}
}


if(isset($_POST['submit']) && isset($_POST['entryid']))
{
	$aid = $_POST['aid'];
	$entryid = $_POST['entryid'];
	$title = $_POST['title'];
	$text_more = $_POST['text_more'];
	$text = $_POST['text'];
	if(($_POST['month']) == 0)
	{
		$date = time() + ($offset * 3600);
	}
	else
	{
		$date = mktime($_POST['hh'], $_POST['mm'], $_POST['ss'], $_POST['month'], $_POST['day'], $_POST['year']);
	}
	
	$status = $_POST['status'];
	$comments = $_POST['comments'];
	$sql_update = "UPDATE entries SET
		title = ('{$title}'),
		text = ('{$text}'),
		text_more = ('{$text_more}'),
		date = ('{$date}'),
		aid = ('{$aid}'),
		status = ('{$status}'),
		comments = ('{$comments}')
		WHERE
		id = ('{$entryid}')";
	$update_result = @mysql_query($sql_update);

?>

<form action="<?=$install_path;?>/sheriff/ee.php" method="post" id="edit">
	<div style="padding: 20px; border: 0">
		<h1>Ret et indlæg</h1>
		<label>Titel:</label><br />
		<input tabindex="1" type="text" name="title" size="25" value="<?=$title?>" /><br />
		<label>Dato og tid:</label><br />
		<label>Dag:</label>
		<input type="text" name="day" size="2" value="<?=$_POST['day']?>" />
		<select name="month">
		<option>-- Måned --</option>
		<?php 
		for($i=1;$i<=12;$i++) {
			if($i == date('n',$date)) {
				print "<option value=\"{$i}\" selected=\"selected\">".dateify(date('F',mktime(0,0,0,$i)))."</option>\n";
			} else {
				print "<option value=\"{$i}\">".dateify(date('F',mktime(0,0,0,$i)))."</option>\n";
			}
		}
		?>
		</select>
		<label>År:</label>
		<input type="text" name="year" size="4" value="<?=$_POST['year']?>" />
		<label>@</label>
		<input type="text" name="hh" size="2" value="<?=$_POST['hh']?>" />:
		<input type="text" name="mm" size="2" value="<?=$_POST['mm']?>" />:
		<input type="text" name="ss" size="2" value="<?=$_POST['ss']?>" />
	    <div id="inputform">		
	    <label>Kommentarer</label>
		<?php $checked = ($_POST['comments'] == 'on') ? 'checked="checked"' : ''; ?>
		<input tabindex="4" type="checkbox" <?=$checked;?> name="comments" /><br />
	    <label>Status:</label>
	    <select tabindex="5" name="status">
		<?php if($_POST['status'] == 0):?>
			<option selected="selected" value="0">Kladde</option>
			<option value="1">Postet</option>
		<?php else: ?>
			<option value="0">Kladde</option>
			<option selected="selected" value="1">Postet</option>
		<?php endif; ?>
		</select>
		<input tabindex="6" type="submit" name="submit" value="Publicér" id="submitpost" />

       <?php
        if(isset($update_result))
        {
			print '<p style="padding: 10px; color: green;">Indlægget er rettet.</p>';
        }
        elseif($update_result == false)
        {
        	print "<p>Der skete en fejl med databasen. MySQL siger: ".mysql_error()."";
        }
		if($rss_enabled == 1 && $_POST['status'] != 0)
		{
			@include($inc_path.'rss.inc.php');
		}
		if($hasBlogbot == 1 && $_POST['status'] != 0)
		{
			@include($inc_path.'xml-rpc.inc.php');
		}
		?>

		<input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />
	    <input type="hidden" name="entryid" value="<?=$_POST['entryid'];?>" />
	    </div>
		<p>
		<label>Tekst:</label><br />
		<textarea tabindex="2" cols="55" rows="10" name="text" style="width: 65%;"><?=stripslashes($_POST['text']);?></textarea><br />
		<label>Udvidet tekst:</label><br />
		<textarea tabindex="3" cols="55" rows="15" name="text_more" style="width: 65%"><?=stripslashes($_POST['text_more']);?></textarea>
		</p>
    </div>
</form>

<?php
}elseif(isset($_GET['entryid']))
{
	$entryid = $_GET['entryid'];
	$sql = "SELECT * from entries where id = {$entryid}";
	if(!$result = @mysql_query($sql)) 
	{ 
		print "<p>Error: ".mysql_error()."</p>";
	}
	else
	{
		while($row = @mysql_fetch_array($result)) 
		{
			extract($row);
#			$text = unformat_entry($text);
			$written_date = date('H,i,s,d,n,Y', $date);
			list($hh, $mm, $ss, $day, $month, $year) = explode(",", $written_date);
	#		print $edit_menu;
		?>
<form action="<?=$install_path;?>/sheriff/ee.php" method="post" id="edit">
	<div style="padding: 20px; border: 0">
		<h1>Ret et indlæg</h1>
		<label>Titel:</label><br />
		<input tabindex="1" type="text" name="title" size="25" value="<?=$title?>" /><br />
		<label>Dato og tid:</label><br />
		<label>Dag:</label>
		<input type="text" name="day" size="2" value="<?=$day?>" />
		<select name="month">
		<option>-- Måned --</option>
		<?php 
		for($i=1;$i<=12;$i++) {
			if($i == date('n',$date)) {
				print "<option value=\"{$i}\" selected=\"selected\">".dateify(date('F',mktime(0,0,0,$i)))."</option>\n";
			} else {
				print "<option value=\"{$i}\">".dateify(date('F',mktime(0,0,0,$i)))."</option>\n";
			}
		}
		?>
		</select>
		<label>År:</label>
		<input type="text" name="year" size="4" value="<?=$year?>" />
		<label>@</label>
		<input type="text" name="hh" size="2" value="<?=$hh?>" />:
		<input type="text" name="mm" size="2" value="<?=$mm?>" />:
		<input type="text" name="ss" size="2" value="<?=$ss?>" />
	    <div id="inputform">
	    <label>Kommentarer</label>
    	<?php $checked = ($comments == 'on') ? 'checked="checked"' : ''; ?>
    	<input tabindex="4" type="checkbox" <?=$checked;?> name="comments" /><br />
	    <label>Status:</label>
	    <select tabindex="5" name="status">
	    <?php if($status == 0):?>
			<option selected="selected" value="0">Kladde</option>
			<option value="1">Postet</option>
		<?php else: ?>
			<option value="0">Kladde</option>
			<option selected="selected" value="1">Postet</option>
		<?php endif; ?>
		</select>
	    <input tabindex="6" type="submit" name="submit" value="Publicér" id="submitpost" />
		<input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />
	    <input type="hidden" name="entryid" value="<?=$entryid?>" />
		</div>
		<p>
		<label>Tekst:</label><br />
		<textarea tabindex="2" cols="55" rows="10" name="text" style="width: 65%;"><?=stripslashes($text);?></textarea><br />
		<label>Udvidet tekst:</label><br />
		<textarea tabindex="3" cols="55" rows="15" name="text_more" style="width: 65%"><?=stripslashes($text_more);?></textarea>
		</p>
	</div>
</form>
<?php
				$sql2 = "select * from comments where eid = {$entryid}";

				if(!$result2 = @mysql_query($sql2)) 
				{
					print "<p>Error: ".mysql_error()."</p>";
				}
				else
				{
					if(@mysql_num_rows($result2) > 0)
					{
						print '<div style="padding:30px;">';
						print '<table class="table">';
						print '<tr><th>Kommentar (slet ved at klik på titel)</th><th>Forfatter</th><th>Tid</th></tr>';
						$row_count = 0;
						$class1 = 'dark';
						$class2 = 'light';
						while(false !== ($row2 = @mysql_fetch_array($result2)))
						{
							extract($row2);
							$row_color = ($row_count % 2) ? $class1 : $class2;
							print '<tr class="'.$row_color.'">';
							print '<td class="editcomments"><a href='.$install_path.'/sheriff/ee.php?delete_comment='.$c_id.' onclick=\'if(checkDeleteC() == true) {return true;} else {return false;}\'>'.$c_text.'</a></td>';
							$c_date = date("G:i || d.m || Y", $date);
							print '<td>'.$c_author.' ('.$c_email.')</td>';
							print '<td>'.$c_date.'</td>';
							print '</tr>';
						}
						print '</table></div>';
					}
				}
			}
		}
	}
	else
	{
# $result = @mysql_query($sql);
if(!$result = @mysql_query($req_sql)) 
{
	# Debugging:
	print '<p>Error: $req_sql '.mysql_error().' - eller noget</p>';
}
else
{
	print '<div style="padding:10px">';
	print '<table class="table">';
	print '<tr class="header">
			<th>Titel</th>
			<th>Dato</th>
			<th>Tid</th>
			<th>Status</th>
			<th>Forfatter</th>
			</tr>';
	$row_count = 0;
	$class1 = 'dark';
	$class2 = 'light';
	while (false !== ($row = @mysql_fetch_array($result)))
	{
		extract($row);
		$time = date('H:i', $date);
		$date = date('d. F - Y', $date);
		$status = ($status == 0) ? ($status = 'Kladde') : ($status = 'Postet');
		$row_color = ($row_count % 2) ? $class1 : $class2;
		print '<tr class="'.$row_color.'"><td><a href="'.$install_path.'/sheriff/ee.php?delete_entry='.$id.'"><img src="/sheriff/img/trash.gif" alt="trash" style="float: left; padding: 7px 0;margin-left: 15px" /></a> <a href="'.$install_path.'/sheriff/ee.php?entryid='.$id.'">'.$title.'</a></td>
		<td>'.$date.'</td>
		<td>'.$time.'</td>
		<td>'.$status.'</td>
		<td>'.$name.'</td></tr>';
		$row_count++;
	}
	print '</table>';
	print '</div>';
}

	}
?>
</div>
</body>
</html>