<?php

// ************************************************
// Set your username
$username = bobbybonzai;

// Alter the next line to reflect the location of rss_fetch.inc
require_once($_SERVER['DOCUMENT_ROOT']."/incs/magpie/rss_fetch.inc");

// Set the location of the cached feed [dir needs to be writable]
define('MAGPIE_CACHE_DIR', $_SERVER['DOCUMENT_ROOT']."/incs/magpie/cache");

// Cache the RSS feed for 10 minutes [600 seconds]
// Change to whatever you like
define('MAGPIE_CACHE_AGE', 600);

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

if (!$feed = fetch_rss("http://ws.audioscrobbler.com/rdf/history/$username")) {
        echo "<p>Sorry, I couldn't fetch the Audioscrobbler RSS feed and there is no cached version. Please try again later.</p>";
}
else {
        $items = array_slice($feed->items, 0);
        print '<p style="padding-top:0; padding-bottom: 5px; margin-top: 0;">via <a
        href="/linkout.php?click=http://www.audioscrobbler.com/user/bobbybonzai">
        Audioscrobbler</a></p>';
        echo "<ul>\n";

        foreach ($items as $item) {

                $artist = $item['dc']['artist_creator_title'];
                $title = $item['dc']['title'];
                $album = $item['dc']['albumlist_album_title'];

                // Clean up text
                $artist = cleanup($artist);
                $title = cleanup($title);
                $album = cleanup($album);

                if ($title != "") {
                        echo "\t<li><strong>$title</strong>\n";
                } else {
                        echo "\t<li>Unknown song title</li>\n";
                }

                if ($artist != "") {
                        echo "\t\t<br />af <em>$artist</em>\n";
                } else {
                        echo "\t\t<li>Unknown artist</li>\n";
                }

                if ($album != "") {
                        echo "\t\t<br />fra '$album'</li>\n";
                } else {
                        echo "\t\t</li>\n";
               }

                } // foreach ($items as $item)

        echo "</ul>\n";
} // if (!$feed) else
?>
