<?php
include_once('incs/accesscontrol.php');
# if(!isset($_GET['serve']))
print_header(". {$blog_title} | Ret et indlæg .", "edit", $domain_name, $description, $key_words);
print '<div id="wrapper">';
print '<div id="top">';
print '<p style="float: right;">Bruger: '.$_SESSION['aname'].'</p><h1>Administration af '.$blog_title.' på http://'.$domain_name.'/</h1>';
print "</div>";
print "<div id=\"add\">";
print $edit_menu;

# delete comment-bit.
if(isset($_GET['delete_comment'])) 
{
	$del_e = $_GET['delete_comment'];
	$sql_del = "delete from comments where c_id = {$del_e}";
	if($result_del = mysql_query($sql_del)) 
	{
		print "<p style=\"margin: 0; padding: 0; color: #648C50; font-weight: bold;\">Kommentaren blev slettet fra databasen</p>";
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
	$text = format_entry($_POST['text']);
	
	if(!empty($text_more))
	{
		$text_more = format_entry($text_more);
	}
	
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
/*	print $sql_update.'<br />';
	print $entryid;
	if(!$update_result) {
		print mysql_error();
	}
*/
?>
<form action="/ee.php" method="post" id="edit">
	<div style="margin: 0 20px 0 0; padding: 0; border: 0">
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
		<?php if($_POST['comments'] == 'on'): ?>
	    <input tabindex="4" type="checkbox" checked="checked" name="comments" /><br />
	    <?php else: ?>
	    <input tabindex="4" type="checkbox" name="comments" /><br />
	    <?php endif; ?>
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
		<input tabindex="6" type="submit" name="submit" value="Publicér" id="submitpost" />
        <?php
        if(isset($update_result))
        {
			print '<p style="padding: 10px; color: green;">Indlægget er rettet.</p>';
			if(!$_POST['status'] == 0) {
				@include($inc_path.'rss.inc.php');
				@include($inc_path.'xml-rpc.inc.php');
			}
        }
        elseif($update_result == false)
        {
        	print "<p>Der skete en fejl med databasen. MySQL siger: ".mysql_error()."";
        }
#		@include($inc_path.'rss.inc.php');
#		@include($inc_path.'xml-rpc.inc.php');
        ?>
		<input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />

	    <input type="hidden" name="entryid" value="<?=$_POST['entryid'];?>" />
	    </div>
		<p>
		<label>Tekst:</label><br />
		<textarea tabindex="2" cols="55" rows="18" name="text"><?=stripslashes(unformat_entry($_POST['text']))?></textarea><br />
		<label>Udvidet tekst:</label><br />
		<textarea tabindex="3" cols="55" rows="18" name="text_more"><?=stripslashes(unformat_entry($_POST['text_more']))?></textarea>
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
			$text = unformat_entry($text);
			$written_date = date('H,i,s,d,n,Y', $date);
			list($hh, $mm, $ss, $day, $month, $year) = explode(",", $written_date);
	#		print $edit_menu;
		?>
<form action="/ee.php" method="post" id="edit">
	<div style="margin: 0 20px 0 0; padding: 0; border: 0">
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
		<?php if($comments == 'on'): ?>
	    <input tabindex="4" type="checkbox" checked="checked" name="comments" /><br />
	    <?php else: ?>
	    <input tabindex="4" type="checkbox" name="comments" /><br />
	    <?php endif; ?>
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
	    <input tabindex="6" type="submit" name="submit" value="Publicér" id="submitpost" />
		<input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />

	    <input type="hidden" name="entryid" value="<?=$entryid?>" />
	    </div>
		<p>
		<label>Tekst:</label><br />
		<textarea tabindex="2" cols="55" rows="18" name="text"><?=stripslashes(unformat_entry($text))?></textarea><br />
		<label>Udvidet tekst:</label><br />
		<textarea tabindex="3" cols="55" rows="18" name="text_more"><?=stripslashes(unformat_entry($text_more))?></textarea>
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
					while($row2 = @mysql_fetch_array($result2))
					{
						extract($row2);
						print '<div style="border:1px solid #666; padding:10px">';
						print '<p><a href="/ee.php?delete_comment='.$c_id.'" onclick=\'if(checkDeleteC() == true) {return true;} else {return false;}\'>Slet kommentar</a></p>';
						print '<p>'.$c_text.'</p>';
						print '<p>'.$c_author.' '.$c_email.'</p>';
						$c_date = date("G:i || d.m || Y", $date);
						print '<p>'.$c_date.'</p>';
						print '</div>';
					}				
				}
			}
		}
	}
	else
	{
#			@include($inc_path.'rss.inc.php');
#			@include($inc_path.'xml-rpc.inc.php');
			print '</div>';
#	} else {
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
			$server ='';
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
			print "<p>Error: $sql".mysql_error()."</p>";
		}
		else
		{
			print '<div style="padding:10px">';
			print '<table class="table">';
			print '<tr class="header"><td>Titel</td><td>Tid</td><td>Dato</td><td>Status</td><td>Forfatter</td></tr>';
			$row_count = 0;
			$class1 = 'dark';
			$class2 = 'light';
			while (false !== ($row = @mysql_fetch_array($result3))) {
				extract($row);
				$time = date('H:i', $date);
				$date = date('d. F - Y', $date);
				$status = ($status == 0) ? ($status = 'Kladde') : ($status = 'Postet');
				$row_color = ($row_count % 2) ? $class1 : $class2;
				print "<tr><td class=\"{$row_color}\"><a href=\"/ee.php?entryid={$id}\">{$title}</a></td>
				<td style=\"text-align:center;\" class=\"{$row_color}\">{$time}</td>
				<td style=\"text-align:center;\" class=\"{$row_color}\">{$date}</td>
				<td style=\"text-align:center;\" class=\"{$row_color}\">{$status}</td>
				<td style=\"text-align:center;\" class=\"{$row_color}\">{$name}</td></tr>\n";
				$row_count++;
			}
			print '</table>';
			print '</div>';
			@$roll = $_GET['serve'];
			print '<p style="padding: 0 15px 0 15px;">';
			for($i = 0, $j = 1 ; $i <= $num_rows; $i+=20, $j++) {
				print "<a href=\"/ee.php?serve=".$i."\">Side ".$j."</a> | ";
			}
		}	
	}
print '</p>';
print '</div>';
print_footer();
?>
