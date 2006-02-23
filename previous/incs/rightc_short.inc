	<div>
		<?php # display_archive_months(); ?>
		<div class="unit" title="I tilfældig rækkefølge">
			<select id="linkout" onchange="document.location=options[selectedIndex].value;">
				<option>Blogrulle</option>
				<option value="http://www.dashes.com/anil/">Anil Dash</option>
				<option value="http://www.lasserimmer.com/">lasserimmer.com</option>
				<option value="http://vedana.net/">vedana.net</option>
				<option value="http://randises.dk/">randises.dk</option>
				<option value="http://kaboom.dk/">kaboom.dk</option>
				<option value="http://www.solitude.dk/">solitude.dk</option>
				<option value="http://blog.reippuert.dk/">reippuert.dk</option>
				<option value="http://tantologi.dk/">tantologi</option>
				<option value="http://blangstrup.org">blangstrup.org</option>
				<option value="http://www.theprint.dk/kammeret/">theprint.dk</option>
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
		<h1>del.icio.us</h1>
		<?php
			$delicious = file_get_contents('http://del.icio.us/html/voss?count=5&tags=no&rssbutton=no&bullet=');
			print $delicious;
		?>

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
	</div>