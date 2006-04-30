<?php
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
header("Content-type: application/xml");

# Here we create the query containing the RSS-version of the last 15 posts to the site.
$sql_xml = "SELECT (comments.date - ({$offset} * 3600)) as xml_date, (entries.date - ({$offset} * 3600)) as entrydate, c_id, c_author, c_text, title, status from {$db_name}.entries, {$db_name}.comments WHERE comments.eid = entries.id and entries.status = '1' ORDER BY c_id DESC LIMIT 15";

# db-debugging
if(!$result_xml = @mysql_query($sql_xml))
{
	print "<p>Error executing XML-query.".mysql_error()."</p>";
} 
else 
{
	# Set date for last build.
	putenv("TZ=CET");
	$last_build_date = date("r", (time()) );

	# Initiate the content-string that will be added to 
	$xml_string = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<rss version=\"2.0\" xmlns:icbm=\"http://postneo.com/icbm\">
<channel>
	<title>. kommentarer på verture [prik] net .</title>
	<description>Kommentarer på verture prik net</description>
	<link>http://{$domain_name}</link>
	<lastBuildDate>{$last_build_date}</lastBuildDate>
	<icbm:latitude>55.6773</icbm:latitude>
	<icbm:longitude>12.5749</icbm:longitude>
";
	while($row = @mysql_fetch_array($result_xml))
	{
		extract($row);
		$text = format_entry($c_text);
		$text = htmlspecialchars($c_text);
		$pub_date = date("r", $xml_date);
		$date = date("dmy", $xml_date);
		$entry_date = date("dmy", $entrydate);
		$xml_string .= "<item>\n\t";
		$xml_string .= "<title>Kommentar fra {$c_author} til '{$title}'</title>\n\t";
		$xml_string .= "<description>{$text}</description>\n\t";
		$xml_string .= "<link>http://{$domain_name}/".$entry_date."/".dirify($title)."#c</link>\n\t";
		$xml_string .= "<pubDate>{$pub_date}</pubDate>\n\t";
		$xml_string .= "<guid>http://{$domain_name}/".$entry_date."/".dirify($title)."</guid>\n\t";
		$xml_string .= "<author>{$email} ({$c_author})</author>\n\t";
		$xml_string .= "</item>\n";
	}
	$xml_string .= "</channel>\n</rss>";
}
print $xml_string;
?>
