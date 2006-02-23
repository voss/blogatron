<?php

/*
----------------------## USEFULL INFO ##--------------------------

This script is released under the following Creative Commons Licens.

    <http://creativecommons.org/licenses/by-nc-sa/1.0/>

Please read this before you submit a bug report:

    <http://www.chiark.greenend.org.uk/~sgtatham/bugs.html>
    
Bug reports, questions, suggestions, complaints, rants my be mailed to:

    gallerhea@verture.net
    
Thanks.

----------------------## NOTICE ##--------------------------

Resampled is resourceintensive and makes nicer thumbnails, 
but it requires GD Lib 2.0. If you don't know which version 
of GD Lib is installed on your server, choose resampled (0).
The script will check for the proper version and change to 
resized if GD Lib 2.0 is not installed.

Because resampled (if present) is more ressource intensive, 
I've made it so that with 50 pictures or more in a folder, 
resized is chosen no matter what the user settings might be.

------------------## BEGIN SETTINGS ##----------------------

To change the default settings, change what is in inside 
the single quotes. E.g. to change the name of the thumbnails 
directory to 'foo' instead of 'thumbs', change this line:

    $thumb_conf['dir'] = 'thumbs';

to this

    $thumb_conf['dir'] = 'foo';
                          ^^^
                           |
                            \
                             '--> Nothing but this needs to be 
                                  changed.

This finishes the instructions on how to change the settings.

################################
####    THUMBNAIL SETTINGS  ####
################################

*/
#   Thumbnails Directory (call it anything you like, 
#   but stick to alphanumerics, and stay clear of 
#   whitespace), i.e. calling it 'me and irene' won't 
#   work, while 'me_and_irene' will.
$thumb_conf['dir'] = 'thumbs';

#   100 = Highest quality, 0 = Lowest quality.
$thumb_conf['quality'] = '100';

#   Thumbnail method:
#   If non-zero, resized will be used.
$thumb_conf['type'] = '0';

#   Width of thumbnails in pixels, height will be set accordingly:
$thumb_conf['nwidth'] = '150';

################################
####    'DESIGN' SETTINGS   ####
################################

## --   MEASURES    -- ##

$design['wrapperwidth'] = '60';

#   Number of columns in thumbnail gallery.
$design['columns']  = '2';  

## -- TEXT ELEMENTS -- ##

#   Title of the Gallery:
$page['title'] = 'FileThingie for IE';

#   Header text in the galleri content page.
$page['header']  = 'Commented Backslash Hack on FileThingie&trade;';

#   Font-size of h1-elements, in keywords: xx-small, x-small, small, medium, large, etc.
$design['h1_size']  = 'large';

#   Text for the title-tag.
$design['v_text']  = 'Se';

#   Should we show the size of the image in px?
#   1 = Yes
#   0 = no:
$design['show_size_px'] = '0';

#   Should we show the size of the image in Kb?
#   1 = Yes
#   0 = no:
$design['show_size_kb'] ='0';

## -- TABLEBORDERS -- ##

#   If you want a border on your table, type the width [in px].
$table['border'] = '0';

#   Colour of your tableborder.
$table['border_color'] = '';

#   Type of tableborder: solid, dotted, dashed, inset, outset, etc.
$table['border_type'] = '';

#   If you want a border on your cells, type the width [in px].
$table['cell_border'] = '0';

#   Colour of your cellborder.
$table['cell_border_color'] = '';

#   Type of cellborder: solid, dotted, dashed, inset, outset, etc.
$table['cell_border_type'] = '';

## --   TEXT AND BACKGROUND COLOURS/IMAGES   -- ##

#   Background image.
#   Write the absolute URL, i.e. say your image background.jpg
#   are in the images folder at the root level of your file system,
#   you should write:
#           /images/background.gif
#   between the quotes.
#   Leave blank if you don't wan't a background image.
$page['background_image'] = '';

#   Should the background image be repeated?
#   No value = Yes, repeat on both y and x axis.
#   no-repeat = NO.
#   repeat-x = repeat on the x axis.
#   repeat-y = repeat on the y axis.
$page['background_repeat'] = '';


#   Colour of the background.
#   Choose between hex-definitions [remember the octothorpe, #], 
#   or any of the colour keywords.
$page['background'] .= '#fff';

