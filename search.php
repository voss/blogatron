<?php

## FILE: SEARCH.PHP ##

# Include config:
@include('incs/config.inc.php');

# include db-connection and functions file:
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
@include('incs/includes.inc.php');

$q = explode('/', $_SERVER['REQUEST_URI']);
$q = urldecode($q[2]);

$sql = "SELECT name, text, title, date, MATCH ( title, text, text_more ) AGAINST ('{$q}*' IN BOOLEAN MODE) AS SCORE FROM authors, entries WHERE MATCH ( title, text, text_more ) AGAINST ('{$q}*' IN BOOLEAN MODE) and status = '1' and entries.aid = authors.uid";

$result = @mysql_query($sql);
$numrows = @mysql_num_rows($result);
if(!$result) {
	print "<p>Error executing query: " . mysql_error() . "</p>\n";
} else {?>
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="Description" content="<?=$domain_name;?> <?=$description;?>." />
	<meta name="Keywords" content="<?=$domain_name;?>. <?=$key_words;?>" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	<script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
	<title>. <?=$blog_title;?> | søgeresultater .</title>
	<style type="text/css" media="all">
		@import "<?=$install_path;?>/stil.css";
	</style>
</head>
<body>
	<div id="wrapper">
		<h2>verture.net &mdash; nu i hvidt</h2>
		<div id="search">
			<?php @include('incs/menu.inc');?>
		</div>
	      	<div class="entry" style="padding-bottom: 250px;">
            <?php
            	print '<h1 class="arkiv">Resultat af søgning</h1>';
            	print '<p>Du søgte efter <span style="color: #900; font-weight: bold">\''.urldecode($q).'\'</span>, og der blev fundet <b>'.$numrows.'</b> indlæg der matchede din søgning.</p><p>Resultaterne er sorteret efter relevans. Hvis søgeordet forekommer indenfor de første 200 bogstaver i indlægget er det fremhævet med <span style="background-color: #cff">denne farve</span></p>';
            	$i = 1;
            		while($row = @mysql_fetch_array($result)) {
            			extract ($row);
            			$linkdate = date('dmy', $date);
            			$date = date("G:i || d.m || Y", $date);
            			print "<h1>#$i <a href=\"{$install_path}/{$linkdate}/".dirify($title)."\" style=\"margin-left: 3px\">{$title}</a></h1>\n";
            			print "<p class=\"date\" style=\"margin-left: 17px;\">{$date} af {$name}</p>\n";
            			$text = strip_tags($text);
            			$text = stripslashes($text);
            			$text = substr($text, 0, 200).' ...';
            			$text = preg_replace("/({$q})/i",'<span style="background-color: #cff">\\1</span>', $text);
            			?>
            			<div style="padding-left: 17px;">
            			<?php
            			print format_entry($text);
            			$i++;
            			?>
            			</div>
            			<?php
            		}
            }
         ?>
         </div>
      </div>
      </div>
      <?php
     @include('incs/sidebars.inc.php');
     ?>