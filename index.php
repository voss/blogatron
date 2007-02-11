<?php
# Include config-file and functions:
@include_once('incs/config.inc.php');
@include_once('incs/db.inc.php');
@include_once('incs/functions.inc.php');
@include_once('incs/display_functions.inc.php');
setcookie("peek-a-boo","last_visit", time()+3600*24*365, "/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>. <?=strtolower($front_title[0]);?> | <?=$blog_title;?> .</title>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <script src="http://www.gvisit.com/record.php?sid=043c3d02563545754e66d6c8a9be2757" type="text/javascript"></script>
   <link rel="shortcut icon" href="<?=$install_path;?>/favicon.ico" type="image/x-icon" />
   <link rel="alternate" type="application/rss+xml" title="Indlæg" href="<?=$install_path;?>/rss/entries" />
   <link rel="alternate" type="application/rss+xml" title="Kommentarer" href="<?=$install_path;?>/rss/comments" />
   <link rel="alternate" type="application/rss+xml" title="Københavns Politis Døgnrapport" href="http://itu.dk/people/jcv/verture/doegnrapport.php" />
   <script type="text/javascript" src="<?=$install_path;?>/js/jsscripts.js"></script>
   <meta name="description" content="<?=$description;?>" />
   <meta name="keywords" content="jonas, jonas c. voss, weblog, københavn, dublin" />
   <meta name="ICBM" content="55.6773 , 12.5749" />
   <meta name="MSSmartTagsPreventParsing" content="true" />
   <style type="text/css" media="all">
   	@import "<?=$install_path;?>/stil.css";
   </style>
</head>
<body>
	<div id="wrapper">
		<h2>verture.net &mdash; nu i hvidt</h2>
		<div id="search">
			<?php @include('incs/menu.inc');?>
		</div>
	      <?php
			if(eregi("([0-9]{6})([/.]?)([-_.#!?a-z0-9]{0,15})", $_SERVER['REQUEST_URI']))
			{
				display_entry_from_url();
			}
			else
			{
				display_front_page('10');
			}
   		?>
			<div id="disclaimer">
			<p>Disclaimer: Alt der bliver skrevet her er et udtryk for min holdning, og ikke min arbejdsgivers.</p>
			</div>
	<div id="linkster">
     <?php
     @include('incs/sidebars.inc.php');
     ?>
	</div>
	<div id="footer"  style="clear: both; margin-top: 55px; background: darkgreen; color: white">
		        <div id="flickrimg">
      		<h1>&raquo; Moblog [<a title="Via Flickr Pro, doneret af Eric" href="/io/http://www.flickr.com/photos/voss/">#</a>]</h1>
<div id="newFlickr" style="color: #950; text-align: center; font-size:xx-small"><img src="/img/flickrfade.gif" alt="Flickr pictures" /></div>
</div>
<div>
<h1 style="padding-top:10px;">&raquo; Lense love [<a href="/io/http://23hq.dk/voss">#</a>]</h1>
<div id="new23" style="color: #950; text-align: center; font-size:xx-small"><img src="/img/23fade.gif" alt="23 pictures" /></div>
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
src="http://www.23hq.com/voss/script/data.js?mode=basic&amp;tags=d50&amp;selection=tags&amp;limit=3&amp;sort=uploaded"></script>
<script type="text/javascript"
src="http://www.23hq.com/voss/script/functions.js"></script>
<script type="text/javasxript">
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
</div>
