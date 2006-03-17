<?php
@include('incs/accesscontrol.php');

print_header(". {$blog_title} | Slet et indlæg .", "edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
?>

<div id="wrapper">
<div id="top">
<p style="float: right;">Bruger: <?=$_SESSION['aname'];?></p><h1 style="color: white;">Administration af <?=stripslashes($blog_title);?> på http://<?=$domain_name.$install_path;?>/</h1>
</div>
<?php
print $edit_menu;
print '<div style="padding:10px">';

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
	if(!$result = @mysql_query($sql)) {
		print "<p>Error: $sql".mysql_error()."</p>";
	} else {
		print '<table class="table"><tr class="header"><th>Titel</th><th>Dato</th><th>Tid</th><th>Status</th><th>Forfatter</th></tr>';
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
					<td class='{$row_color}'><a onclick='if(checkDelete() == true) {return true;} else {return false;}' href=\"".$install_path."/de.php?entryid={$id}\">{$title}</a></td>
					<td class='{$row_color}'>{$date}</td>
					<td class='{$row_color}'>{$time}</td>
					<td class='{$row_color}'>{$status}</td>
					<td class='{$row_color}'>{$name}</td>
					</tr>";
			$row_count++;
		}
		print '</table>';
		print '</div>';
	}
?>
</div>
<?php
	print_footer();
?>
