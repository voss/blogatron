<?php
# Include config-file:
include('incs/config.inc.php');
include('incs/db.inc.php');
include('functions/functions.inc.php');
include('functions/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
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
		<title>. verture.net &raquo; bytes til sekunder .</title>
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
	<div class="entry" style="padding-bottom: 150px;">
<h1>Bytes til sekunder</h1>
<p>Da jeg selv er lidt af en klovn til at hitte rede i bits, bytes og sekunder har jeg slamkodet dette lille værktøj. Jeg brugte det primært til et usabilityprojekt hvor man ved at taste filstørrelser ind i formularen nemt kunne finde ud af hvor lang tid det ville tage at hente en given fil eller et dokument.<br />
Servicen regner med de tal der bliver tastet ind, og man får således en 'minimum' tid, idet der ikke blive taget højde for, at din 2Mbit linie reelt kun kan hente fra den pågældende server med det halve eller mindre. Med andre ord, den udregnede tid er hvor lang tid det ville tage i en perfekt verden.</p>
	<form action="/services/b2s/" method="get" id="b2s">
	    <fieldset id="b2sec">
	        <legend>Fra bytes til sekunder</legend>
	        <label>Datam&aelig;ngde i kBytes:<br />[2048 
	kBytes = 2Megabytes]</label><br /><input type="text" name="data" /><br />
	        <label>Forbindelseshastighed i kbit<br />[f.eks. 56 kbit/sec]:</label><br /><input type="text" name="t_speed" />
	        <p><input type="submit" value="Udregn nedlastningstid" style="font-size: small;" /></p>
			
			<?php
			if ($_GET['data'] && $_GET['t_speed']) {
			print '<div id="result">';
				$data =	$_GET['data'];
				$t_speed = $_GET['t_speed'];
				if (!is_numeric($data) || !is_numeric($t_speed)) {
					print "<p>Det er svært at regne med andet end	tal	i denne	sammenhæng.</p>\n";
				} else {
					
					$byte_pr_sec = (($t_speed*1000)/8);
					$data_tr_time =	($data*1000)/$byte_pr_sec;
					print "<p>Det vil tage minimum <span class=\"red\">" . date("H:i:s", mktime(0,0,$data_tr_time))	. "</span> minutter	at overføre " . $data . " kBytes	ved	".$t_speed." kbit/sek.</p>\n";
				}
			print '</div>';
			}
			?>
	    </fieldset>
	</form>
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