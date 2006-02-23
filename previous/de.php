<?php
include_once('incs/accesscontrol.php');

print_header(". {$blog_title} | Post et indlæg .", "edit", $domain_name, $description, $key_words);
?>
<div id="wrapper">
<div id="top">
<p style="float: right;">Bruger: <?=$_SESSION['aname'];?></p>
<h1>Administration af <?=$blog_title;?> på http://<?=$domain_name;?>/</h1>
</div>
<?php
print $edit_menu;
print '<div style="padding:10px">';

#print_header(". {$blog_title} | Slet et indlæg .","edit.css", $domain_name, $description, $key_words);
#print '<div id="wrapper">';
#print $edit_menu;
if(isset($_GET['entryid'])) {
	$entryid = $_GET['entryid'];
	$sql = "DELETE from entries where id = {$entryid}";
	if(!$result = @mysql_query($sql)) : 
		print "<p>Error: ".mysql_error()."</p>";
	else :
			print '<p>Posten med ID #'.$entryid.' er slettet fra databasen.</p>';
	endif;
}
$selectfrom = "select * from entries, authors where authors.uid = entries.aid and entries.aid = {$_SESSION['aid']}";
	if(isset($_GET['serve'])) :
		$limit = " limit {$_GET['serve']},20";
	else:
		$limit = " limit 0,20";
	endif;
	$sort = " order by date DESC";
	$sql = $selectfrom.$sort.$limit;
	$sql2 ="select id from entries, authors where authors.uid = entries.aid and entries.aid = {$_SESSION['aid']}";
	$result2 = @mysql_query($sql2);
	$num_rows = @mysql_num_rows($result2);
	if(!$result = @mysql_query($sql)) :
		print "<p>Error: $sql".mysql_error()."</p>";
	else :
#		print $sql.'<br />';
		print '<table class="table"><tr class="header"><td>option</td><td>Titel</td><td>Dato</td><td>Tid</td><td>Status</td><td>Forfatter</td></tr>';
		$row_count = 0;
		$class1 = 'dark';
		$class2 = 'light';
		while (false !== ($row = @mysql_fetch_array($result))) {
			extract($row);
			$time = date('H:i', $date);
			$date = date('d. F Y', $date);
			$row_color = ($row_count % 2) ? $class1 : $class2;
			$status = ($status == 0) ? ($status = 'Kladde') : ($status = 'Postet');
			print "<tr>
					<td class='{$row_color}'><a onclick='if(checkDelete() == true) {return true;} else {return false;}' href=\"http://{$_SERVER['HTTP_HOST']}/de.php?entryid={$id}\">Slet?</a></td>
					<td class='{$row_color}'>{$title}</td>
					<td class='{$row_color}'>{$date}</td>
					<td class='{$row_color}'>{$time}</td>
					<td class='{$row_color}'>{$status}</td>
					<td class='{$row_color}'>{$name}</td>
					</tr>";
			$row_count++;
		}
		print '</table>';
		$roll = $_GET['serve'];
		print '<p style="padding: 0 15px 0 15px;">';
		for($i = 0, $j = 1 ; $i <= $num_rows; $i+=20, $j++) {
			print "<a href=\"http://{$_SERVER['HTTP_HOST']}/de.php?serve=".$i."\">Side ".$j."</a>  |  ";
		}
		print '</p>';
	endif;
print '</div>';
print '</div>';
print_footer();
?>
