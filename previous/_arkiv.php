<?php
# Include config-file:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('functions/functions.inc.php');
@include('functions/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="http://blog.verture.net/rssfeed.xml" />
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<meta name="ICBM" content="55.6773 , 12.5749" />
		<meta name="MSSmartTagsPreventParsing" content="true" />
		<script type="text/javascript" src="/js/jsscripts.js"></script>
		<style type="text/css" media="all">
			@import "/css/prik.css";
		</style>
		<?php
			@include('css/IE_conditionals.inc');			
		?>		
		<title>. verture.net &raquo; arkiv .</title>
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
				<div>
<?php
if(eregi("/arkiv/([.0-9#?!a-z]+)", $_SERVER['REQUEST_URI']))
{
	display_archive_entry();
}
else
{
	print '<div class="entry">';
	print '<p>Vælg en måned i rulleskakten i højre kolonne</p>';;
	print '</div>';
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
	mysql_close($dbcnx);
?>
