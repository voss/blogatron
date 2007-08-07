<?php

# file: ac.php
# Adds a comment to the entry.

# Includes:
@include('incs/config.inc.php');
@include('incs/db.inc.php');
@include('incs/functions.inc.php');
@include('incs/display_functions.inc.php');
@include('incs/includes.inc.php');

if(isset($_POST['eid']) && isset($_POST['c_submit'])) {
	if(empty($_POST['c_text']) || empty($_POST['c_author']) || $_POST['c_humanoid'] != "9") {
		print_header(". {$blog_title} | fejl .","stil.css", $domain_name, $description, $key_words, $dc_title, $install_path);
		?>
			<div id="container">
			   <div id="top">
			      <div id="banner2">
			      <div style="float: right"></div>
			      </div>
			   <div id="banner">
			      <div id="menu">
		      		<ul>
							<li>
								<a href="/" title="weblog">Blog</a>
							</li>
							<li>
								<a href="/kontakt/" title="Hvem står bag?">Info // Kontakt</a>
							</li>
							<li>
								<a href="/services/" title="Public Service">Services</a>
							</li>
							<li>
								<a href="http://wax.verture.net/" title="Plader og CD'ere">Plader</a>
							</li>
							<li>
								<a href="http://pics.verture.net/" title="Glimt">Galleri</a>
							</li>
							<li>
								<a href="/kolofon/" title="Tech spec">Kolofon</a>
							</li>
							<li>
								<form style="display:inline;" action="/do_search.php" method="get" id="search" onsubmit="if(this.q.value=='Skriv søgeord' || this.q.value=='') { alert('Du skal skrive et gyldigt søgeord først.'); this.q.select(); return false;} else { this.submit();}">
									<div style="display:inline; padding-left: 30%;">
							      <input type="text" name="q" value="Skriv søgeord" onclick="this.select()" style="width: 100px;" />
							   </div>
									   </form>
							</li>
						</ul>
					</div>
				</div>
		      </div>
			   <div id="left">
			      <div id="lcontent">
		<h1>Fejl</h1>
		<p>Du glemte at udfylde et af felterne.<br />Gå <a href="javascript:history.back(-1)">tilbage</a> og udfyld det manglende felt</p>  	      
		   	   </div>
		     </div>
		     <div id="middle">
		        <div id="mcontent">
		           <div class="unit">
				      <?=display_archive_months(); ?>
				</div>
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

		         <h1 style="padding-top:10px;">Har sidst hørt</h1>   
		         <p style="padding-bottom: 5px; margin-top: 0;">via <a href="http://www.audioscrobbler.com/user/bobbybonzai">Audioscrobbler</a>
		         </p>
		            <?=@include($_SERVER['DOCUMENT_ROOT']."/incs/scrobbler.inc.php");?>
		        </div>
		      </div>
		      <div id="right">
		         <div id="rcontent">
		            <h1>del.icio.us</h1>
		            <ul>
				   <?php
		         // require_once "rss_fetch.inc"; 
		         // change to reflect path of rss_fetch.inc
		         $yummy = fetch_rss("http://del.icio.us/rss/voss");

		         $maxitems = 20;

		         $yummyitems = array_slice($yummy->items, 0, $maxitems);

		         foreach ($yummyitems as $yummyitem)
		         {
		            print '<li>';
		            print '<a href="';
		            print $yummyitem['link'];
		            print '" title="'.$yummyitem["description"].'">';
		            print $yummyitem['title'];
		            print '</a>';
		            print '</li>';
		            print "\n";
		         }
		      ?>
		      </ul>
		      </div>
		      </div>
		      <div style="clear: both;"></div>
		      </div>
			</body>
		</html>
		<?php
	} else {
		$c_author = $_POST['c_author'];
		$c_text = $_POST['c_text'];
		$c_email = $_POST['c_email'];
		$c_url = $_POST['c_url'];
		$c_ip = $_SERVER['REMOTE_ADDR'];
		$eid = $_POST['eid'];
		$comment_url = $_POST['comment_url'];
		$etitle = stripslashes($_POST['etitle']);
		$c_msg = "Browser: {$_SERVER['HTTP_USER_AGENT']}\n";
		$c_msg .= "IP:     {$c_ip}\n";
		$c_msg .= "Navn:   {$c_author}\n";
		$c_msg .= "email:  {$c_email}\n";
		$c_msg .= "URL:    {$c_url}\n\n";
		$c_msg .= "------------  || Besked start ||  ------------\n\n";
		$c_msg .= stripslashes($c_text)."\n\n";
		$c_msg .= "------------  || Besked slut ||  ------------\n\n";
		$c_msg .= "URL til indlægget:	{$comment_url}#c\n\n";
		$c_msg .= "-- \nDrevet af Blogatron og PHP v".phpversion();
		$subject = "[{$blog_title}] Kommentar til '{$etitle}'";
		# $c_msg = strip_tags($c_msg, '<a>');
		
		# Initiate mail-settings:
		$headers = "From: $c_author <$c_email>\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
		$headers .= "Content-Transfer-Encoding: quoted-printable";
		mail($comments_address,$subject,$c_msg,$headers);
		if($_POST['bakecookie'] == 'on') {
			setcookie("blogatron_author","{$c_author}", time()+3600*24*365, "/");
			setcookie("blogatron_email","{$c_email}", time()+3600*24*365, "/");
			setcookie("blogatron_url","{$c_url}", time()+3600*24*365, "/");
		} 
		if($_POST['bakecookie'] == 'off') {
			setcookie("blogatron_author","", time()-3600*24, "/");
			setcookie("blogatron_email","", time()-3600*24, "/");
			setcookie("blogatron_url","", time()-3600*24, "/");
		}
		$c_text = strip_tags($c_text, '<a><b><em><q><del>');
		$c_author = format_comment($c_author);
		$c_email = format_email($c_email);
		$c_url = format_url($c_url);				
		$date = time() + ($offset * 3600);
		$sql = "
			INSERT INTO comments set 
			c_author = ('{$c_author}'),
			c_text = ('{$c_text}'),
			c_email = ('{$c_email}'),
			c_url = ('{$c_url}'),
			c_ip = ('{$c_ip}'),
			date = ('$date'),
			eid = ('{$eid}')";
			if(!$result = @mysql_query($sql)) {
				print "<p>Der skete en fejl: ".mysql_error()."</p>";
				print "<p>{$sql}</p>";
			}
		header("Location: {$comment_url}#c");
	}
	
} else {
	print_header(". {$blog_title} | kukabuxilah .","stil.css", $domain_name, $description, $key_words, $dc_title, $install_path);
	?>
		<div id="container">
		   <div id="top">
		      <div id="banner2">
		      <div style="float: right"></div>
		      </div>
		   <div id="banner">
		      <div id="menu">
	      		<ul>
						<li>
							<a href="/" title="weblog">Blog</a>
						</li>
						<li>
							<a href="/kontakt/" title="Hvem står bag?">Info // Kontakt</a>
						</li>
						<li>
							<a href="/services/" title="Public Service">Services</a>
						</li>
						<li>
							<a href="http://wax.verture.net/" title="Plader og CD'ere">Plader</a>
						</li>
						<li>
							<a href="http://pics.verture.net/" title="Glimt">Galleri</a>
						</li>
						<li>
							<a href="/kolofon/" title="Tech spec">Kolofon</a>
						</li>
						<li>
							<form style="display:inline;" action="/do_search.php" method="get" id="search" onsubmit="if(this.q.value=='Skriv søgeord' || this.q.value=='') { alert('Du skal skrive et gyldigt søgeord først.'); this.q.select(); return false;} else { this.submit();}">
								<div style="display:inline; padding-left: 30%;">
						      <input type="text" name="q" value="Skriv søgeord" onclick="this.select()" style="width: 100px;" />
						   </div>
								   </form>
						</li>
					</ul>
				</div>
			</div>
	      </div>
		   <div id="left">
		      <div id="lcontent">
            	<p>Hello world</p>  	      
	   	   </div>
	     </div>
	     <div id="middle">
	        <div id="mcontent">
	           <div class="unit">
			      <?=display_archive_months(); ?>
			</div>
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

	         <h1 style="padding-top:10px;">Har sidst hørt</h1>   
	         <p style="padding-bottom: 5px; margin-top: 0;">via <a href="http://www.audioscrobbler.com/user/bobbybonzai">Audioscrobbler</a>
	         </p>
	            <?=@include($_SERVER['DOCUMENT_ROOT']."/incs/scrobbler.inc.php");?>
	        </div>
	      </div>
	      <div id="right">
	         <div id="rcontent">
	            <h1>del.icio.us</h1>
	            <ul>
			   <?php
	         // require_once "rss_fetch.inc"; 
	         // change to reflect path of rss_fetch.inc
	         $yummy = fetch_rss("http://del.icio.us/rss/voss");

	         $maxitems = 20;

	         $yummyitems = array_slice($yummy->items, 0, $maxitems);

	         foreach ($yummyitems as $yummyitem)
	         {
	            print '<li>';
	            print '<a href="';
	            print $yummyitem['link'];
	            print '" title="'.$yummyitem["description"].'">';
	            print $yummyitem['title'];
	            print '</a>';
	            print '</li>';
	            print "\n";
	         }
	      ?>
	      </ul>
	      </div>
	      </div>
	      <div style="clear: both;"></div>
	      </div>
		</body>
	</html>
<?php
}
?>