#   Well, text-colour, same implementation as above.
$page['text_color'] = '#000';

## --   HEADER AND FOOTER   -- ##

#   If you have a file containing things you want to include
#   in the top of the thumbnails page, write the path 
#   [relative to the wesbcope], to that file here.
#   E.g., if the file you want to include is located at 
#
#       http://yourdomain.com/header/include_me.txt,
#
#   so you should write: /header/include_me.txt.
$page['header_file'] = ''; 

#   If you have a file containing things you want to include
#   in the bottom of the thumbnails page, write the path 
#   [relative to the wesbcope], to that file here.
#   E.g., if the file you want to include is located at 
#
#       http://yourdomain.com/footer/include_me.txt,
#
#   so you should write: /footer/include_me.txt.
$page['footer_file'] = '/linselust/voss.lus.test/footer.txt';

#------------------## END OF SETTINGS ##----------------------



/*
-----------#### DO NOT EDIT BENEATH THESE LINES ####----------
-----------####   UNLESS YOU KNOW WHAT YOU DO   ####----------
*/


function dirify($arg) {
    $arg = ereg_replace("_", " ", $arg);
    $arg = ereg_replace("ae","æ", $arg);
    $arg = ereg_replace("aa","å", $arg);
    $arg = ereg_replace("oe","ø", $arg);
    $arg = ereg_replace("Ae","Æ", $arg);
    $arg = ereg_replace("Aa","Å", $arg);
    $arg = ereg_replace("Oe","Ø", $arg);
    $arg = substr($arg, 0, -4);
    return $arg;
}


$head = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"
\"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
    <meta http-equiv=\"content-type\" content=\"text/html; charset=iso-8859-1\" />
    <title>{$page['title']}</title>
    <style type=\"text/css\">";
    
$csscontent = "
    body
    {
        color: {$page['text_color']};
        background: url('{$page['background_image']}') {$page['background_repeat']} {$page['background_color']};
        margin: 0;
        padding: 5px;
        text-align: center;
    }
    
    h1
    {
        font-size:{$design['h1_size']};
        font-family: verdana, tahoma, helvetica, arial, sans-serif;
        tex-align: center;
    }
    
    table
    {
        border: {$table['border']}px {$table['border_type']} {$table['border_color']};
        width: 100%;
        text-align: center;
        border-collapse: collapse;
        padding: 0;
    }
    
    td
    {
        border: {$table['cell_border']}px {$table['cell_border_type']} {$table['cell_border_color']};
        text-align: center;
        padding: 10px;
        border-collapse: collapse;
    }
    
    tr
    {
        margin: 0;
        padding: 0;
        text-align: center;
        border-collapse: collapse;
    }
    
    a:link img
    {
        border: 1px solid #000;
    }
    
    a:visited img
    {
        border: 1px solid #666;
    }
    
    a:hover img
    {
        border: 1px solid #f60;
    }
    
    div#wrapper
    {
        text-align: center;
        width: {$design['wrapperwidth']}%;
        margin-left: auto;
        margin-right: auto;
    }
    
    p, td p
    {
        font-family: tahoma, verdana, 'lucida grande', tahoma, sans-serif;
        font-size: x-small;
        margin: 0;
        padding: 1px;
    }
    p
    {
        padding-top: 25px;
    }

    td p a
    {
        font-size: small;
        color: #f30;
        padding: 0;
    }
    
    td p a:hover
    {
        font-size: small;
        color: #00f;
    }

    </style>
</head>
<body>
<div id=\"wrapper\">\n";

$csssingle = "
    body
    {
        color: {$page['text_color']};
        background: url('{$page['background_image']}') {$page['background_repeat']} {$page['background_color']};
        margin: 0;
        padding: 5px;
        text-align: center;
    }
    
    table
    {
        border: {$table['border']}px {$table['border_type']} {$table['border_color']};
        width: 100%;
        text-align: center;
        border-collapse: collapse;
        padding: 0;
    }
    
    td
    {
        border: {$table['cell_border']}px {$table['cell_border_type']} {$table['cell_border_color']};
        text-align: center;
        padding: 1px;
        border-collapse: collapse;
    }
    
    img
    {
        border:none;
    }
    
    a:link img
    {
        border: 1px solid black;
    }

    div#wrapper
    {
        text-align: center;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }
    
    p
    {
        font-family: tahoma, verdana, 'lucida grande', tahoma, sans-serif;
        font-size: small;
        margin: 0;
        padding-top: 25px;
    }
    
    p.byline
    {
        font-size: medium;
        padding: 15px;
    }
    
    td p
    {
        font-size: small;
        padding: 0;
    }

    td p a
    {
        font-size: medium;
        color: #f30;
        padding: 0;
    }
    
    td p a:hover
    {
        font-size: medium;
        color: #00f;
    }
    
    </style>
