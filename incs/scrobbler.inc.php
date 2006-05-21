<?php
// ************************************************
// Set your username
$username = 'bobbybonzai';

// Alter the next line to reflect the location of rss_fetch.inc
@require_once($_SERVER['DOCUMENT_ROOT']."/incs/magpie/rss_fetch.inc");


// Set the location of the cached feed [dir needs to be writable]
define('MAGPIE_CACHE_DIR', $_SERVER['DOCUMENT_ROOT']."/incs/magpie/cache");

// Cache the RSS feed for 10 minutes [600 seconds]
// Change to whatever you like
define('MAGPIE_CACHE_AGE', 1800);

// Uncomment this next line to output debugging information
// define('MAGPIE_DEBUG',1);
// End of setup
// ************************************************

// This function removes leading and trailing spaces and newlines
function cleanup($string){
$cleaned_text = preg_replace("/^\s/", "", $string);
$cleaned_text = preg_replace("/\s$/", "", $cleaned_text);
$cleaned_text = preg_replace("/\n$/s", "", $cleaned_text);
return $cleaned_text;
} // End of cleanup function

// Turn on Magpie's caching function
define('MAGPIE_CACHE_ON',1);

print '<h1 style="padding-top:10px;padding-bottom: 10px;">&raquo; Ear love [<a title="Via min profil hos Last.fm" href="/io/http://www.last.fm/user/bobbybonzai/">#</a>]</h1>';

if (!$feed = fetch_rss("http://ws.audioscrobbler.com/rdf/history/$username")) {
        echo "<p>Audioscrobbler har vist lidt problemer, så du kan ikke
        se hvad jeg hører lige nu.</p>";
}
else {
        $items = array_slice($feed->items, 0);

        echo "\n<ul>\n";

        foreach ($items as $item) {

                $artist = $item['dc']['artist_creator_title'];
                $title = $item['dc']['title'];
                $album = $item['dc']['albumlist_album_title'];

                // Clean up text
                $artist = cleanup($artist);
                $title = cleanup($title);
                $album = cleanup($album);
                
                // Added for linking the artist to a AMG-search:
                $linkartist = str_replace(' ', '|', $artist); 

                if ($title != "") {
                        echo "\t<li><strong>".htmlspecialchars($title)."</strong>\n";
                } else {
                        echo "\t<li>Ukendt titel.</li>\n";
                }

                if ($artist != "") {
                        echo "\t\t<br />af <em><a href='http://www.allmusic.com/cg/amg.dll?p=amg&amp;sql=1:".$linkartist."' title='Søg efter ".htmlspecialchars($artist)." på All Music Guide'>".htmlspecialchars($artist)."</a></em></li>\n";
                } else {
                        echo "\t\t<li>Ukendt kunstner.</li>\n";
                }

# Commenting out the album information, as it was usually faulty anyway.
#					if ($album != "") {
#                        echo "\t\t<br />fra '".htmlspecialchars($album)."'</li>\n";
#                } else {
#                        echo "\t\t</li>\n";
#               }
         }
         echo "</ul>\n";
}
?>
