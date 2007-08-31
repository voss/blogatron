		<div class="unit">
    <p class="bio"><img src="/img/buddy_ikon_cropped_100x100.png" style="float:left;
border: 1px solid #555; padding: 3px; margin-right: 5px;" alt="Bio
picture, taken by Rasmus Rasmussen" title="Me, through the lens of
Rasmus Rasmussen" /><a href="http://verture.net/">verture.net</a> is the personal website of me, Jonas Voss, and this is my blog. I've lived in Dublin, Ireland since 2005, where I work for <a href="http://google.ie/">Google</a>. I was born and bred in Copenhagen, Denmark. I write about anything that comes to mind. Really.<br />You can send me an <a href="/contact" title="To the contact form">email &rArr;</a></p>

<?php
/*
You can reach me at <script type="text/javascript" language="javascript">
<!--
// Email obfuscator script 2.1 by Tim Williams, University of Arizona
// Random encryption key feature by Andrew Moulden, Site Engineering Ltd
// This code is freeware provided these four comment lines remain intact
// A wizard to generate this code is at http://www.jottings.com/obfuscator/
{ coded = "AgfeI@8WOxiOW.fWx"
  key = "4EIC2p53i8jQhTJOemRnHK9DUGzAZ7yNtW0ofFLPBdkXV6MsYxcbguvq1Swlra"
  shift=coded.length
  link=""
  for (i=0; i<coded.length; i++) {
    if (key.indexOf(coded.charAt(i))==-1) {
      ltr = coded.charAt(i)
      link += (ltr)
    }
    else {     
      ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length
      link += (key.charAt(ltr))
    }
  }
document.write("<a href='mailto:"+link+"'>jonas at verture dot net</a>")
}
//-->
</script><noscript>Sorry, you need Javascript on to email me</noscript>.</p>
*/
?>
			<ul style="padding-top:0;margin-top:0;">
				<li><img src="/img/rsssmall.png" alt="RSS ikon" class="sidebaricon" /><a href="http://feeds.feedburner.com/verture" title="RSS-feed af indlæg">Entries</a></li>
				<li><img src="/img/rsssmall.png" alt="RSS ikon" class="sidebaricon" /><a href="http://feeds.feedburner.com/verturekommentarer" title="RSS-feed af kommentarer">Comments</a></li>
        <li><img src="/img/23hq-favicon.png" alt="Images at 23" class="sidebaricon" /><a href="/io/http://23hq.com/voss">Images at 23</a></li>
        <li><img src="/img/flickr_favicon.png" alt="Images at flickr" class="sidebaricon" /><a href="/io/http://www.flickr.com/photos/voss/">Images at flickr</a></li>
		    <li><img src="/img/del.icio.us-favicon.png" alt="del.icio.us logo" class="sidebaricon" /><a href="/io/http://del.icio.us/voss">del.icio.us braindump</a></li>
        <li><img src="/img/last.fm_favicon.png" alt="last.fm logo" class="sidebaricon" /><a href="/io/http://last.fm/user/bobbybonzai">Music at last.fm</a></li>
			<li id="search">
				<?php @include('incs/menu.inc');?>
			</li>
			</ul>
		</div>
		<div class="unit">
			<h2 title="10 tilfældige jeg læser" style="padding-top:7px;padding-bottom:0px;">&raquo; Link love</h2>
			<ul>
				<?php printLinkroll(10); ?>
			</ul>
		</div>
		<div id="readerunit">
			<script type="text/javascript" src="http://www.google.com/reader/ui/publisher.js"></script>
<script type="text/javascript" src="http://www.google.com/reader/public/javascript/user/17963144626664830161/label/sidedish?n=5&amp;callback=GRC_p(%7Bc%3A'-'%2Ct%3A'Sidedish'%2Cs%3A'true'%7D)%3Bnew%20GRC"></script>
		</div>
		<div id="readerunit">
			<script type="text/javascript" src="http://www.google.com/reader/ui/publisher.js"></script>
			<script type="text/javascript" src="http://www.google.com/reader/public/javascript/user/17963144626664830161/label/recenttracks?n=5&amp;callback=GRC_p(%7Bc%3A%22-%22%2Ct%3A%22Recent%20tracks%22%2Cs%3A%22false%22%7D)%3Bnew%20GRC"></script>
		</div>

		<div class="unit">
			<h2 style="padding-top:7px; padding-bottom: 7px;">&raquo; Archives</h2>
			<?php display_archive_months(); ?>
		</div>

</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-59591-1";
urchinTracker();
</script>
