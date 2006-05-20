<div id="middle">
      <div id="mcontent">
		<div class="unit">
			<ul>
				<li><img src="/img/rsssmall.png" alt="RSS ikon" style="vertical-align: middle; padding-right: 3px; border:0"/><a href="/rss/entries" title="RSS-feed af indlæg">Indlæg</a></li>
				<li><img src="/img/rsssmall.png" alt="RSS ikon" style="vertical-align: middle; padding-right: 3px; border:0"/><a href="/rss/comments" title="RSS-feed af kommentarer">Kommentarer</a></li>
			</ul>
		</div>
		<div class="unit">
			<h1 title="10 tilfældige jeg læser" style="padding-top:7px;padding-bottom: 10px;">&raquo; et klik væk</h1>
			<ul>
			<?php printLinkroll(10); ?>
			</ul>
		</div>
				<?php
					@include($_SERVER['DOCUMENT_ROOT'].'/incs/scrobbler.inc.php');
				?>

<div style="padding-top: 5px; padding-left:10px;">
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
</div>
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
        <div class="unit">
			<h1 style="padding-bottom: 7px;">&raquo; Arkiv</h1>
			<?=display_archive_months(); ?>
        </div>
	</div>

</div>
      <div id="right">
         <div id="rcontent">
        <div id="flickrimg">
      		<h1>&raquo; Moblog [<a title="Via Flickr Pro, doneret af Eric" href="/io/http://www.flickr.com/photos/voss/">#</a>]</h1>
<div id="newFlickr" style="color: #950; text-align: center; font-size:xx-small">Indlæser billeder fra Flickr...</div>
</div>
<div>
<h1 style="padding-top:10px;">&raquo; 23 [<a href="/io/http://23hq.dk/voss">#</a>]</h1>
<div id="new23" style="color: #950; text-align: center; font-size:xx-small">Indlæser billeder fra 23...</div>
</div>
<?php
/*					<script type="text/javascript">
		         <!-- 
		         flickr_badge_background_color = "";
		         flickr_badge_border = "";
		         flickr_badge_width = "120px";
		         flickr_badge_text_font = "11px Arial, Helvetica, Sans serif";
		         flickr_badge_image_border = "1px solid #000000";
		         flickr_badge_link_color = "";
		         //-->
		         </script>
		         <script type="text/javascript" src="http://www.flickr.com/badge_code.gne?nsid=42801574@N00&amp;count=10&amp;display=random&amp;name=0&amp;size=square"></script>
		
# Rejsebilleder:
http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=random&amp;size=s&amp;layout=v&amp;source=user_set&amp;user=42801574%40N00&amp;set=342608&amp;context=in%2Fset-342608%2F


# another script:
http://www.flickr.com/badge_code_v2.gne?show_name=1&count=3&display=random&size=t&layout=v&source=user&user=42801574%40N00"
*/
?>
      </div>
       <div style="clear: both;height: 0px">&nbsp;</div>
      </div>
      <div style="clear: both;height: 0px">&nbsp;</div>
      </div>
<div id="lazyFlickr" style="display:none">
<!-- Start of Flickr Badge -->
<table style="padding: 4px 25px; margin-top: 0;"
id="flickr_badge_uber_wrapper" cellpadding="0" cellspacing="0"
border="0"><tr><td><table cellpadding="0" cellspacing="0" border="0" id="flickr_badge_wrapper"><tr><td>
<script type="text/javascript"
src="http://www.flickr.com/badge_code_v2.gne?count=3&amp;display=latest&amp;size=s&amp;layout=v&amp;source=user_tag&amp;user=42801574%40N00&amp;tag=camphone"></script>
<?php
/*
Old flickr-string: count=5&amp;display=latest&amp;size=s&amp;layout=v&amp;source=user&amp;user=42801574%40N00
*/
?>
</td></tr></table>
</td></tr></table>
<!-- End of Flickr Badge -->
</div>
<script type="text/javascript">moveFlickr();</script>

<div id="lazy23" style="display:none">
<div id="twentythree">
<?php
/*<script type="text/javascript" src="http://23hq.dk/resources/um-style/general.js"></script>
<script type="text/javascript" src="http://23hq.dk/voss/script/data.js?mode=basic&amp;limit=5&amp;sort=random"></script>
<script type="text/javascript" src="http://23hq.dk/voss/script/functions.js"></script>
<script type="text/javascript">
    display23['linkToAccount'] = 0;
    display23['size'] = 'quad50';
    display23['layout'] = 'vertical';
    display23['backgroundColor'] = '';
    display23['borderColor'] = '';
    display23['photoinfoTaken'] = 1;
    display23['photoinfoTags'] = 0;
    display23['photoinfoAlbums'] = 0;
    display23['photoinfoWords'] = 1;

    writePhotos();
</script>
*/
?>
<script type="text/javascript"
src="http://www.23hq.com/resources/um-style/general.js"></script>
<script type="text/javascript"
src="http://www.23hq.com/voss/script/data.js?mode=basic&tags=d50&selection=tags&limit=3&sort=taken"></script>
<script type="text/javascript"
src="http://www.23hq.com/voss/script/functions.js"></script>
<script>
    display23['linkToAccount'] = 0;
    display23['size'] = 'quad100';
    display23['layout'] = 'vertical';
    display23['backgroundColor'] = '#FFFFFF';
    display23['borderColor'] = '';
    display23['photoinfoTaken'] = 1;
    display23['photoinfoTags'] = 0;
    display23['photoinfoAlbums'] = 0;
    display23['photoinfoWords'] = 1;

    writePhotos();
</script>
</div>
<script type="text/javascript">move23();</script>
</div>
</body>
</html>
