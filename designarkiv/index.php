<?php
# Include config-file:
@include('/home/voss/blog.verture.net/incs/config.inc.php');
@include('/home/voss/blog.verture.net/incs/db.inc.php');
@include('/home/voss/blog.verture.net/incs/functions.inc.php');
@include('/home/voss/blog.verture.net/incs/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="dk" >
<head>
   <title>. verture.net | designarkiv .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://blog.verture.net/doegnrapport.php" />
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
               <h1>Designarkiv</h1>
               <div class="ebody">
               <p>verture.net har haft en del forskellige udseender igennem tiden, og de er magasineret på denne side. Jeg har primært benyttet <a href="http://archive.org/">archive.org</a> til at finde de gamle designs frem, da jeg ikke tog backup af de helt tidlige designs.</p>
               <p>Links til indlæg og kommentarer på de nedenstående sider er i bedste fald uvirksomme, eller peger på en 404, så er du advaret.</p>
               <ol>
                  <li><a href="jan_2002/proper.gif">Den tidlige grå</a> (januar, 2002)<br />
                  Mit allerførste udseende, gråt og rødt. Og en anelse kedeligt. Linket peger på et screenshot af siden, da archive.org ikke havde den arkiveret.</li>
                  <li><a href="maj_2002/">Gråt og blåt</a> (maj, 2002)<br />
                  Tilføjelsen af en styleswitcher peppede det grå lidt op.</li>
                  <li><a href="nov_2002/">Så er der kaffe</a> (november, 2002)<br />
                  Kærlighed til kaffe inspirerede dette design. Den heftige brug af CSS positionering, og dertilhørende browsersniffer til at servere et fordummet CSS-ark til browsere der ikke kunne kapere det, gjorde den temmelig besværlig at vedligeholde.</li>
                  <li><a href="april_2003/">Ubudne gæster</a> (april, 2003)<br />
                  I slutningen af marts 2003 blev min webhost hacket, og alt forsvandt. En interimistisk side kom op imens jeg slikkede sårene, og gik igang med at skrive mit eget blogværktøj.</li>
                  <li><a href="sept_2003/">In your face Flanders</a> (september, 2003)<br />
                  Et simpelt udseende, til min simple hjemmelavede backend.</li>
                  <li><a href="nov_2003/">Efterårslook</a> (november, 2003)<br />
                  Efterår, ikke så meget at tilføje til det.</li>
                  <li><a href="februar_2004">Vinter</a> (februar, 2004)<br />
                  Hvidt og blåt vinterlook.</li>
						<li><a href="sept_2004">Simpelt og grønt</a> (september, 2004)<br />
                  Hvidt, blåt og simpelt.</li>
               </ol>
               </div>
            </div>
            </div>
		<div id="linkster">
			<?php
				include('/home/voss/blog.verture.net/incs/sidebars.inc.php');
		     ?>
		</div>
		<div id="disclaimer">
		<p>Disclaimer: I speak for myself, not my employer. srsly. || <!--Creative Commons License-->This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/">Creative Commons by-nc-sa License</a>.
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
	</div>
</body>
</html>
