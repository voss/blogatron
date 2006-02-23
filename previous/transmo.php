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
		<title>. verture.net &raquo; entitetstransmogriffer .</title>
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
	<h1>Entitetstransmogriffer</h1>
	<p>Når man er i udlandet, og kun har adgang til offentlige computere kan det være svært at skaffe danske bogstaver til sine blogposteringer, og sine emails og breve. Det er meningen denne service skal råde bod på det.</p>
	<p>Det er meget enkelt: indtast din tekst i det øverste felt, og brug de nedenstående tegnkombinationer til at repræsentere de danske, og tryk på oversæt. Resultatet kommer frem i feltet nedenunder.</p>
	<p>Man kan få dem som HTML-entiter også, hvis man er til den slags.</p>
	<ul style="font-family: monospace; padding-left:45px;">
    <li>aa == å || Aa == Å</li>
    <li>oe == ø || Oe == Ø</li>
    <li>ae == æ || Ae == Æ</li>
	</ul>
<div style="width: 90%; padding-left: 30px;">
<form action="/services/transmo/#t" method="post">
<fieldset class="transmo">
    <legend style="font-size:x-small;">Indsæt den danske tekst her</legend>
<textarea rows="14" cols="50" name="data"></textarea><br />
<div style="text-align: left;padding-top: 5px;">
    <label style="font-size:x-small;">Lav til HTML-entiteter</label><input type="checkbox" name="y" />
    <input type="reset" value="Slet indhold" onclick="if(!confirm('Er du sikker på at du vil slette indholdet?'))return false;" />
    <span style="margin-left: 30px;"><input type="submit" name="x" value="Oversæt" /></span>
</div>
</fieldset>
</form>
</div>
<?php

# takes input and transmogriphies it.
function transmogriphy($arg) {
#    $dk_char = array('ae','Ae','oe','Oe','aa','Aa');
#    $rpl_char = array('&aelig;','&AElig;','&oslash;','&Oslash;','&aring;','&Aring;');
    $dk_char = array('aae','ae','Ae','oe','Oe','aa','Aa');
    $rpl_char = array('&aring;e','&aelig;','&AElig;','&oslash;','&Oslash;','&aring;','&Aring;');
    $arg = str_replace($dk_char, $rpl_char, $arg);
	return $arg;
}

# On form submission:
if (isset($_POST['x'])) {
    $data = $_POST['data'];
	$data = transmogriphy($data);

    # Begin fieldset
    print "<div style=\"width: 90%; padding-left: 30px;\" id=\"t\"><fieldset class=\"transmo\">\n";
    print "<legend style=\"font-size:x-small;\">Besku det oversatte mesterværk her</legend>\n";

    # If HTML-entities has been chosen, print the following:
    if (isset($_POST['y'])) {
	    print "<textarea rows=\"14\" cols=\"50\">".htmlentities(stripslashes($data))."</textarea>\n";

    # Else print danish characters:
    } else {
	    print "<textarea rows=\"14\" cols=\"50\">".stripslashes($data)."</textarea>\n";
    }

    # End fieldset & div
    print "</fieldset>\n</div>\n";
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
