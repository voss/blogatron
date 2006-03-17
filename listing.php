<?php

@include('incs/accesscontrol.php');

print_header(". {$blog_title} | Ret et indlæg .", "edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);

# Whats in the URL:
if ( isset($_GET['arcmonth']) )
{
	$month_query[] = explode('.',$_GET['arcmonth']);
	print $month_query[0];
}

# Is it an admin-user logging in? If yes, set $admin to true.
$admin = ($_SESSION['aid'] != 1) ? FALSE : TRUE;

# print $admin;

display_archive_months_edit();

#SELECT DISTINCT(FROM_UNIXTIME(date, '%M')) as date_month FROM ".$db_name.".entries where FROM_UNIXTIME(date, '%Y') = '{$year}' ORDER BY date DESC

if ( $admin == TRUE )
{
	$sql = "select * from entries, authors where authors.uid = entries.aid ORDER BY date DESC limit 0,20";
}
else
{
	$sql = "select * from entries, authors where authors.uid = entries.aid and entries.aid = {$_SESSION['aid']} ORDER BY date DESC limit 0,20";
}

# If the user is non-admin, select only the entries they have authored.

# $result = @mysql_query($sql);
if(!$result = @mysql_query($sql)) 
{
	# Debugging:
	print "<p>Error: $sql".mysql_error()."</p>";
}
else
{

	print '<div style="padding:10px">';
	print '<table class="table">';
	print '<tr class="header"><th>Titel</th><th>Dato</th><th>Tid</th><th>Status</th><th>Forfatter</th></tr>';
	$row_count = 0;
	$class1 = 'dark';
	$class2 = 'light';
	while (false !== ($row = @mysql_fetch_array($result))) {
		extract($row);
		$time = date('H:i', $date);
		$date = date('d. F - Y', $date);
		$status = ($status == 0) ? ($status = 'Kladde') : ($status = 'Postet');
		$row_color = ($row_count % 2) ? $class1 : $class2;
		print "<tr class=\"{$row_color}\"><td><a href=\"".$install_path."/ee.php?entryid={$id}\">{$title}</a></td>
		<td>{$date}</td>
		<td>{$time}</td>
		<td>{$status}</td>
		<td>{$name}</td></tr>\n";
		$row_count++;
	}
	print '</table>';
	print '</div>';
/*	$roll = $_GET['serve'];
	print '<p style="padding: 0 15px 0 15px;">';
	for($i = 0, $j = 1 ; $i <= $num_rows; $i+=20, $j++) {
		print "<a href=\"".$install_path."/ee.php?serve=".$i."\">Side ".$j."</a> | ";
	}
*/
}
?>
</p>
</div>
<?php
	print_footer();
?>
