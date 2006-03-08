			<h1 style="padding-top:7px;padding-bottom: 10px;">&raquo; RSS-feeds</h1>
			<ul>
				<li><a href="/rss/entries" title="RSS-feed af indlæg">Indlæg</a></li>
				<li><a href="/rss/comments" title="RSS-feed af kommentarer">Kommentarer</a></li>
			</ul>
	      <?=display_archive_months(); ?>
			<select id="linkout" onchange="document.location=options[selectedIndex].value;">
				<option>Blogrulle (med dip)</option>
				<option value="http://blogbot.dk/">blogbot</option>
				<option>---------------</option>
				<option value="http://www.abekat.net/">abekat</option>
				<option value="http://aggemam.dk/">aggemam</option>
				<option value="http://www.dashes.com/anil/">Anil Dash</option>
				<option value="http://www.askbjoernhansen.com/">askbjoernhansen</option>
				<option value="http://www.bering-express.dk/">bering-express</option>
				<option value="http://www.biplog.com/">bIPlog</option>
				<option value="http://blangstrup.org">blangstrup</option>
				<option value="http://www.bootstrapping.net/" title="Thomas Madsen-Mygdal">bootstrapping</option>
				<option value="http://xoc.dk/">Camillog</option>
				<option value="http://dalager.com/weblog">dalager</option>
				<option value="http://daringfireball.net/">daringfireball</option>
				<option value="http://dave.dk/">dot dave</option>
				<option value="http://defectiveyeti.com/">defective yeti</option>
				<option value="http://www.wasab.dk/morten/eksponering/">Eksponering</option>
				<option value="http://www.sparkpod.com/froeken.andersen">Frøken Andersen</option>
				<option value="http://www.jdreng.dk/">jdreng</option>
				<option value="http://jonaskochbentzen.com/">jonaskochbentzen</option>
				<option value="http://kaboom.dk/">kaboom</option>
				<option value="http://www.theprint.dk/kammeret/">Kammeret</option>
				<option value="http://www.kittenmoon.com/">kittenmoon</option>
				<option value="http://www.lasserimmer.com/">lasserimmer</option>
				<option value="http://www.corante.com/many/">Many-to-Many</option>
				<option value="http://nedrig.geekworld.org/">Nedrig humlebi</option>
				<option value="http://blog.nufidelity.dk/">nufidelity</option>
				<option value="http://oschlag.dk/weblog/">oschlag</option>
				<option value="http://rumskib.blogspot.com/">PRF</option>
				<option value="http://plokblog.dk/">plokblog</option>
				<option value="http://blog.reippuert.dk/">reippuert</option>
				<option value="http://olekjeldhansen.com/archives/category/roys-container">Roy's container</option>
				<option value="http://www.solitude.dk/">solitude</option>
				<option value="http://www.stopdesign.com/">stopdesign</option>
				<option value="http://weblogs.mozillazine.org/hyatt/">Surfin' Safari</option>
				<option value="http://www.blog.soender.com/">sÃ¸nder</option>
				<option value="http://tantologi.dk/">tantologi</option>
				<option value="http://vedana.net/">vedana</option>
				<option value="http://vesterblog.dk/">vesterblog</option>
				<option value="http://vetran.dk/">vetran</option>
				<option value="http://webmercial.dk/">webmercial 2.0</option>
			<option value="http://wulffmorgenthaler.com/">wulffmorgenthaler</option>
			</select>
				<?php
					@include($_SERVER['DOCUMENT_ROOT'].'/incs/scrobbler.inc.php');
				?>


           <?php
          #    @include($_SERVER['DOCUMENT_ROOT'].'/incs/waxincs.inc.php');
           ?>
<script type="text/javascript"><!--
google_ad_client = "pub-8076874108537450";
google_ad_width = 125;
google_ad_height = 125;
google_ad_format = "125x125_as";
google_ad_type = "text";
google_ad_channel ="";
google_color_border = "cccccc";
google_color_bg = "ffffff";
google_color_link = "000000";
google_color_url = "666666";
google_color_text = "333333";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
		<h1 style="padding-top: 10px;padding-bottom: 10px;">&raquo; voss/sidedish [<a title="via del.icio.us/voss/sidedish/" href="/io/http://del.icio.us/voss/sidedish">#</a>]</h1>
          <ul>
	   <?php
			// require_once "rss_fetch.inc"; 
			// change to reflect path of rss_fetch.inc
			$yummy = fetch_rss("http://del.icio.us/rss/voss/sidedish");
			// Turn on Magpie's caching function
			define('MAGPIE_CACHE_ON',1);

			$maxitems = 10;

			$yummyitems = array_slice($yummy->items, 0, $maxitems);

			foreach ($yummyitems as $yummyitem)
			{
			   print '<li>';
			   print '<a href="';
			   print htmlspecialchars($yummyitem['link']);
			   print '" title="'.htmlspecialchars($yummyitem["description"]).'">';
			   print htmlspecialchars($yummyitem['title']);
#			   print '</a>';
         print '</a> - '.htmlspecialchars($yummyitem["description"]);
			   print '</li>';
			   print "\n\t\t";
			}
      ?>
 			</ul>
				<h1 style="padding-top: 10px;padding-bottom: 10px;">&raquo; tags/popular</h1>
	   		<ul>
			   <?php
	         // require_once "rss_fetch.inc"; 
	         // change to reflect path of rss_fetch.inc
	         $yummy = fetch_rss("http://del.icio.us/rss/popular/");
				// Turn on Magpie's caching function
				define('MAGPIE_CACHE_ON',1);

	         $maxitems = 10;

	         $yummyitems = array_slice($yummy->items, 0, $maxitems);

	         foreach ($yummyitems as $yummyitem)
	         {
	            print '<li>';
	            print '<a href="';
	            print htmlspecialchars($yummyitem['link']);
	            print '" title="'.htmlspecialchars($yummyitem["description"]).'">';
	            print htmlspecialchars($yummyitem['title']);
	            print '</a>';
	            print '</li>';
	            print "\n";
	         }
		      ?>
   			</ul>
</body>
</html>