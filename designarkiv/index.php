<?php
# Include config-file:
@include('/home/voss/blog/incs/config.inc.php');
@include('/home/voss/blog/incs/db.inc.php');
@include('/home/voss/blog/incs/functions.inc.php');
@include('/home/voss/blog/incs/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="dk" >
<head>
   <title>. verture.net | designarkiv .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rssfeed.php" />
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://blog.verture.net/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://blog.verture.net/doegnrapport.php" />
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
               <h1>Designarkiv</h1>
               <p>verture.net har haft en del forskellige udseender igennem tiden, og de er magasineret p� denne side. Jeg har prim�rt benyttet <a href="http://archive.org/">archive.org</a> til at finde de gamle designs frem, da jeg ikke tog backup af de helt tidlige designs.</p>
               <p>Links til indl�g og kommentarer p� de nedenst�ende sider er i bedste fald uvirksomme, eller peger p� en 404, s� er du advaret.</p>
               <ol>
                  <li><a href="jan_2002/proper.gif">Den tidlige gr�</a> (januar, 2002)<br />
                  Mit allerf�rste udseende, gr�t og r�dt. Og en anelse kedeligt. Linket peger p� et screenshot af siden, da archive.org ikke havde den arkiveret.</li>
                  <li><a href="maj_2002/">Gr�t og bl�t</a> (maj, 2002)<br />
                  Tilf�jelsen af en styleswitcher peppede det gr� lidt op.</li>
                  <li><a href="nov_2002/">S� er der kaffe</a> (november, 2002)<br />
                  K�rlighed til kaffe inspirerede dette design. Den heftige brug af CSS positionering, og dertilh�rende browsersniffer til at servere et fordummet CSS-ark til browsere der ikke kunne kapere det, gjorde den temmelig besv�rlig at vedligeholde.</li>
                  <li><a href="april_2003/">Ubudne g�ster</a> (april, 2003)<br />
                  I slutningen af marts 2003 blev min webhost hacket, og alt forsvandt. En interimistisk side kom op imens jeg slikkede s�rene, og gik igang med at skrive mit eget blogv�rkt�j.</li>
                  <li><a href="sept_2003/">In your face Flanders</a> (september, 2003)<br />
                  Et simpelt udseende, til min simple hjemmelavede backend.</li>
                  <li><a href="nov_2003/">Efter�rslook</a> (november, 2003)<br />
                  Efter�r, ikke s� meget at tilf�je til det.</li>
                  <li><a href="februar_2004">Vinter</a> (februar, 2004)<br />
                  Hvidt og bl�t vinterlook.</li>
						<li><a href="sept_2004">Simpelt og gr�nt</a> (september, 2004)<br />
                  Hvidt, bl�t og simpelt.</li>
               </ol>
            </div>
            </div>
         </div>
      <?php
         @include('/home/voss/blog/incs/sidebars.inc.php');
      ?>