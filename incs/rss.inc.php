<?php

## Here we create the feed.xml-file containing the RSS-version of the last 15 posts to the site.
$sql_xml = "SELECT (date - 32400) as xml_date, title, text, name, email from {$db_name}.entries, {$db_name}.authors where status = '1' AND aid = uid ORDER BY xml_date DESC LIMIT 0,15";

# db-debugging
if(!$result_xml = @mysql_query($sql_xml)) {
	print "<p>Error executing XML-query.".mysql_error()."</p>";
} else {
	# Set date for last build.
	putenv("TZ=CET");
	$last_build_date = date("r", (time()) );

	# Initiate the content-string that will be added to 
	$xml_string = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<rss version=\"2.0\">
<channel>
	<title>. verture.net | her skriver jeg .</title>
	<description>Jonas Voss' weblog, Københavner og studerende, som så mange andre.</description>
	<link>http://blog.verture.net/</link>
	<lastBuildDate>{$last_build_date}</lastBuildDate>
";
	while($row = @mysql_fetch_array($result_xml)) {
		extract($row);
		$text = htmlspecialchars($text);
		$pub_date = date("r", $xml_date);
		$date = date("dmy", $xml_date);
		$xml_string .= "<item>\n\t";
		$xml_string .= "<title>{$title}</title>\n\t";
		$xml_string .= "<description>{$text}</description>\n\t";
		$xml_string .= "<link>http://blog.verture.net/".$date."/".dirify($title)."</link>\n\t";
		$xml_string .= "<pubDate>{$pub_date}</pubDate>\n\t";
		$xml_string .= "<guid>http://blog.verture.net/".$date."/".dirify($title)."</guid>\n\t";
		$xml_string .= "<author>".$name."</author>\n\t";
		$xml_string .= "<comments>http://blog.verture.net/".$date."/".dirify($title)."#c</comments>\n\t";
		$xml_string .= "</item>\n";
	}
	$xml_string .= "</channel>\n</rss>";
	$xml_file = 'rssfeed.xml';
	if(!$fp = fopen($xml_file, "w+")) {
		print "<p>Kunne ikke åbne {$xml_file}</p>";
	} else {
		if(!fwrite($fp, $xml_string)) {
			print "<p>Kunne ikke skrive til {$xml_file}.</p>";
		} else {
			print "<p style=\"padding-left: 10px;\">XML-feed opdateret i /{$xml_file}.</p>";
		}
	}
}
?>
