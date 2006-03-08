<?php
# Include config-file and functions:
@include_once('incs/config.inc.php');
@include_once('incs/db.inc.php');
@include_once('incs/functions.inc.php');
@include_once('incs/display_functions.inc.php');
# setcookie("peek-a-boo","last_visit", time()+3600*24*365, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>. <?=$blog_title;?> | <?=strtolower($front_title[0]);?> .</title>
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
         <?php @include('/home/voss/blog/incs/menu.inc');?>
<?php
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
			<p>Jeg er Jonas Voss, jeg arbejder for <a
href="http://google.ie/">Google</a>. Alt der bliver skrevet her er et
udtryk for min holdning, og ikke min arbejdsgivers.</p>
     <?php
     		@include('incs/sidebars.inc.php');
     ?>
