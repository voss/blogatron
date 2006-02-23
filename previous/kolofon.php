<?php
# Include config-file:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('functions/functions.inc.php');
@include('functions/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="http://blog.verture.net/rssfeed.xml" />
		<link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://blog.verture.net/doegnrapport.php" />
		<meta name="ICBM" content="55.6773 , 12.5749" />
		<meta name="MSSmartTagsPreventParsing" content="true" />
		<script type="text/javascript" src="/js/jsscripts.js"></script>
		<style type="text/css" media="all">
			@import "/css/prik.css";
		</style>
		<?php
			@include('css/IE_conditionals.inc');			
		?>		
		<title>. verture.net &raquo; kolofon .</title>
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
<div class="entry">
	<h2>verture.net</h2>
   <p>Grundet uheld med uønskede gæster der slettede ting på serveren, kan arkiverne fremstå lidt pletvist frem til maj 2003. Der er ellers blevet hældt indhold på disse sider siden november 2001.</p>
	<p>Her anvendes <a href="http://www.w3.org/TR/xhtml11/" title="XHTML 1.1 specs">XHTML 1.1</a> og <a href="http://www.w3.org/TR/REC-CSS2/" title="CSS 2 specs">CSS 2</a>, og det ser derfor ganske sikkert forfærdelig ud i ældre browsere, som f.eks. Netscape Navigator 4.xx og Internet Explorer &lt; 5.5.</p>
	
	<p>Alle <span title="Camino, Mozilla, Firefox, Opera, Safari, Konqueror">nyere browsere</span> skulle vise den nogenlunde hæderligt, og besøger man den med ældre browsere skulle man stadig kunne se indholdet og navigere rundt på siderne.</p>
	
	<p>Men kønt er det nok ikke.</p>
	
	<h2>Skrifttyper</h2>
	<p>Besøger man siden med <a href="http://apple.com/macosx/" title="Mac OS X, desktop Unix">Mac OS X</a> vil man få teksten serveret med Lucida Grande, OS X's systemskrift. Browsere i andre operativsystemer vil få den serveret i Trebuchet eller standard sans-serif skriften for ens browser/<abbr title="Operativsystem">OS</abbr>.</p>
	
	<h2>Backend</h2>
	<p>Hjemmerullet med PHP og MySQL. Der bliver jævnligt dimset og fundet fejl.</p>
	
	<h2><abbr title="Rich Site Summary, RDF Site Summary, Really Simple Syndication">RSS</abbr></h2>
	<p>verture.net udgives også i en <a
  href="http://blog.verture.net/rssfeed.xml" title="RSS-version af verture.net">RSS-version</a>, lige til at fodre din nyhedsaggregator med.</p>
	
	<h2>Værktøjer</h2>
	<p>Jeg skriver koden i <a href="http://macromates.com/" title="Licens #32">TextMate</a> i samarbejde med <a href="http://www.jwwalker.com/pages/autopairs.html">AutoPairs</a>, og bruger <a href="http://rsug.itd.umich.edu/software/fugu" title="GUI SFTP, SCP, SSH klient til Mac OS X">Fugu</a> til at transmittere filerne til mit webhotel.</p>
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
