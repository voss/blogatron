<?php
# Include config-file and functions:
@include_once('incs/config.inc.php');
@include_once('incs/db.inc.php');
@include_once('incs/functions.inc.php');
@include_once('incs/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>. <?=$blog_title;?> | services .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$install_path;?>/rss/entries" />
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <link rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport" href="http://blog.verture.net/doegnrapport.php" />
   <meta name="description" content="<?=$description;?>" />
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
	      <div class="entry" style="padding-bottom: 300px;">
	<h1>Services</h1>
	<p>Fra tid til anden slamkoder jeg et lille v�rkt�j som jeg skal bruge til et eller andet. M�ske kan de v�re til hj�lp for andre, og derfor har jeg lagt dem online her. Hvis du finder dem anvendelige er det herligt.</p>
	<ul id="services">
    <li><a href="/services/transmo/">Entitetstransmogriffer</a>.<br />
    �, � og � for folk p� farten. Oprindeligt lavet til <a href="http://kittenmoon.com/">Rasmus</a> da han tog til Spanien i for�ret 2002. <a href="http://snuf.dk/">Steffen</a>, <a href="http://www.bering-express.dk/">Christian</a> og <a href="http://www.mariebering.dk/">Marie</a> har ogs� fundet den anvendelig.</li>
    <li><a href="/services/b2s/">Bytes til sekunder</a>.<br />
    En service der giver en minimumstid for, hvor lang tid det vil tage at overf�re en fil af en bestemt st�rrelse over en forbindelse med en bestemt hastighed.</li>
    <li><a href="http://itu.dk/people/jcv/verture/doegnrapport.php" rel="alternate" type="application/rss+xml" title="K�benhavns Politis D�gnrapport">K�benhavns Politis D�gnrapport</a><br />
    Piratfeed af d�gnrapporten fra K�benhavns Politi, s� du kan holde
dig opdateret om underverdenens gang i K�benhavn (kr�ver en <a
href="http://blogspace.com/rss/readers" title="Udm�rket lille liste over
feed readers">feed reader</a>).</li>
	</ul>
	</div>
</div>
				</div>
<?php
     @include('incs/sidebars.inc.php');
     ?>
