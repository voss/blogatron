<?php

/*----------------------## SETTINGS ##--------------------------*/

/*
################   READ ME FIRST   ####################

Resampled is resourceintensive and makes nicer thumbnails, 
but it requires GD Lib 2.0. If you don't know which version 
of GD Lib is installed on your server, choose resampled (0).
The script will check for the proper version and change to 
resized if GD Lib 2.0 is not installed.

Because resampled (if present) is more ressource intensive, 
I've made it so that with 50 pictures or more in a folder, 
resized is chosen no matter what the user settings might be.

#######################################################
*/


/* THUMBNAIL SETTINGS */


# Thumbnails Directory (call it anything you like, but stay clear of whitespace):
$thumb = "thumbs";

# 100 = Highest quality, 0 = Lowest quality.
$quality = "100";

# Thumbnail method: 
# 1 = resized, 0 = resampled.
$thumb_type = "0";

# Width of thumbnails, height will be set accordingly:
$nwidth = "175";


/* "DESIGN" SETTINGS -- TITLE, COLOR, BORDER AND SO FORTH */

## -- TEXT ELEMENTS -- ##

# Wrapperwidth:
$wrapperwidth = "80";

# Title of the Gallery:
$title = "KOT";

# Header in the galleri content page.
$header = "Koordineret tilmelding for Windowsbrugere";

# Size of $header, in keywords: xx-small, x-small, small, medium, large, etc.
$head_size = "large";

# Text for the title-tag.
$v_text = "Se";

# Text before the size specification in both thumbnail and single image view.
$i_size ="Størrelse";

# Number of columns in thumbnail gallery.
$columns = "2";             

## -- BORDERS -- ##

# If you want a border on your table, type the width [in px].
$tborder = "0";

# Colour of your tableborder.
$tbordercolor = "";

# Type of tableborder: solid, dotted, dashed, inset, outset, etc.
$tbordertype = "";

# If you want a border on your cells, type the width [in px].
$cborder = "0";

# Colour of your cellborder.
$cbordercolor = "";

# Type of cellborder: solid, dotted, dashed, inset, outset, etc.
$cbordertype = "";

## TEXT AND BACKGROUND COLOURS ##

# Colour of the background. Choose between hex-definitions, or any of the colour keywords.
$backgroundcolor = "#fff" ;

# Well, text-colour, same implementation as above.
$textcolor = "#333";

/*
--------------------#### DO NOT EDIT BENEATH THESE LINES ####------------------------
--------------------####   UNLESS YOU KNOW WHAT YOU DO   ####------------------------
*/

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

$head = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\"
\"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
	<meta http-equiv=\"content-type\" content=\"text/html; charset=iso-8859-1\" />
	<title>{$title}</title>
	<style type=\"text/css\">";
	
