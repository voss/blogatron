<?php
# Include config-file:
@include('incs/config.inc.php');
@include('incs/includes.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da" >
<head>
   <title>. verture.net | info // kontakt .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <meta name="description" content="Weblog for Jonas Voss, K�benhavner og studerende, som s� mange andre." />
   <meta name="keywords" content="jonas, jonas voss, weblog, k�benhavn, sm� gr�nne dimsedutter der triller, langsomt" />
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
	      <div style="float: right"></div>
	      </div>
	   <div id="banner">
	      <div id="menu">
	      <?php @include('/home/voss/blog/incs/menu.inc');?>
			</div>
		</div>
      </div>
	   <div id="left">
	      <div id="lcontent">
	      <div class="entry">
	      <h1>?</h1>
<pre style="font-size: 12px;">
<?php
@include("me.php");
?>
</pre>
<h3>Disclaimer</h3>
<p>Jeg er Jonas Voss, ansat af <a href="http://google.ie/">Google</a>. Her skriver jeg om hvad der falder mig ind.</p>
<p>Hvad der end bliver skrevet p� sider under dette dom�ne, udtrykker min holdning, og ikke min arbejdsgivers.</p>
<?php
/*	<p>Jeg er Jonas Voss, en ganske almindelig ung mand fra 1975. Lever, l�ser og arbejder i K�benhavn.</p>
	<p>Bachelor i Udviklingsgeografi fra <a href="http://www.geogr.ku.dk/">K�benhavns Universitet</a>, og Cand.ITer in spe fra <a href="http://itu.dk/" title="IT Universitetet i K�benhavn">IT Universitetet</a> i K�benhavn.</p>

	<p>Siden her er min <a href="http://www.bound.dk/hvader.html" title="Jens Winthers forklaring p� en weblog">weblog</a>, hvor jeg skriver om hvad der falder mig ind. Den er ydermere min legeplads, hvor jeg piller, dimser og leger med interwebnettet, og der er derfor rimelig tit et eller andet der ikke virker <em>helt</em> som det skal.</p>
	<p>Navnet <em>verture</em> er sat sammen af verge <em>[p� randen af]</em> og future <em>[fremtid(en)]</em>, alts� betyder det noget lignende "p� kanten af fremtiden".</p>

	<p>Hvis du vil vide mere om mig kan du l�se <a href="/241103/100_ting">mine 100 ting</a>, <a href="/101203/interview_meme">mit interview meme</a> eller <a href="http://itu.dk/people/jcv/cv/"> mit CV</a>.</p>

	<p>Hvis du vil kontakte mig kan du g�re det via nedenst�ende formular.
Jeg bider sj�ldent, og lover at svare inden dommedag.</p>	
	
	<h1>Kontakt</h1>
*/
?>
<?php
/*
if(isset($_POST['submit'])) :
	if(isset($_POST['addy']) && ($_POST['msg'] != '')) 
	{
		$sender = $_POST['sender'];
		$addy = $_POST['addy'];
		$msg = $_POST['msg'];
		$valid_email = "^[a-z0-9_\.-]+([@]{1})[a-z0-9_\.-]+[\.][a-z0-9_\.-]+$";
		if(eregi($valid_email, $addy) == false)
		{
			print "<h1>Ups</h1><p>Ugyldig email, pr�v <a href=\"javascript:history.back(-1)\">igen</a>.</p>\n\n";
		}
		else
		{
			$msg .= "\n\nAfsender: {$sender}\n\n";
			$msg .= "{$_SERVER['HTTP_USER_AGENT']}\n\n";
			$msg .= "{$_SERVER['REMOTE_ADDR']}\n\n";
			$msg .= "{$_SERVER['REMOTE_HOST']}";
			# $msg = utf8_encode($msg);
			$msg = stripslashes($msg);
			$subject = "Besked fra g�st p� verture.net";
			$subject = quoted_printable_decode($subject);
			$headers = "From: $addy\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
			$headers .= "Content-Transfer-Encoding: quoted-printable";
			if(!mail("kontakt@verture.net",$subject,$msg,$headers))
			{
				print "<p>Der er sket en fejl, en forf�rdelig en af slagsen. Din mail kan af en eller anden teknisk �rsag ikke blive sendt. Hvis du brokker dig h�jlydt til <a href=\"mailto:jonas.voss@gmail.com\">mig</a>, vil jeg g�re alt for at fikse det.</p>";
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
		<p>Email og Besked skal udfyldes. Pr�v <a href=\"javascript:history.back(-1)\">igen</a>
		</p>";
	}
else:
print $mail_form;
endif;
*/
?>
	      </div>
   	   </div>
   	   </div>
 <?php
     @include('incs/sidebars.inc.php');
     ?>
