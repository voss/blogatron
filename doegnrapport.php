<?php
header("Location: http://quovadis.dk/doegnrapport.php");

/*header("Content-type: application/xml");

# Read the page into $handle:
$handle = file_get_contents('http://www.politi.dk/Koebenhavn/da/lokalnyt/Doegnrapporter/doegnrapport_050505.htm','r');

# Extract title of page:
$title = preg_match("/<title>(.*)<\/title>/", $handle, $matches);

# Extract last build date of page:
$page_build_date = preg_match("/<span class='dato'>(.*)<\/span>/", $handle, $build_date);

# Look for this pattern (much obliged Mr. Dalager (http://dalager.com/weblog/)):
$pattern = "<span class='DRoverskrift'>(.+)</span>(?:<p><span class='lillefont2'>)([\W\sa-z0-9æøå,-:\. ]*?)(?:</span><P><p>)";

# Escape slashes in the pattern:
$pattern = addcslashes($pattern, '/');

$overskrift = preg_match_all("/$pattern/i", $handle, $overskrifter);

# Build output:
$xml_string = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
<rss version=\"2.0\">
<channel>
	<title>. {$matches[1]} | Seneste døgnrapport - {$build_date[1]} .</title>
	<description>Døgnrapport for Københavns Politi</description>
	<link>http://www.kbhpol.dk/default1.asp?side=DR&amp;dag=seneste</link>
	<author>Jonas Voss, med masser af hjælp fra Christian Dalager, perl regex og PHP ".phpversion()."</author>
	<lastBuildDate>".date('r', time() + (9* 3600))."</lastBuildDate>
";
	for($i=0; $i < count($overskrifter[0]); $i++) {
		$xml_string .= "<item>\n\t";
		$xml_string .= "<title>".strip_tags($overskrifter[1][$i], "<b>")."</title>";
		$xml_string .= "<description>".strip_tags($overskrifter[2][$i], "<b>")."</description>";
		$xml_string .= "</item>\n";
	}	
	$xml_string .= "</channel>\n</rss>";

print $xml_string;
*/
?>
