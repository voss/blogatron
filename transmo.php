<?php
# Include config-file:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
   <title>. verture.net | Entitetstransmogriffer .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://blog.verture.net/doegnrapport.php" />
   <meta name="ICBM" content="55.6773 , 12.5749" />
   <meta name="MSSmartTagsPreventParsing" content="true" />
   <style type="text/css" media="all">
   	@import "<?=$install_path;?>/stil.css";
   </style>
</head>
<body>
	<div id="wrapper">
		<h1 class="pagehead"><a href="/">verture.net &mdash; <?=$tagline;?></a></h1>
		<div style="float:right;"><form style="display:inline;" action="/do_search.php" method="get" id="searchform" onsubmit="if(this.q.value=='Type a query' || this.q.value=='') { alert('Please write a valid query'); this.q.select(); return false;} else { this.submit();}">
	<div style="display:inline;margin-bottom:10px;">
		<input type="search" name="q" value="" onclick="this.value='Type a query';this.select()" style="width: 100px; border: 1px solid #ddd;text-align:right" /><img src="/img/mag_glass.jpg" alt="Magnifying glass for search box" style="vertical-align:middle;padding-left: 5px" />
	</div>
	
</form>
</div>
    <div style="border-top: 1px solid #369; margin-top: 25px; padding-top:20px;">
		<div id="content">
		<div class="entry">
	<h1>Entitetstransmogriffer</h1>
		<div class="ebody">
			<p>N�r man er i udlandet, og kun har adgang til offentlige computere kan det v�re sv�rt at skaffe danske bogstaver til sine blogposteringer, og sine emails og breve. Det er meningen denne service skal r�de bod p� det.</p>
	<p>Det er meget enkelt: indtast din tekst i det �verste felt, og brug de nedenst�ende tegnkombinationer til at repr�sentere de danske, og tryk p� overs�t. Resultatet kommer frem i feltet nedenunder.</p>
	<p>Man kan f� dem som HTML-entiter ogs�, hvis man er til den slags.</p>
	<div>
	<div style="float: left;">
	<ul style="font-family: monospace; padding-left:25px;">
    <li>aa == �</li>
    <li>oe == �</li>
    <li>ae == �</li>
	</ul>
	</div>
	<div style="float: left">
	<ul style="font-family: monospace; padding-left: 25px;">
	<li>Aa == �</li>
	<li>Oe == �</li>
	<li>Ae == �</li>
	</ul>
	</div>
	</div>
<div style="width: 90%; padding-left: 10px;clear: both;">
<form action="/services/transmo/#t" method="post">
<fieldset class="transmo">
    <legend style="font-size:x-small;">Inds�t den danske tekst her</legend>
<textarea rows="14" cols="50" name="data"></textarea><br />
<div style="text-align: left;padding-top: 5px;">
    <label style="font-size:x-small;">Lav til HTML-entiteter</label><input type="checkbox" name="y" />
    <input type="reset" value="Slet indhold" onclick="if(!confirm('Er du sikker p� at du vil slette indholdet?'))return false;" />
    <span style="margin-left: 35px;"><input type="submit" name="x" value="Overs�t" /></span>
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
    print "<div style=\"width: 90%; padding-left: 10px;\" id=\"t\"><fieldset class=\"transmo\">\n";
    print "<legend style=\"font-size:x-small;\">Besku det oversatte mesterv�rk her</legend>\n";

    # If HTML-entities has been chosen, print the following:
    if (isset($_POST['y'])) {
	    print "<textarea rows=\"14\" cols=\"50\" onclick='this.select()'>".htmlentities(stripslashes($data))."</textarea>\n";

    # Else print danish characters:
    } else {
	    print "<textarea rows=\"14\" cols=\"50\" onclick='this.select()'>".stripslashes($data)."</textarea>\n";
    }

    # End fieldset & div
    print "</fieldset>\n</div>\n";
}
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
<p>Disclaimer: I speak for myself, not my employer || <!--Creative Commons License-->This work is licensed under a <a
rel="license"
href="http://creativecommons.org/licenses/by-nc-sa/2.5/">Creative
Commons by-nc-sa License</a>.
    <!--/Creative Commons License-->
    <!-- <rdf:RDF xmlns="http://web.resource.org/cc/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#">
    <Work rdf:about="">
      <license
rdf:resource="http://creativecommons.org/licenses/by-nc-sa/2.5/" />
      <dc:type rdf:resource="http://purl.org/dc/dcmitype/Text" />
    </Work>
    <License
rdf:about="http://creativecommons.org/licenses/by-nc-sa/2.5/">
      <permits rdf:resource="http://web.resource.org/cc/Reproduction"/>
      <permits rdf:resource="http://web.resource.org/cc/Distribution"/>
      <requires rdf:resource="http://web.resource.org/cc/Notice"/>
      <requires rdf:resource="http://web.resource.org/cc/Attribution"/>
      <prohibits
rdf:resource="http://web.resource.org/cc/CommercialUse"/>
      <permits
rdf:resource="http://web.resource.org/cc/DerivativeWorks"/>
      <requires rdf:resource="http://web.resource.org/cc/ShareAlike"/>
    </License>
    </rdf:RDF> -->
    </p>
    </div>
    </div>
    </div>
</body>
</html>