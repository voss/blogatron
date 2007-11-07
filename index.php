<?php

# file: index.php

# Include config-file and functions:
@include_once('incs/config.inc.php');
@include_once('incs/db.inc.php');
@include_once('incs/functions.inc.php');
@include_once('incs/display_functions.inc.php');
#setcookie("peek-a-boo","last_visit", time()+3600*24*365, "/");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>. <?=$title_tag;?> | <?=$blog_title;?>  .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <script src="http://www.gvisit.com/record.php?sid=043c3d02563545754e66d6c8a9be2757" type="text/javascript"></script>
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="Indlæg" href="<?=$install_path;?>/rss/entries" />
   <link rel="alternate" type="application/rss+xml" title="Kommentarer" href="<?=$install_path;?>/rss/comments" />
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://blog.verture.net/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <meta name="description" content="<?=$description;?>" />
   <meta name="keywords" content="<?=$key_words;?>" />
   <meta name="ICBM" content="55.6773 , 12.5749" />
   <meta name="MSSmartTagsPreventParsing" content="true" />
   <style type="text/css" media="all">
   	@import "<?=$install_path;?>/stil.css";
   </style>
</head>
<body>
	<div id="wrapper">
		<h1 class="pagehead"><a href="/">verture.net &mdash; <?=$tagline;?></a></h1>
		<div style="float:right;"><form style="display:inline;" action="/do_search.php" method="get" id="searchform" onsubmit="if(this.q.value=='Type a query' || this.q.value=='') { alert('Please write a valid query'); this.q.select(); return false;} else { this.submit();}">
	<div style="display:inline;margin-bottom:10px;">
		<input type="search" name="q" value="" onclick="this.value='Type a query';this.select()" style="width: 100px; border: 1px solid #ddd;text-align:right" /><img src="/img/mag_glass.jpg" alt="Magnifying glass for search box" style="vertical-align:middle;padding-left: 5px" />
	</div>
	
</form>
</div>
    <div style="border-top: 1px solid #369; margin-top: 25px; padding-top:20px;">
		<div id="content">
	      <?php
			if(eregi("([0-9]{6})([/.]?)([-_.#!?a-z0-9]{0,15})", $_SERVER['REQUEST_URI']))
			{
				display_entry_from_url();
			}
			else
			{
				display_front_page('5');
			}
   		?>
		</div>
		<div id="linkster">
			<?php
				@include('incs/sidebars.inc.php');
		     ?>
		</div>
		<div id="disclaimer">
		<p>Disclaimer: I speak for myself, not my employer. srsly. || <!--Creative Commons License-->This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/">Creative Commons by-nc-sa License</a>.
		<!--/Creative Commons License-->
		<!-- <rdf:RDF xmlns="http://web.resource.org/cc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#">
		<Work rdf:about="">
			<license rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.5/" />
			<dc:type rdf:resource="http://purl.org/dc/dcmitype/Text" />
		</Work>
		<License rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.5/">
			<permits rdf:resource="http://web.resource.org/cc/Reproduction"/>
			<permits rdf:resource="http://web.resource.org/cc/Distribution"/>
			<requires rdf:resource="http://web.resource.org/cc/Notice"/>
			<requires rdf:resource="http://web.resource.org/cc/Attribution"/>
			<prohibits rdf:resource="http://web.resource.org/cc/CommercialUse"/>
			<permits rdf:resource="http://web.resource.org/cc/DerivativeWorks"/>
			<requires rdf:resource="http://web.resource.org/cc/ShareAlike"/>
		</License>
		</rdf:RDF> -->
		</p>
		</div>
	</div>
	</div>
</body>
</html>
