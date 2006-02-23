	<div>
		<?php display_archive_months(); ?>
		<div class="unit" title="I tilfældig rækkefølge">
			<select id="linkout" onchange="document.location=options[selectedIndex].value;">
				<option>Blogrulle</option>
				<option value="http://www.abekat.net/">abekat</option>
        <option value="http://olsen.typepad.com/perspectif/">Perspectif</option>
				<option value="http://nedrig.geekworld.org/">Nedrig humlebi</option>
				<option value="http://blog.nufidelity.dk/">nufidelity</option>
				<option value="http://www.dashes.com/anil/">Anil Dash</option>
				<option value="http://www.lasserimmer.com/">lasserimmer.com</option>
				<option value="http://weblogs.mozillazine.org/hyatt/" title="Surfin' Safari">Surfin' Safari</option>
				<option value="http://vedana.net/">vedana.net</option>
				<option value="http://randises.dk/">randises.dk</option>
				<option value="http://kaboom.dk/">kaboom.dk</option>
				<option value="http://www.solitude.dk/">solitude.dk</option>
				<option value="http://blog.reippuert.dk/">reippuert.dk</option>
				<option value="http://tantologi.dk/">tantologi.dk</option>
				<option value="http://blangstrup.org">blangstrup.org</option>
				<option value="http://www.theprint.dk/kammeret/">theprint.dk</option>
				<option value="http://rumskib.blogspot.com/" title="Pavens Rumskibsfabrik">rumskib.blogspot.com</option>
				<option value="http://defectiveyeti.com/">defectiveyeti.com</option>
				<option value="http://www.kittenmoon.com/">kittenmoon.com</option>
				<option value="http://oschlag.dk/weblog/">oschlag.dk</option>
				<option value="http://daringfireball.net/">daringfireball.net</option>
				<option value="http://www.askbjoernhansen.com/">askbjoernhansen.com</option>
				<option value="http://www.jdreng.dk/">jdreng.dk</option>
				<option value="http://vesterblog.dk/">vesterblog.dk</option>
				<option value="http://dot.dave.dk/">dave.dk</option>
				<option value="http://plokblog.dk/">plokblog.dk</option>
				<option value="http://aggemam.dk/">aggemam.dk</option>
				<option value="http://understroem.dk/sixthedition/">understroem.dk</option>
				<option value="http://dalager.com/weblog">dalager.com</option>
				<option value="http://www.stopdesign.com/">stopdesign.com</option>
				<option value="http://blogbot.dk/">blogbot</option>
				<option value="http://metablog.dk">metablog</option>
			</select>
		</div>
<!--	<h1>The Buzz</h1>
		<div id="buzz">
		<script src="http://voss.buzznet.com/user/syndicate/?layout=vert&length=4" type="text/javascript"></script>
		</div>
-->
		<?php
		# <h1>del.icio.us</h1>
		#	$delicious = file_get_contents('http://del.icio.us/html/voss?count=5&tags=no&rssbutton=no&bullet=');
		#	print $delicious;
		?>
		<h1>Har sidst hørt</h1>
		<div class="unit">
		<?php
#      require_once($_SERVER['DOCUMENT_ROOT']."/incs/magpie/rss_fetch.inc");
      include($_SERVER['DOCUMENT_ROOT']."/incs/scrobbler.inc.php");
      ?>
      </div>
		<?php
		if($statistics == true) {
		?>
		<h1>Statistik</h1>
			<div class="unit">
				<ul>
					<?php @include($_SERVER['DOCUMENT_ROOT']."/incs/stats.inc.php"); ?>
				</ul>
			</div>
		<?php
		}
		?>
	   <h1>del.icio.us</h1>
		   <div class="unit">
		   <ul>
		   <?php
         // require_once "rss_fetch.inc"; 
         // change to reflect path of rss_fetch.inc
         $yummy = fetch_rss("http://del.icio.us/rss/voss");

         $maxitems = 5;

         $yummyitems = array_slice($yummy->items, 0, $maxitems);

         foreach ($yummyitems as $yummyitem)
         {
            print '<li>';
            print '<a href="';
            print $yummyitem['link'];
            print '" title="'.$yummyitem["description"].'">';
            print $yummyitem['title'];
            print '</a>';
/*            if (isset($yummyitem['description'])) 
            {
               print ': ';
               print $yummyitem['description'];
            }
*/
            print '</li>';
            print "\n";
         }
      ?>
      </ul>
      </div>

		<?php
		/*
		<h1>Senest hørt</h1>
			<div class="unit">
				<ul>
					<?php @include($_SERVER['DOCUMENT_ROOT']."/incs/trackinfo.txt"); ?>
				</ul>
			</div>
		<h1>Tidligere hørt</h1>
			<div class="unit">
				<ul>
					<?php @include($_SERVER['DOCUMENT_ROOT']."/incs/tracklist.txt"); ?>
				</ul>
				<p style="padding-top: 2px;">
					Tak til <a href="http://www.kung-foo.tv/itti.php" title="Kan du se hvad jeg hører?">Kung-Tunes</a>
				</p>
				<p>
				Min <a
        href="http://www.audioscrobbler.com/user/bobbybonzai/">Audioscrobbler-side</a> opdateres lidt oftere end ovenstående.
				</p>
			</div>
			
			<div style="text-align: center; padding-top: 20px; margin-left: -20px;">
				<a href="http://blogradio.dk/" title="Blogradio.dk - så er det sgu' fo' real!"><img src="http://blogradio.dk/spas/blogradio88x31.png" style="border:0;" alt="Blogradio.dk" /></a>
			</div>
		*/
		?>
	</div>
