<?php
# Include config-file:
include('incs/config.inc.php');
include('incs/includes.inc.php');
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
		<title>. verture.net &raquo; info // kontakt .</title>
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
	<h1>?</h1>
	<p>Jeg er Jonas Voss, en ganske almindelig ung mand fra 1975. Lever, læser og arbejder i København.</p>
	<p>Bachelor i Udviklingsgeografi fra <a href="http://www.geogr.ku.dk/">Københavns Universitet</a>, og læser til Cand.IT i Design, Kommunikation og Medier på <a href="http://itu.dk/" title="IT Universitetet i København">IT Universitetet</a> i København.</p>

	<p>Siden her er min <a href="http://www.bound.dk/hvader.html" title="Jens Winthers forklaring på en weblog">weblog</a>, hvor jeg skriver om hvad der falder mig ind. Den er ydermere min legeplads, hvor jeg piller, dimser og leger med interwebnettet, og der er derfor rimelig tit et eller andet der ikke virker <em>helt</em> som det skal.</p>
	<p>Navnet <em>verture</em> er sat sammen af verge <em>[på randen af]</em> og future <em>[fremtid(en)]</em>, altså betyder det noget lignende "på kanten af fremtiden". Noget skulle det jo hedde.</p>

	<p>Der står 100 ting om mig <a href="http://blog.verture.net/251103/100_ting">her</a>, og mit interview meme kan ses <a href="http://blog.verture.net/101203/interview_meme">her</a>.</p>

	<p>Hvis du vil kontakte mig kan du gøre det via nedenstående formular.</p>	
	
	<h1>Kontakt</h1>
<?php
if(isset($_POST['submit'])) :
	if(isset($_POST['addy']) && ($_POST['msg'] != '')) 
	{
		$sender = $_POST['sender'];
		$addy = $_POST['addy'];
		$msg = $_POST['msg'];
		$valid_email = "^[a-z0-9_\.-]+([@]{1})[a-z0-9_\.-]+[\.][a-z0-9_\.-]+$";
		if(eregi($valid_email, $addy) == false)
		{
			print "<h1>Ups</h1><p>Ugyldig email, prøv <a href=\"javascript:history.back(-1)\">igen</a>.</p>\n\n";
		}
		else
		{
			$msg .= "\n\nAfsender: {$sender}\n\n";
			$msg .= "{$_SERVER['HTTP_USER_AGENT']}\n\n";
			$msg .= "{$_SERVER['REMOTE_ADDR']}\n\n";
			$msg .= "{$_SERVER['REMOTE_HOST']}";
			# $msg = utf8_encode($msg);
			$msg = stripslashes($msg);
			$subject = "Besked fra gæst på verture.net";
			$subject = quoted_printable_decode($subject);
			$headers = "From: $addy\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
			$headers .= "Content-Transfer-Encoding: quoted-printable";
			if(!mail("kontakt@verture.net",$subject,$msg,$headers))
			{
				print "<p>Der er sket en fejl, en forfærdelig en af slagsen. Din mail kan af en eller anden teknisk årsag ikke blive sendt. Hvis du brokker dig højlydt til <a href=\"mailto:jcv@itu.dk\">mig</a>, vil jeg gøre alt for at fikse det.</p>";
			}
			else
			{
				print "<h1>Tak for din mail.</h1>
				<p>Jeg vil vende tilbage til dig hurtigst muligt.</p>
				<p>
					<a href=\".\">Til forsiden</a>
				</p>";
			# exit();
			}
		}
	}
	else
	{
		print "<h1>Ups</h1>
		<p>Email og Besked skal udfyldes. Prøv <a href=\"javascript:history.back(-1)\">igen</a>
		</p>";
	}
else:
print $mail_form;
endif;
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
