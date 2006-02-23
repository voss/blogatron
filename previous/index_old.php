<?php

# Include config-file:
include('incs/config.inc.php');
include('incs/db.inc.php');
include('functions/functions.inc.php');
include('functions/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="http://<?=$domain_name;?>/css/verture.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://<?=$domain_name;?>/rssfeed.xml" />
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="ICBM" content="55.6773 , 12.5749" />
	<meta name="DC.title" content="<?=$dc_title;?>" />
	<meta name="Description" content="<?=$domain_name;?> <?=$description;?>." />
	<meta name="Keywords" content="<?=$domain_name;?>. <?=$key_words;?>" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	<script type="text/javascript" src="/js/jsscripts.js"></script>
	<title>. <?=$blog_title;?> | <?=$front_title[0];?> .</title> 
</head>
<body>
<div id="top"><a href="/" title="Forside"><img src="http://blog.verture.net/img/top2.jpg" alt="forsidebillede" /></a></div>
<div id="content">
<div id="top2">
			<ul>
				<li>
					<a href="/" title="weblog">blog</a>
				</li>
				<li>
					<a href="/kontakt/" title="Hvem står bag?">Info // Kontakt</a>
				</li>
				<li>
					<a href="/services/" title="Public Service">Services</a>
				</li>
				<li>
					<a href="http://wax.verture.net/" title="Plader og CD'ere">Plader</a>
				</li>
				<li>
					<a href="http://pics.verture.net/" title="Glimt">Galleri</a>
				</li>
				<li>
					<a href="/kolofon/" title="Tech spec">Kolofon</a>
				</li>
			</ul>
</div>
<div id="left">
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
</div>

<div id="right">
<?php
	@include('incs/rightc.inc');
?>
</div>

<div id="foot">
<?php
	include('incs/footer.inc');
?>
</div>
</body>
</html>
