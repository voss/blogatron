<?php
# Include config-file:
@include_once('incs/config.inc.php');
@include_once('incs/db.inc.php');
@include_once('incs/functions.inc.php');
@include_once('incs/display_functions.inc.php');
@include_once('incs/includes.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da" >
<head>
	<title>. contact | <?=$blog_title;?>  .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <meta name="description" content="<?=$description;?>" />
   <meta name="keywords" content="<?=$key_words;?>" />
   <meta name="ICBM" content="55.6773 , 12.5749" />
   <meta name="MSSmartTagsPreventParsing" content="true" />
   <style type="text/css" media="all">
   	@import "<?=$install_path;?>/stil.css";
   </style>
</head>
	<body>
	<div id="wrapper">
		<h1 class="pagehead"><a href="/">verture.net &mdash; <?=$tagline;?></a></h1>
		<div id="content">
			<div class="entry">
				<h1>Contact</h1>
			<div class="ebody">
			<?php
			if(isset($_POST['submit'])) :
				if(isset($_POST['addy']) && ($_POST['msg'] != '' && $_POST['humanoid'] == '9')) 
				{
					$sender = $_POST['sender'];
					$addy = $_POST['addy'];
					$msg = $_POST['msg'];
					$valid_email = "^[a-z0-9_\.-]+([@]{1})[a-z0-9_\.-]+[\.][a-z0-9_\.-]+$";
					if(eregi($valid_email, $addy) == false)
					{
						print "<h1>Ups</h1><p>Invalid email, Try <a href=\"javascript:history.back(-1)\">again</a>.</p>\n\n";
					}
					else
					{
						$msg .= "\n\nAfsender: {$sender}\n\n";
						$msg .= "{$_SERVER['HTTP_USER_AGENT']}\n\n";
						$msg .= "{$_SERVER['REMOTE_ADDR']}\n\n";
						$msg .= "{$_SERVER['REMOTE_HOST']}";
						# $msg = utf8_encode($msg);
						$msg = stripslashes($msg);
						#$subject = "Besked fra gæst på verture.net";
						$subject = (!empty($_POST['subject'])) ? $_POST['subject'] : "Besked fra gæst på verture.net" ;
						$subject = quoted_printable_decode($subject);
						$headers = "From: $addy\n";
						$headers .= "MIME-Version: 1.0\n";
						$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
						$headers .= "Content-Transfer-Encoding: quoted-printable";
						if(!mail("kontakt@verture.net",$subject,$msg,$headers))
						{
							print "<p id=\"mail\">Oopsiedaisy, technical mishap. Your mail for some reason won't send. If you complain massively to <a href=\"mailto:jonas.voss@gmail.com\">me</a>, I'll do what I can to fix it.</p>";
						}
						else
						{
							print "<h2 style=\"text-align:center; padding-top: 20px\" id=\"mail\">Thank you!</h2>
							<p style=\"text-align:center; padding-top: 20px\">I'll get back to you ASAP - promise.</p>";
						#	print $subject;
						# exit();
						}
					}
				}
				else
				{
					print "<h1 id=\"mail\">Oopsiedaisy</h1>
					<p>Email, message and the math-test is required to send a message. Try <a href=\"javascript:history.back(-1)\">again</a>
					</p>";
				}
			else:
				print '<div class="section" id="kontakt">';
				print $mail_form;
				/* print 
				'<form action="." method="post" id="mail">
					<div>
					<p style="padding: 0; margin: 0; font-size: x-small;"><span style="color: #c00; font-weight: bold;">*</span> = skal udfyldes.</p>
					<label>Navn: </label><br />
					<input type="text" name="sender" /><br />
					<label>Email: </label><span style="color: #c00; font-weight: bold;">*</span><br />
					<input type="text" name="addy" /><br />
					Indsæt Æ i dette felt: 	<input type="text" name="humanoid" size="1" /><br />
					<label>Besked: </label><span style="color: #c00; font-weight: bold;">*</span><br />
					<textarea rows="10" cols="40" name="msg"></textarea><br />
					<input type="submit" name="submit" value="Send" />
				    </div>
				</form>';*/
				print '</div>';
			endif;
			?>
			</div>
			</div>
			</div>
			<div id="linkster">
				<?php
					@include('incs/sidebars.inc.php');
			     ?>
			</div>
			<div id="disclaimer">
			<p>Disclaimer: I speak for myself, not my employer || <!--Creative Commons License-->This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/">Creative Commons by-nc-sa License</a>.
			<!--/Creative Commons License-->
			<!-- <rdf:RDF xmlns="http://web.resource.org/cc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#">
			<Work rdf:about="">
				<license rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.5/" />
				<dc:type rdf:resource="http://purl.org/dc/dcmitype/Text" />
			</Work>
			<License rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.5/">
				<permits rdf:resource="http://web.resource.org/cc/Reproduction"/>
				<permits rdf:resource="http://web.resource.org/cc/Distribution"/>
				<requires rdf:resource="http://web.resource.org/cc/Notice"/>
				<requires rdf:resource="http://web.resource.org/cc/Attribution"/>
				<prohibits rdf:resource="http://web.resource.org/cc/CommercialUse"/>
				<permits rdf:resource="http://web.resource.org/cc/DerivativeWorks"/>
				<requires rdf:resource="http://web.resource.org/cc/ShareAlike"/>
			</License>
			</rdf:RDF> -->
			</p>
			</div>
	</div>
</body>
</html>
