<?php

@include('incs/accesscontrol.php');

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
			entries.status = '1'
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
			entries.status = '1'
		AND
			authors.uid = entries.aid
		AND
			entries.aid = {$_SESSION['aid']}
		ORDER BY
			entries.date
		DESC";
	}

}

# print $admin;
print_header(". {$blog_title} | Ret et indlæg .", "edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
?>
<div id="container">
<div id="top">
	<h1>admin for blog.verture.net</h1>
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
<p>Dette er mig</p>

</div>
<div id="content">
<?php
# $result = @mysql_query($sql);
if(!$result = @mysql_query($req_sql)) 
{
	# Debugging:
	print "<p>Error: $req_sql ".mysql_error()." - eller noget</p>";
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
}
?>
</div>
</div>
</body>
</html>