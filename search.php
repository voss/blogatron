<?php

## FILE: SEARCH.PHP ##

# Include config:
@include('incs/config.inc.php');

# include db-connection and functions file:
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
@include('incs/includes.inc.php');

# Get the user query from do_search.php
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
	<title>. search results for '<?=$q;?>' | <?=$tagline;?> | <?=$blog_title;?> .</title>
	<style type="text/css" media="all">
		@import "<?=$install_path;?>/stil.css";
	</style>
</head>
<body>
	<div id="wrapper">
		<h1 class="pagehead"><a href="/">verture.net &mdash; <?=$tagline;?></a></h1>
		<div id="content">
	      	<div class="entry" style="padding-bottom: 250px;">
            <?php
            	print '<h1 class="arkiv">Result of your search</h1>';
            	print '<p>You searced for <span style="color: #693; font-weight: bold">\''.urldecode($q).'\'</span>, and <b>'.$numrows.'</b> posts matched your query.</p><p>The results are sorted by relevance. If your query appears within the first 200 characters of the post, it is highlighted with <span style="background-color: #cff">this colour</span>.</p>';
            	$i = 1;
            		while($row = @mysql_fetch_array($result)) {
            			extract ($row);
            			$linkdate = date('dmy', $date);
            			$date = date("G:i || d.m || Y", $date);
            			print "<h1>#$i <a href=\"{$install_path}/{$linkdate}/".dirify($title)."\" style=\"margin-left: 3px\">{$title}</a></h1>\n";
            			print "<p class=\"date\" style=\"margin-left: 17px;\">{$date} by {$name}</p>\n";
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
		<div id="linkster">
		     <?php
			     @include('incs/sidebars.inc.php');
		     ?>
		</div>
    <div id="disclaimer">
      <p><p>Disclaimer: I speak for myself, not my employer || <!--Creative Commons License-->This work is licensed under a <a
rel="license"
href="http://creativecommons.org/licenses/by-nc-sa/2.5/">Creative
Commons by-nc-sa License</a>.
    <!--/Creative Commons License-->
    <!-- <rdf:RDF xmlns="http://web.resource.org/cc/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#">
    <Work rdf:about="">
      <license
rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.5/" />
      <dc:type rdf:resource="http://purl.org/dc/dcmitype/Text" />
    </Work>
    <License
rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.5/">
      <permits rdf:resource="http://web.resource.org/cc/Reproduction"/>
      <permits rdf:resource="http://web.resource.org/cc/Distribution"/>
      <requires rdf:resource="http://web.resource.org/cc/Notice"/>
      <requires rdf:resource="http://web.resource.org/cc/Attribution"/>
      <prohibits
rdf:resource="http://web.resource.org/cc/CommercialUse"/>
      <permits
rdf:resource="http://web.resource.org/cc/DerivativeWorks"/>
      <requires rdf:resource="http://web.resource.org/cc/ShareAlike"/>
    </License>
    </rdf:RDF> -->
    </p>
    </div>
    </div>
</body>
</html>
