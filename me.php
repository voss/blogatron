<span class="dull">/* CSS for Jonas Voss.
Orignal idea by Morten [<a href="http://mockingbird.dk/">mockingbird.dk</a>] */</span>

<span class="selector">#jonas.home</span> {
   position: dublin 4, ireland;
   elevation: 3rd floor;
   content: 4 rooms, washing machine, wifi, 2 flatmates;
}

<span class="selector">#jonas.home:before</span> {
   position: copenhagen k, denmark;
   elevation: 1st floor;
   content: 2 rooms;
}

<span class="selector">#jonas.head</span> {
   empty-cells; yes;
   overflow: often;
   voice-family: !important;
   font-size: normal;
   border-top: solid thick darkbrown;
   float: whenever i can;
   background-image: url(<a href="/img/jonas.head.jpg">jonas.head.jpg</a>);
}

<span class="selector">#jonas.study</span> {
   position: <a href="http://itu.dk/">itu</a> copenhagen;
   direction: m.sc. information technology;
   content: design, communication and media;
}

<span class="selector">#jonas.study:before</span> {
   position: university of copenhagen;
   direction: b.sc. human geography;
   content: developmental geography;
   color: shifty;
}

<span class="selector">#jonas.about</span> {
   content: url(<a href="/241103/100_ting">100 ting</a>), url(<a href="/101203/interview_meme">interview meme</a>);
}

<span class="selector">#jonas.contact</span> {
   display:
</pre>
<?php
if(isset($_POST['submit'])) :
	if(isset($_POST['addy']) && ($_POST['msg'] != '' && $_POST['humanoid'] == 'Æ')) 
	{
		$sender = $_POST['sender'];
		$addy = $_POST['addy'];
		$msg = $_POST['msg'];
		$valid_email = "^[a-z0-9_\.-]+([@]{1})[a-z0-9_\.-]+[\.][a-z0-9_\.-]+$";
		if(eregi($valid_email, $addy) == false)
		{
			print "<h1>Ups</h1><p>Ugyldig email, prøv <a href=\"javascript:history.back(-1)\">igen</a>.</p>\n\n";
		}
		else
		{
			$msg .= "\n\nAfsender: {$sender}\n\n";
			$msg .= "{$_SERVER['HTTP_USER_AGENT']}\n\n";
			$msg .= "{$_SERVER['REMOTE_ADDR']}\n\n";
			$msg .= "{$_SERVER['REMOTE_HOST']}";
			# $msg = utf8_encode($msg);
			$msg = stripslashes($msg);
			$subject = "Besked fra gæst på verture.net";
			$subject = quoted_printable_decode($subject);
			$headers = "From: $addy\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\n";
			$headers .= "Content-Transfer-Encoding: quoted-printable";
			if(!mail("kontakt@verture.net",$subject,$msg,$headers))
			{
				print "<p id=\"mail\">Der er sket en fejl, en forfærdelig en af slagsen. Din mail kan af en eller anden teknisk årsag ikke blive sendt. Hvis du brokker dig højlydt til <a href=\"mailto:jonas.voss@gmail.com\">mig</a>, vil jeg gøre alt for at fikse det.</p>";
			}
			else
			{
				print "<h1 id=\"mail\">Tak for din mail.</h1>
				<p>Jeg vil vende tilbage til dig hurtigst muligt.</p>
				<p>
					<a href=\".\">Til forsiden</a>
				</p>";
			# exit();
			}
		}
	}
	else
	{
		print "<h1 id=\"mail\">Ups</h1>
		<p>Email, Besked og Æ-feltet skal udfyldes. Prøv <a href=\"javascript:history.back(-1)\">igen</a>
		</p>";
	}
else:
print $mail_form;
endif;
?>
<pre>
;
}
<span class="dull">/* End CSS. */</span>
</pre>
