<?php
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
header("Content-type: application/xml");

# Here we create the query containing the RSS-version of the last 15 posts to the site.
$sql_xml = "SELECT (date - ({$offset} * 3600)) as xml_date, title, slug, text, text_more, name, email from {$db_name}.entries, {$db_name}.authors where status = '1' AND entries.aid = authors.uid ORDER BY xml_date DESC LIMIT 0,15";

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
	<title>. {$blog_title} .</title>
	<description>{$description}</description>
	<link>http://{$domain_name}</link>
	<lastBuildDate>{$last_build_date}</lastBuildDate>
	<icbm:latitude>55.6773</icbm:latitude>
	<icbm:longitude>12.5749</icbm:longitude>
";
	while($row = @mysql_fetch_array($result_xml))
	{
		extract($row);
		$text = format_entry($text).format_entry($text_more);
		$text = htmlspecialchars($text);
		$pub_date = date("r", $xml_date);
		$date = date("dmy", $xml_date);
		$xml_string .= "<item>\n\t";
		$xml_string .= "<title>{$title}</title>\n\t";
		$xml_string .= "<description>{$text}</description>\n\t";
		$xml_string .= "<link>http://{$domain_name}/".$date."/".$slug."</link>\n\t";
		$xml_string .= "<pubDate>{$pub_date}</pubDate>\n\t";
		$xml_string .= "<guid>http://{$domain_name}/".$date."/".$slug."</guid>\n\t";
		$xml_string .= "<author>{$email} ({$name})</author>\n\t";
		$xml_string .= "<comments>http://{$domain_name}/".$date."/".$slug."#c</comments>\n\t";
		$xml_string .= "</item>\n";
	}
	$xml_string .= "</channel>\n</rss>";
}
print $xml_string;
?>
