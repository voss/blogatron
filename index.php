<?php
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
   <title>. <?=strtolower($front_title[0]);?> | <?=$blog_title;?> .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <script src="http://www.gvisit.com/record.php?sid=043c3d02563545754e66d6c8a9be2757" type="text/javascript"></script>
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="Indlæg" href="<?=$install_path;?>/rss/entries" />
   <link rel="alternate" type="application/rss+xml" title="Kommentarer" href="<?=$install_path;?>/rss/comments" />
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <meta name="description" content="<?=$description;?>" />
   <meta name="keywords" content="jonas, jonas c. voss, weblog, københavn, dublin" />
   <meta name="ICBM" content="55.6773 , 12.5749" />
   <meta name="MSSmartTagsPreventParsing" content="true" />
   <style type="text/css" media="all">
   	@import "<?=$install_path;?>/stil.css";
   </style>
</head>
<body>
	<div id="wrapper">
		<h2><a href="/">verture.net &mdash; about:blank</a></h2>
		<div id="search">
			<?php @include('incs/menu.inc');?>
		</div>
		<div id="content">
	      <?php
			if(eregi("([0-9]{6})([/.]?)([-_.#!?a-z0-9]{0,15})", $_SERVER['REQUEST_URI']))
			{
				display_entry_from_url();
			}
			else
			{
				display_front_page('10');
			}
   		?>
			<div id="disclaimer">
			<p>Disclaimer: Alt der bliver skrevet her er et udtryk for min holdning, og ikke min arbejdsgivers.</p>
			</div>
		</div>
		<div id="linkster">
			<?php
				@include('incs/sidebars.inc.php');
		     ?>
		</div>
	</div>
</body>
</html>