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
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://blog.verture.net/doegnrapport.php" />
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
	<h1>Character transmogrifier</h1>
		<div class="ebody">
			<p>When you travel around outside scandinavian countries, and you only have access to public computers it can be an arduous task to get your mittens on scandinavian characters for your blogposts, emails, and letters. This little tool is supposed to fix that.</p>
	<p>It's very simple: Type your text in the area below, and the legend underneath shows what will get turned into what. Hit the Transmogrify button, and your result should show up in a automagically visible area below the button.</p>
	<p>If you prefer to get them as HTML entities, check the box next to the button.</p>
	<div>
	<div style="float: left;">
	<ul style="font-family: monospace; padding-left:25px;">
    <li>aa &rArr; å</li>
    <li>oe &rArr; ø</li>
    <li>ae &rArr; æ</li>
	</ul>
	</div>
	<div style="float: left">
	<ul style="font-family: monospace; padding-left: 45px;">
	<li>Aa &rArr; Å</li>
	<li>Oe &rArr; Ø</li>
	<li>Ae &rArr; Æ</li>
	</ul>
	</div>
	<div style="float: left">
	<ul style="font-family: monospace; padding-left: 45px;">
	<li>a: &rArr; ä</li>
	<li>o: &rArr; ö</li>
	<li>A: &rArr; Ä</li>
	<li>O: &rArr; Ö</li>
	</ul>
	</div>
	</div>
<div style="width: 90%; clear: both;">
	<form action="/services/transmo/#t">
		<fieldset class="transmo">
		    <legend style="">Insert text to be transmogrified here:</legend>
			<textarea rows="14" cols="50" style="width: 500px;heigh: 100px;" id="input" name="input"></textarea><br />
			<div style="text-align: left;padding-top: 5px;">
				<label style="font-size:x-small;">Give me HTML entities</label><input type="checkbox" name="y" id="entity" />
				<span style="margin-left: 30px;"><input type="button" name="x" value="Transmogrify" style=" width: 50%; height: 30px; font-weight:bold;" onclick="js_transmogriphy()" /></span>
			</div>
		</fieldset>
				<div id="output" style="display:none">
					<fieldset>
					<legend>Pick up the goods here:</legend>
					<textarea rows="14" cols="50" style="width: 500px;heigh: 100px;" id="target" name="target" onclick="this.select()"></textarea>
					</fieldset>
				</div>
	</form>
	JavaScript version based on original code written by <a href="http://dalager.com/">Christian Dalager</a> and used with permission.
</div>
<?php
/*
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
    print "<div style=\"width: 90%; padding-left: 10px;\" id=\"resultpane\"><fieldset class=\"transmo\">\n";
    print "<legend style=\"font-size:x-small;\">Besku det oversatte mesterværk her</legend>\n";

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

*/

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
