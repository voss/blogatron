<?php
# Include config-file and functions:
@include_once('incs/config.inc.php');
@include_once('incs/db.inc.php');
@include_once('incs/functions.inc.php');
@include_once('incs/display_functions.inc.php');
setcookie("peek-a-boo","last_visit", time()+3600*24*365, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>. <?=strtolower($front_title[0]);?> | <?=$blog_title;?> .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <script src="http://www.gvisit.com/record.php?sid=043c3d02563545754e66d6c8a9be2757" type="text/javascript"></script>
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="Indl�g" href="<?=$install_path;?>/rss/entries" />
   <link rel="alternate" type="application/rss+xml" title="Kommentarer" href="<?=$install_path;?>/rss/comments" />
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <meta name="description" content="<?=$description;?>" />
   <meta name="keywords" content="jonas, jonas c. voss, weblog, k�benhavn, dublin" />
   <meta name="ICBM" content="55.6773 , 12.5749" />
   <meta name="MSSmartTagsPreventParsing" content="true" />
   <style type="text/css" media="all">
   	@import "<?=$install_path;?>/stil.css";
   </style>
</head>
<body>
	<div id="container">
		<div id="top">
			<div id="banner2">
				<div style="float: right">
					
				</div>
			</div>

			<div id="banner">
				<div id="menu">
         			<?php @include('incs/menu.inc');?>
				</div>
			</div>
		</div>
<?php
/*		<div>
			<div id="new23" style="color: #950; text-align: center; font-size:xx-small; height; float: left;clear: both;">Loading <img src="/img/23fade.gif" alt="23 logo" /></div>
			<div id="newFlickr" style="color: #950; text-align: center; font-size:xx-small; display: inline; ">Loading Flickr...</div>
		</div>
*/
?>

		<div id="left">
	      <div id="lcontent">
<?php
/*			<div id="flickrimg">
				<h2>Flickrstream</h2>
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=4&display=latest&size=s&layout=h&source=user&user=42801574%40N00"></script>
			</div>
*/
?>
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
     </div>
     <?php
     @include('incs/sidebars.inc.php');
     ?>
