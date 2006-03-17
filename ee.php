<?php
@include('incs/accesscontrol.php');

print_header(". {$blog_title} | Ret et indl�g .", "edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);

?>
<div id="wrapper">
<div id="top">
<p style="float: right;">Bruger: <?=$_SESSION['aname'];?></p>
<h1 style="color: white;">Administration af <?=stripslashes($blog_title);?> p� http://<?=$domain_name.$install_path;?>/</h1>
</div>
<?=$edit_menu;?>
<?php

# delete comment-bit.
if(isset($_GET['delete_comment'])) 
{
	$del_e = $_GET['delete_comment'];
	$sql_del = "delete from comments where c_id = {$del_e}";
	if($result_del = mysql_query($sql_del)) 
	{
		print '<p style="margin: 0; padding: 0; color: #648C50; font-weight: bold;">Kommentaren blev slettet fra databasen</p>';
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
<form action="<?=$install_path;?>/ee.php" method="post" id="edit">
	<div style="margin: 0 20px 0 0;; padding: 0; border: 0">
		<h1>Ret et indl�g</h1>
		<label>Titel:</label><br />
		<input tabindex="1" type="text" name="title" size="25" value="<?=$title?>" /><br />
		<label>Dato og tid:</label><br />
		<label>Dag:</label>
		<input type="text" name="day" size="2" value="<?=$_POST['day']?>" />
		<select name="month">
		<option>-- M�ned --</option>
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
		<label>�r:</label>
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
		</select><br /><br />
		<input tabindex="6" type="submit" name="submit" value="Public�r" id="submitpost" />

       <?php
        if(isset($update_result))
        {
			print '<p style="padding: 10px; color: green;">Indl�gget er rettet.</p>';
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
<form action="<?=$install_path;?>/ee.php" method="post" id="edit">
	<div style="margin: 0 20px 0 0; padding: 0; border: 0">
		<h1>Ret et indl�g</h1>
		<label>Titel:</label><br />
		<input tabindex="1" type="text" name="title" size="25" value="<?=$title?>" /><br />
		<label>Dato og tid:</label><br />
		<label>Dag:</label>
		<input type="text" name="day" size="2" value="<?=$day?>" />
		<select name="month">
		<option>-- M�ned --</option>
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
		<label>�r:</label>
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
		</select><br /><br />
	    <input tabindex="6" type="submit" name="submit" value="Public�r" id="submitpost" />
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
				# print $sql2;
	
				if(!$result2 = @mysql_query($sql2)) 
				{
					print "<p>Error: ".mysql_error()."</p>";
				}
				else
				{
					print '<div style="padding:30px">';
					print '<table class="table">';
					print '<tr><th>Kommentar (slet ved at klik p� titel)</th><th>Forfatter</th><th>Tid</th></tr>';
					$row_count = 0;
					$class1 = 'dark';
					$class2 = 'light';
					while(false !== ($row2 = @mysql_fetch_array($result2)))
					{
						extract($row2);
						$row_color = ($row_count % 2) ? $class1 : $class2;
						print '<tr class="'.$row_color.'">';
						print '<td><a href='.$install_path.'/ee.php?delete_comment='.$c_id.' onclick=\'if(checkDeleteC() == true) {return true;} else {return false;}\'>'.$c_text.'</a></td>';
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
	else
	{
	   # If the user is non-admin, select only the entries they have authored.
		if($_SESSION['aid'] != 1)
		{
			$selectfrom = "select * from entries, authors where authors.uid = entries.aid and entries.aid = {$_SESSION['aid']}";
		}
		else
		{
			$selectfrom = "select * from entries, authors where authors.uid = entries.aid";
		}
		if(isset($_GET['serve'])) 
		{
			$limit = " limit {$_GET['serve']},20";
		}
		else
		{
			$limit = " limit 0,20";
		}
		
		$sort = " order by date DESC";
		$sql = $selectfrom.$sort.$limit;
		
		if($_SESSION['aid'] != 1)
		{
			$sql2 ="select id from entries, authors where authors.uid = entries.aid and entries.aid = {$_SESSION['aid']}";
		}
		else
		{
			$sql2 ="select id from entries";
		}
		$result2 = @mysql_query($sql2);
		$num_rows = @mysql_num_rows($result2);
		if(!$result3 = @mysql_query($sql)) 
		{
			# Debugging:
			# print "<p>Error: $sql".mysql_error()."</p>";
		}
		else
		{

			print '<div style="padding:10px">';
			print '<table class="table">';
			print '<tr class="header"><th>Option</th><th>Titel</th><th>Dato</th><th>Tid</th><th>Status</th><th>Forfatter</th></tr>';
			$row_count = 0;
			$class1 = 'dark';
			$class2 = 'light';
			while (false !== ($row = @mysql_fetch_array($result3))) {
				extract($row);
				$time = date('H:i', $date);
				$date = date('d. F - Y', $date);
				$status = ($status == 0) ? ($status = 'Kladde') : ($status = 'Postet');
				$row_color = ($row_count % 2) ? $class1 : $class2;
				print "<tr class=\"{$row_color}\">
				<td><a onclick='if(checkDelete() == true) {return true;} else {return false;}' href='ee.php?delete_comment={$id}'>Slet</a></td> <td><a href=\"".$install_path."/ee.php?entryid={$id}\">{$title}</a></td>
				<td>{$date}</td>
				<td>{$time}</td>
				<td>{$status}</td>
				<td>{$name}</td></tr>\n";
				$row_count++;
			}
			print '</table>';
			print '</div>';
		}
	}
?>
</p>
</div>
<?php
	print_footer();
?>