</head>
<body>
<div id=\"wrapper\">\n";


/*-------------------###   Thumbnail section   ###------------ */

# Checks for the presence of imagecreatetruecolor()
# a GD Lib 2.0 function making nicer images.
$arr = get_defined_functions();
$avail_func = array();
foreach ($arr[internal] as $key => $value) {
    $avail_func[] = $value;
}
if (in_array("imagecreatetruecolor", $avail_func) == true) {
    $imgtc = 1;
}

/* Creating thumbsfolder if it isn't there already: */
if (!is_dir($thumb_conf['dir']) || ($_GET['make'] == 1)) {
    $oldumask = umask(0);
    @mkdir($thumb_conf['dir'], 0775);
    umask($oldumask);
}

# Put the images in the folder into the $images array:
$images = array();
if ($dir = opendir('.')) {
    while (false !== ($file = readdir($dir))) {
        if ($file != "." && $file != "..") {
            if (eregi("\.jpe?g$", $file) || eregi("\.gif$", $file) || eregi("\.png$", $file)) {
                $images[] = $file;
            }
        }
    }
    closedir($dir);
}

sort($images);

$i = 0;

# Initiate arrays for containing file-size and width+height of images
$f_size = array();
$i_width = array();
$i_height = array();

# This was supposed to be real smart. Generates thumbnail for each image
# in the folder. If new ones are dropped in the folder, it will create new thumbs
# automagically. Unfortunately, file_exists() is not allowed in safe_mode,
# so manual thumbnail generating must be done via the URL for the page.
# So, to make new thumbnails, call the page with ?make=1. This will create new
# thumbnails.
foreach ($images as $image) {
    $thumb_image = $thumb_conf['dir']."/".$image;
#   $error = file_exists($thumb_image);
    $size = getimagesize($image);
    $width  = $size[0];
    $height = $size[1];
    $type   = $size[2];
    if ($_GET['make'] == 1) {
        # set_time_limit(30);
        switch ($type) {
            case 1 :
            $img=imagecreatefromgif($image);
            break;
            case 2 :
            $img=imagecreatefromjpeg($image);
            break;
            case 3 :
            $img=imagecreatefrompng($image);
            break;
        }
        $ratio=$width/$thumb_conf['nwidth'];
        $nheight = $height/$ratio;
        $nheight = round($nheight);
        $nwidth = $width/$ratio;
        if ($imgtc == 1) {
            $newImage =  imagecreatetruecolor($nwidth,$nheight);
        } else {
            $newImage =  imagecreate($nwidth,$nheight);
        }
        # If the user ordered resized, or if there are more than 50 images
        # in the folder (don't wan't to eat away on server ressources) use imagecopyresized().
        if(($thumb_conf['type'] == 1) || (count($images) > 50) || ($imgtc != 1)) {
            imagecopyresized($newImage, $img, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
        } else {
            imagecopyresampled($newImage, $img, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
        }
        
        switch ($type) {
            case 1:
            imagegif($newImage, $thumb_image);
            break;
            case 2:
            imagejpeg($newImage, $thumb_image, $thumb_conf['quality']);
            break;
            case 3:
            imagepng($newImage, $thumb_image);
            break;
            @imagedestroy($newImage);
            @imagedestroy($img);
        }
}
# Store the path for each image in $thumb_path[]:
$thumb_path[$i] = $thumb_image;

# Store width, height, and size of original image in the following arrays:
$i_width[$i] = $width;
$i_height[$i] = $height;
$f_size[$i] = round((@filesize($image)/1024), 1);
$i++;
}

/*-------------------   Preview Section   ---------------------*/

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $post = $_POST['id'];
}

print $head;

if(!empty($page['header_file'])) {
    @include($_SERVER['DOCUMENT_ROOT'].$page['header_file']);
}

if(isset($id)) {
    print $csssingle;
} else {
    print $csscontent;
    if(!empty($page['header'])) {
        print "<h1>{$page['header']}</h1>";
    }
}
print "<table>\n";
if (!isset($id)) {
    $rows = round(count($thumb_path)/$design['columns']);
    if (($design['columns'] * $rows) < (count($thumb_path))) {
        $rows++;
    }
    for ($i = 1; $i <= $rows; $i++) {
        print "<tr>\n";
        for ($j = 1; $j <= $design['columns']; $j++) {
            $td = (($i - 1) * $design['columns']) + $j;
            $iu = ($td - 1);
            if (isset($thumb_path[$iu])) {
                $caption = "";
                $caption .= "<td>\n";
                $caption .= "<p><a title=\"{$design['v_text']} ".dirify($images[$td-1])."\" href=\"?id={$iu}\">";
                $caption .= "<img src=\"{$thumb_path[$iu]}\" alt=\"{$images[$td-1]}\" /></a><br />\n";
                $caption .= dirify($images[$td-1])."<br />\n";
                if(($design['show_size_px']) == true) {
                    $caption .= "Størrelse (pixels): $i_width[$iu] x $i_height[$iu]<br />\n";
                }
                if($design['show_size_kb'] == true) {
                    $caption .= "<br />$f_size[$id] Kb.\n";
                }
               $caption .= "</p></td>\n";
               print $caption;
            } else {
                print "<td>\n<br /></td>\n";
            }
        }
        print "</tr>\n";
    }

} else {
    $id2 = $id + 1;
    $id3 = $id - 1;
    $total = count($thumb_path);
    $caption = "";
    $caption .= "<tr>\n<td>\n<p class=\"byline\"> {$page['header']} &raquo;  #$id2 // #$total </p></td>\n</tr>\n<tr>\n";
    $caption .= "<td>\n<p class=\"byline\">\n";
    if ($id == 0) {
        $caption .= "<a href=\"?id=$id2\" byline>&gt;&gt;</a></p>";
    } elseif ($id == ($total - 1)) {
        $caption .= "<a href=\"?id=$id3\">&lt;&lt;</a></p>  ";
    } else {
        $caption .= "<a href=\"?id=$id3\">&lt;&lt;</a>    <a href=\"?id=$id2\">&gt;&gt;</a></p>";
    }
    $caption .= "<p><a href=\".\" title=\"Up\"><img src=\"$images[$id]\" alt=\"$images[$id]\" />\n</a>\n<br />\n";
    $caption .= dirify($images[$id])."\n";
    if($design['show_size_px'] == true) {
        $caption .= "Størrelse (pixels): $i_width[$iu] x $i_height[$iu]<br />\n";
    }
    if($design['show_size_kb'] == true) {
        $caption .= "<br />$f_size[$id] Kb.\n";
    }
    $caption .= "<br />\n</p></td>\n</tr>\n";
    $caption .= "<tr>\n<td>\n<p>\n";
    if ($id == 0) {
        $caption .= "<a href=\"?id=$id2\">&gt;&gt;</a>";
    } elseif ($id == ($total - 1)) {
        $caption .= "<a href=\"?id=$id3\">&lt;&lt;</a>  ";
    } else {
        $caption .= "<a href=\"?id=$id3\">&lt;&lt;</a>    <a href=\"?id=$id2\">&gt;&gt;</a>";
    }
    $caption .= "</p>\n</td>\n</tr>\n";

    print $caption;
}
if(!empty($page['footer_file'])) {
    print "<tr><td colspan=\"{$design['columns']}\">\n<p style=\"width: 100%; text-align: center; padding-top: 25px;\">\n";
    @include($_SERVER['DOCUMENT_ROOT'].$page['footer_file']);
    print "</p></td></tr>";
}
    print "<tr><td colspan=\"{$design['columns']}\"><p style=\"width: 100%; text-align: center; padding-top: 25px;\">Generated by Gallerhea v0.2</p></td></tr>";
    print "</table>\n";

?>
</div>
</body>
</html>