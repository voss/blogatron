<?php
# Include config-file:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('functions/functions.inc.php');
@include('functions/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="http://blog.verture.net/rssfeed.xml" />
		<link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://blog.verture.net/doegnrapport.php" />
		<meta name="ICBM" content="55.6773 , 12.5749" />
		<meta name="MSSmartTagsPreventParsing" content="true" />
		<script type="text/javascript" src="/js/jsscripts.js"></script>
		<style type="text/css" media="all">
			@import "/css/prik.css";
		</style>
		<?php
			@include('css/IE_conditionals.inc');			
		?>		
		<title>. verture.net &raquo; services .</title>
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
	<div class="entry" style="margin-bottom: 300px;">
	<h1>Services</h1>
	<p>Fra tid til anden slamkoder jeg et lille v�rkt�j som jeg skal bruge til et eller andet. M�ske kan de v�re til hj�lp for andre, og derfor har jeg lagt dem online her. Hvis du finder dem anvendelige er det herligt.</p>
	<ul id="services">
    <li><a href="/services/transmo/">Entitetstransmogriffer</a>.<br />
    �, � og � for folk p� farten. Oprindeligt lavet til <a href="http://kittenmoon.com/">Rasmus</a> da han tog til Spanien i for�ret 2002. <a href="http://snuf.dk/">Steffen</a>, <a href="http://www.bering-express.dk/">Christian</a> og <a href="http://www.mariebering.dk/">Marie</a> har ogs� fundet den anvendelig.</li>
    <li><a href="/services/b2s/">Bytes til sekunder</a>.<br />
    En service der giver en minimumstid for, hvor lang tid det vil tage at overf�re en fil af en bestemt st�rrelse over en forbindelse med en bestemt hastighed.</li>
    <li><a href="http://blog.verture.net/doegnrapport.php" rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport">K�benhavns Politis D�gnrapport</a><br />
    Piratfeed af d�gnrapporten fra K�benhavns Politi, s� du kan holde dig opdateret om underverdenens gang i K�benhavn (kr�ver en feedaggregator).</li>
	</ul>
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