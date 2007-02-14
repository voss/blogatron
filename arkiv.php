<?php

#file: arkiv.php

# Include config:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
setcookie("peek-a-boo","last_visit_2", time()+3600*24*365, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>. <?=$blog_title;?> | arkiv  .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://blog.verture.net/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://blog.verture.net/doegnrapport.php" />
   <meta name="description" content="Weblog for Jonas Voss, Københavner og studerende, som så mange andre." />
   <meta name="keywords" content="jonas, jonas voss, weblog, københavn, små grønne dimsedutter der triller, langsomt" />
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
			if(eregi("{$install_path}/arkiv/([.0-9#?!a-z]+)", $_SERVER['REQUEST_URI']))
			{
				display_archive_entry();
			}
			else
			{
				display_archive_months();
			}
			?>
			</div>
		<div id="linkster">
	    	<?php
				@include('incs/sidebars.inc.php');
			?>
		</div>
		</div>
	</div>
</body>
</html>