<?php

## FILE: SEARCH.PHP ##
/*
function highlight_search($search_words,$string,$bgcolor='yellow')
{ 
	foreach($search_words as $search_word)
	{
		$string = eregi_replace("{$search_word}",'span style="background-color: '.$bgcolor.'"\\1/span', $string);
	} 
	return $string;
}
*/
# Include config:
include('incs/config.inc.php');

# include db-connection and functions file:
@include($inc_path.'db.inc.php');
@include('functions/functions.inc.php');
@include('functions/display_functions.inc.php');
@include($inc_path.'includes.inc.php');

$q = explode('/', $_SERVER['REQUEST_URI']);
$q = urldecode($q[2]);

$sql = "SELECT text, title, date, MATCH ( title, text, text_more ) AGAINST ('{$q}*' IN BOOLEAN MODE) AS SCORE FROM entries WHERE MATCH ( title, text, text_more ) AGAINST ('{$q}*' IN BOOLEAN MODE) and status = '1'";

$result = @mysql_query($sql);
$numrows = @mysql_num_rows($result);
if(!$result) {
	print "<p>Error executing query: " . mysql_error() . "</p>\n";
} else {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style type="text/css" media="all">
		@import "/css/prik.css";
	</style>
	<?php
		@include('css/IE_conditionals.inc');			
	?>		
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://<?=$domain_name;?>/rssfeed.xml" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="ICBM" content="55.67726, 12.57534" />
	<meta name="DC.title" content="<?=$dc_title;?>" />
	<meta name="Description" content="<?=$domain_name;?> <?=$description;?>." />
	<meta name="Keywords" content="<?=$domain_name;?>. <?=$key_words;?>" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	<script type="text/javascript" src="/js/jsscripts.js"></script>
	<title>. <?=$blog_title;?> | søg .</title> 
</head>
	<body>
		<div id="container">
			<div id="intro">
				<div id="header">
					<h2><span><img src="/img/vtext.png" /></span></h2>
				</div>
				<div>
					<div id="menu">
<?php
	@include('incs/menu.inc');
?>
					</div>
				</div>
				<div id="content">
<div class="entry" style="padding-bottom: 250px;">
<?php
	print '<h1>Resultat af søgning</h1>';
	print '<p>Du søgte efter <span style="color: #900; font-weight: bold">\''.urldecode($q).'\'</span>, og der blev fundet <b>'.$numrows.'</b> indlæg der matchede din søgning.</p><p>Resultaterne er sorteret efter relevans. Hvis søgeordet forekommer indenfor de første 200 bogstaver i indlægget er det fremhævet med <span style="background-color: #ddf">denne farve</span></p>';
	$i = 1;
		while($row = @mysql_fetch_array($result)) {
			extract ($row);
			$linkdate = date('dmy', $date);
			$date = date("G:i || d.m || Y", $date);
			print "<div class='seperator'>\n";
			print "<div class='head'>";
#			print '<p>#'.$i.'</p>';
			print "<h1>#$i <a href=\"/{$linkdate}/".dirify($title)."\">{$title}</a></h1>\n";
			print "</div>";
			print "<p class=\"date\">{$date}</p>\n";
			$text = strip_tags($text);
			$text = stripslashes($text);
			$text = substr($text, 0, 200);
			$text = preg_replace("/({$q})/i",'<span style="background-color: #ddf">\\1</span>', $text);
			print "<p>{$text}...</p>\n</div>";
			$i++;
		}
}
?>
</div>

				</div>
				<div id="footer">
<?php
	@include('incs/footer.inc');
?>

				</div>
			</div>
			<div id="rcol">
				<div id="rcol2">
<?php
	@include('incs/rightc.inc');
?>
				</div>
			</div>
	</body>
</html>
<?php
	$fp = @fopen('/home/voss/search_terms.txt', 'a');
	@fputs($fp, $q.": ".$_SERVER['REMOTE_ADDR'].": ".date('r', (time() + ($offset * 3600)))."\n");
	@fclose($fp);
	# @mail('jonas@verture.net', "search: '{$q}'", $q."\n".$_SERVER['REMOTE_ADDR'], 'from: search.bot@verture.net');
	mysql_close($dbcnx);
?>
