<?php

# Firefox ad-campaign:
/*if(!stristr($_SERVER['HTTP_USER_AGENT'], "firefox") && !isset($_COOKIE['foxy'])) {
	setcookie("foxy","you_are", time()+3600*24*365, "/");
	include('/home/voss/www/blog/firefox.inc.php');
	exit();
}*/

# Set some stuff for the headings:
# Turn on paranoia error reporting:
# error_reporting(E_ALL);


# The title of your blog:
$blog_title = "verture.net";

# Base domain name for your weblog, typically yourdomain.com
$domain_name = "blog.verture.net";

# Meta-description for your weblog:
$description = "";

# Keywords for your weblog:
$key_words = "";

# DC.Title tag:
$dc_title = "blog.verture.net";

# MySQL-info for your hostmachine:
$db_host = "mysql.verture.net";
$db_user = "voss";
$db_pass = "*****";
$db_name = "verture_blog";

# Do you want statistics included on your webpage? Set to true or false.
$statistics = 0;

# emailaddress to sent comments to:
$comments_address = "kommentar@verture.net";

# Adminaddress will be shown if databaseproblems arises;
$admin_address = "jonas.voss@gmail.com";

# Include path:
$inc_path = $_SERVER['DOCUMENT_ROOT']."/incs/";

# Define offset for server time:
$offset = '9';

#CSS filename:
$css = 'verture.css';

setlocale(LC_ALL, 'da_DK.ISO8859-1');

?>