$csscontent = "
	body
	{
		color: {$textcolor};
		background-color: {$backgroundcolor};
		margin: 0;
		padding: 5px;
		text-align: center;
	}
	
	h1
	{
		font-size:{$head_size};
		font-family: sans-serif;
		tex-align: center;
	}
	
	table
	{
		border: {$tborder}px {$tbordertype} {$tbordercolor};
		width: 100%;
		text-align: center;
		border-collapse: collapse;
		padding: 0;
	}
	
	td
	{
		border: {$cborder}px {$cbordertype} {$cbordercolor};
		text-align: center;
		padding: 1px;
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
	
	#wrapper
	{
		text-align: center;
		width: {$wrapperwidth}%;
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
	</style>
</head>
<body>
<div id=\"wrapper\">\n";

$csssingle = "
	body
	{
		color: {$textcolor};
		background-color: {$backgroundcolor};
		margin: 0;
		padding: 5px;
		text-align: center;
	}
	
	table
	{
		border: {$tborder}px {$tbordertype} {$tbordercolor};
		width: 100%;
		text-align: center;
		border-collapse: collapse;
		padding: 0;
	}
	
	td
	{
		border: {$cborder}px {$cbordertype} {$cbordercolor};
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
		border: none;
	}

	#wrapper
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

/* Creating thumbsfolder if it isn't there already: */
if (!is_dir($thumb) || ($_GET['make'] == 1)) {
    @mkdir($thumb, 0777);
}

# Put the images in the folder into the $images array:
$images = array();
if ($dir = opendir('.')) {
    while (false !== ($file = readdir($dir))) {
        if ($file != "." && $file != "..") {
            if (eregi("\.jpe?g$", $file) ||	eregi("\.gif$", $file) || eregi("\.png$", $file)) {
				$images[] = $file;
			}
        }
    }
    closedir($dir);
}

sort($images);

$i = 0;
$f_size = array();
$i_width = array();
$i_height = array();
foreach ($images as $image) {
	$thumb_image = $thumb."/".$image;
	$error = file_exists($thumb_image);
	$size = getimagesize($image);
	$width  = $size[0];
	$height = $size[1];
	$type   = $size[2];
	if ((!$error) || ($_GET['make'] == 1))  {
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
		$ratio=$width/$nwidth;
		$nheight = $height/$ratio;
		$nheight = round($nheight);
		$nwidth = $width/$ratio;
		if ($imgtc = 1) {
			$newImage =  imagecreatetruecolor($nwidth,$nheight);
		} else {
			$newImage =  imagecreate($nwidth,$nheight);
		}
		# If the user ordered resized, or if there are more than 50 images
		# in the folder (don't wan't to eat away on server ressources) use imagecopyresized().
		if(($thumb_type == 1) || (count($images) > 50) || ($imgtc != 1)) {
			imagecopyresized($newImage, $img, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
		} else {
			imagecopyresampled($newImage, $img, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
		}
		
		switch ($type) {
			case 1:
			imagegif($newImage, $thumb_image);
			break;
			case 2:
			imagejpeg($newImage, $thumb_image, $quality);
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

if(isset($id)) {
	print $csssingle;
} else {
	print $csscontent;
	if(!empty($header)) {
		print "<h1>{$header}</h1>";
	}
}
print "<table>\n";
if (!isset($id)) {
    $rows = round(count($thumb_path)/$columns);
    if (($columns * $rows) < (count($thumb_path))) {
        $rows++;
    }
    for ($i = 1; $i <= $rows; $i++) {
        print "<tr>\n";
        for ($j = 1; $j <= $columns; $j++) {
            $td = (($i - 1) * $columns) + $j;
            $iu = ($td - 1);
            if (isset($thumb_path[$iu])) {
                $caption = "";
                $caption .= "<td>\n";
                $caption .= "<p><a title=\"{$v_text} {$images[$td-1]}\" href=\"?id={$iu}\">";
                $caption .= "<img src=\"{$thumb_path[$iu]}\" alt=\"{$images[$td-1]}\" /></a><br />\n";
				$caption .= "{$images[$td-1]}<br />\n";
                $caption .= "$i_size (pixels): $i_width[$iu] x $i_height[$iu]\n";
                $caption .= "<br />$f_size[$iu] Kb</p>\n";
                $caption .= "</td>\n";
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
    $caption .= "<tr>\n<td>\n<p class=\"byline\"> $header &raquo;  #$id2 // #$total </p></td>\n</tr>\n<tr>\n";
    $caption .= "<td>\n<p class=\"byline\">\n";
	if ($id == 0) {
        $caption .= "<a href=\"?id=$id2\" byline>&gt;&gt;</a></p>";
    } elseif ($id == ($total - 1)) {
        $caption .= "<a href=\"?id=$id3\">&lt;&lt;</a></p>  ";
    } else {
        $caption .= "<a href=\"?id=$id3\">&lt;&lt;</a>    <a href=\"?id=$id2\">&gt;&gt;</a></p>";
    }
    $caption .= "<p><a href=\".\" title=\"Up\"><img src=\"$images[$id]\" alt=\"$images[$id]\" /></a>";
	$caption .= "<br />{$images[$id]}\n";
    $caption .= "<br />$i_size: $i_width[$id] x $i_height[$id]\n";
    $caption .= "<br />$f_size[$id] Kb.\n";
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
print "<tr><td colspan=\"{$columns}\"><p style=\"width: 100%; text-align: center; padding-top: 25px;\">Generated by Gallerhea v0.1.1a</p></td></tr>";
print "</table>\n";

?>
</div>
</body>
</html>