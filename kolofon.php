<?php
# Include config-file:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da">
<head>
   <title>. verture.net | kolofon .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <meta name="description" content="<?=$description;?>" />
   <meta name="keywords" content="jonas, jonas c. voss, weblog, k�benhavn, dublin" />
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
	      <div class="entry" id="entry">
	      	<h1>verture.net</h1>
	         <p>Jeg har siden november 2001 h�ldt indhold p� denne blog, men grundet uheld med uv�rne netizens der slettede
            ting p� serveren der tidligere hostede bloggen, kan arkiverne frem til maj 2003 fremst� lidt pletvise og
            amputerede. Jeg l�rte s�, at det <em>er</em> smart at tage backup en gang i mellem.</p>
            
            <p>Siden har skiftet udseende en del gange. Nogle af de tidligere er <a href="/designarkiv/">arkiveret i
            designarkivet</a>.</p>
           
	      	<p>Her anvendes <a href="http://www.w3.org/TR/xhtml11/" title="XHTML 1.1 specs">XHTML 1.1</a> og <a
            href="http://www.w3.org/TR/REC-CSS2/" title="CSS 2 specs">CSS 2</a>, og det ser derfor ganske sikkert
            forf�rdeligt ud i �ldre browsere, som f.eks. Netscape Navigator 4.xx og Internet Explorer &lt; 5.5.</p>
	      	
	      	<p>Alle <span title="Camino, Mozilla, Firefox, Opera, Safari, Konqueror">nyere browsere</span> skulle vise den
            nogenlunde h�derligt, og bes�ger man den med �ldre browsere skulle man stadig kunne se indholdet og navigere
            rundt p� siderne.</p>
	      	
	      	<p>Men k�nt er det nok ikke.</p>
	      	
	      	<h1>Skrifttyper</h1>
	      	<p>Bes�ger man siden med <a href="http://apple.com/macosx/" title="Mac OS X, desktop Unix">Mac OS X</a> vil man
            f� teksten serveret med Lucida Grande, OS X's systemskrift. Browsere i andre operativsystemer vil f� den
            serveret i Trebuchet eller standard sans-serif skriften for ens browser/<abbr
            title="Operativsystem">OS</abbr>.</p>
	      	
	      	<h1>Backend</h1>
	      	<p>Hjemmerullet med <a href="http://php.net/">PHP</a> og <a href="http://mysql.com/">MySQL</a>. Der bliver
            j�vnligt dimset og fundet fejl. I skrivende stund l�gger disse to ryg til <?php
            include('/home/voss/blog/incs/stats.inc.php'); ?></p>
	      	
	      	<h1>Syndikering</h1>
	      	<p>Bloggen her udgives ogs� i en syndikeringsvenlig <a href="/rss/entries" title="RSS-version af verture.net"><abbr title="Rich Site Summary, RDF Site Summary, Really Simple Syndication">RSS</abbr>-version</a>, lige til at fodre din nyhedsaggregator med. Man kan ogs� abonnere p� <a href="/rss/comments">kommentarerne</a>.</p>

	        
          <h1>Lister og billeder</h1>
	      	<p>Min playlist fra <a href="http://www.audioscrobbler.com/">AudioScrobbler</a>, og mine links fra <a href="http://del.icio.us/" title="Social
Bookmarks">del.icio.us</a> kan ses i kolonnonen til h�jre, mens mine
billeder fra <a href="http://flickr.com/">flickr</a> og <a
href="http://23hq.dk/">23</a> kan ses yderst til
h�jre.
            Playlist og links er bragt til veje vha. <a href="http://magpierss.sf.net/">MagpieRSS</a>, en yderst anvendelig
            RSS-parser i <abbr title="Hypertext Pre Processing">PHP</abbr>.</p>
	      	<p>For at f� dine <a href="http://www.audioscrobbler.com/">AudioScrobbler</a>-data vist p� denne m�de kan du
            bruge <a href="http://fuddland.org.uk/archives/2004/04/27/audioscrobbler.php">dette eksempel</a>, det er det jeg
            har brugt. Jeg kan ikke finde den HowTo jeg brugte for at lave min del.icio.us-liste, men en tur p� <a
            href="http://www.google.com/search?q=del.icio.us%20magpierss">Google</a> burde give en del forslag.</p>
            <p>Billederne fra <a href="http://www.flickr.com">flickr</a>
og <a href="http://www.23hq.dk">23</a>, er bragt til veje af dem selv,
ved hj�lp af deres badge-service.</p>
	      	
	      	<h1>V�rkt�jer</h1>
          <p>Jeg skriver koden i <a href="http://macromates.com/"
title="Licens #32">TextMate</a> i samarbejde med <a
href="http://www.jwwalker.com/pages/autopairs.html">AutoPairs</a>, og
bruger <a href="http://cyberduck.ch/" title="GUI SFTP, FTP klient til
Mac OS X">Cyberduck</a> til at transmittere filerne til mit <a
href="http://www.dreamhost.com/rewards.cgi?voss">webhotel hos
Dreamhost</a>.</p>
	      </div>
   	   </div>
     </div>
     <?php
     @include('incs/sidebars.inc.php');
