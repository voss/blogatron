<?php
## Include config-file:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="da">
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
		<title>. verture.net &raquo; her skriver jeg .</title>
	</head>
	<body id="body404">
<div class="div404">
<!--
<p class="p404">
Siden du leder efter kan ikke frembringes p� den adresse du har indtastet:</p>
-->
<p class="puri"><?='http://'.$_SERVER[HTTP_HOST].$_SERVER['REQUEST_URI'];?></p>
<p class="p404">Der kan v�re forskellige �rsager til at ovenst�ende adresse ikke findes:
<ol>
<li>Du har indtastet en forkert adresse i din browser, eller fulgt et link fra et website der har skrevet adressen forkert.</li>
<li>Adressen fandtes en gang, men er blevet lavet om i et af mine mange fors�g p� at v�re fed med de fede, der har seje adresser der er menneskeligt l�selige.</li>
<li>Lige pr�cis det du s�ger er en af de ting der forsvandt i marts 2003, hvor alt her p� siderne blev slettet, og ikke alt er genoprettet.</li>
</ol></p>
<p class="p404">
Der er dog st�rst sandsynlighed for, at det er sidstn�vnte �rsag til at du er havnet her. Desv�rre.
</p>
<p class="p404">
Nu findes der s� den mulighed at du kan s�ge i indl�ggene p� min weblog ved at indtaste et s�geord i nedenst�ende formular, og hvem ved, m�ske er du heldig at finde det du s�ger.
</p>
<form style="text-align: center; padding-top: 15px; background: #eee; border: 1px solid #ddd; padding: 10px;" action="/do_search.php" method="get" onsubmit="if(this.q.value=='Skriv s�geord' || this.q.value=='') { alert('Du skal skrive et gyldigt s�geord f�rst.'); this.q.select(); return false;} else { this.submit();}"><div style="display:inline;"><input type="text" name="q" value="Skriv s�geord" onclick="this.select()" style="width: 100px;" /><input type="submit" value="S�g" /></div></form>
<p class="p404" style="text-align: center;">
Forsiden af min weblog findes her <a href="http://blog.verture.net/">blog.verture.net</a>
</p>
</div>
</body>
</html>
