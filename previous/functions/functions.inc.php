<?php

#### FILE: FUNCTIONS.INC.PHP ####
# include('incs/config.inc.php');

# error_reporting(E_ALL);

# Submits query $sql:
function submit_query($sql)
{
	$result = @mysql_query($sql);
	if(!$result)
	{
		print mysql_error()."<br />";
		print $sql;
		return false;
	}
	else
	{
		return $result;
	}
}

# Logout-thingy:
if($_GET['action'] == 'logout')
{
	session_unregister("name");
	session_unregister("passwd");
	session_destroy();
	header("Location: /");
}

# Pull out the title of the last inserted entry for displaying in the <title>-tag.
$sql2 = "select max(date) from entries where status = '1'";
$result2 = @mysql_query($sql2);
$max_date = @mysql_fetch_array($result2);
$sql3 = "SELECT title, date from entries where date = '{$max_date[0]}'";
$result3 = @mysql_query($sql3);
$front_title = @mysql_fetch_array($result3);

# $cur_entry_sql = "SELECT title from entries where title like = 

function print_header($head, $css, $domain_name, $description, $key_words)
{
	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" 
	\"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\">
	<head>
		<link href=\"http://{$domain_name}/css/{$css}.css\" rel=\"stylesheet\" type=\"text/css\" title=\"Fall\" media=\"screen\" />
		<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"http://{$domain_name}/rssfeed.xml\" />
		 <!--[if IE]>
		 	<link href=\"http://{$domain_name}/css/{$css}_ie.css\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />
		 <![endif]-->
		<link rel=\"Shortcut Icon\" href=\"http://{$domain_name}/img/favicon.ico\" />
		<meta http-equiv=\"content-type\" content=\"text/html; charset=iso-8859-1\" />
		<meta name=\"ICBM\" content=\"55.67726, 12.57534\" />
		<meta name=\"DC.title\" content=\"{$domain_name}\" />
		<meta name=\"Description\" content=\"{$domain_name}. {$description}\" />
		<meta name=\"Keywords\" content=\"{$domain_name}. {$key_words}\" />
		<meta name=\"MSSmartTagsPreventParsing\" content=\"true\" />
		<script type=\"text/javascript\" src=\"/js/jsscripts.js\"></script>
		<title>{$head}</title> 
	</head>
	<body>
	";
}

function print_footer() {
	print "</body>
</html>";
}

# Format entries, takes out HTML, inserts HTML-tags for linebreaks and paragraphs. Snatched from http://photomatt.net/scripts/autop
function format_entry($arg, $br = 1)
{
#	$arg = $arg."\n"; # just to make things a little easier, pad the end
	$arg = preg_replace('|<br />\s*<br />|', "\n\n", $arg);
	$arg = preg_replace('!(<(?:table|ul|ol|li|pre|form|blockquote|h[1-6])[^>]*>)!', "\n$1", $arg); # Space things out a little
	$arg = preg_replace('!(</(?:table|ul|ol|li|pre|form|blockquote|h[1-6])>)!', "$1\n", $arg); # Space things out a little
	$arg = preg_replace("/(\r\n|\r)/", "\n", $arg); # cross-platform newlines
	$arg = preg_replace("/\n\n+/", "\n\n", $arg); # take care of duplicates
	$arg = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $arg); # make paragraphs, including one at the end
	$arg = preg_replace('|<p>\s*?</p>|', '', $arg); # under certain strange conditions it could create a P of entirely whitespace
	$arg = preg_replace("|<p>(<li.+?)</p>|", "$1", $arg); # problem with nested lists
	$arg = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $arg);
	$arg = str_replace('</blockquote></p>', '</p></blockquote>', $arg);
	$arg = preg_replace('!<p>\s*(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)!', "$1", $arg);
	$arg = preg_replace('!(</?(?:table|tr|td|th|div|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*</p>!', "$1", $arg);
	if ($br) $arg = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $arg); # optionally make line breaks
	$arg = preg_replace('!(</?(?:table|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|blockquote|p|h[1-6])[^>]*>)\s*<br />!', "$1", $arg);
	$arg = preg_replace('!<br />(\s*</?(?:p|li|div|th|pre|td|ul|ol)>)!', '$1', $arg);
	$arg = preg_replace('/&([^#])(?![a-z]{1,8};)/', '&#038;$1', $arg);
	$arg = ereg_replace('--','&mdash;', $arg); # Replace emdash with --.
#	$arg = stripslashes($arg);
	return $arg;
}


function unformat_entry($arg)
{	# Make a fix for blockquote instances
	$arg = ereg_replace("</p>\n<p>","</p><p>",$arg); # Prettyprint paragraphs
	$arg = ereg_replace("<br />\n","\n",$arg); # replace newlines
	$arg = ereg_replace("</p><p>","\n\n",$arg); # replace linefeeds (UNIX)
#	$arg = ereg_replace('','\r',$arg); # replace linebreaks (Windows)
	$arg = ereg_replace('&amp;', '&',$arg); # Ampersans shouldn't be left alone
	$arg = strip_tags($arg, '<a><b><em><q><li><ul><abbr><span><img><code><pre><div><h3><ol><del><blockquote><ins>');
	$arg = ereg_replace('&mdash;','--', $arg); # Replace emdash with --.
	return $arg;
}

function format_comment($arg)
{
	$arg = strip_tags($arg, '<a><b><em><q><del>');
	$arg = ereg_replace("\r","",$arg);
	$arg = ereg_replace("\n\n","</p><p>",$arg);
	$arg = ereg_replace("\n","<br />\n",$arg);
	$arg = ereg_replace("</p><p>","</p>\n<p>",$arg);
    return $arg;
}

function format_email($arg)
{
	$valid_email = "^[a-z0-9_\.-]+([@]{1})[a-z0-9_\.-]+[\.][a-z0-9_\.-]+$";
	if(eregi($valid_email, $arg) == true)
	{
		return $arg;
	} 
	else 
	{
		unset($arg);
		return false;
	}
}

function spam_safe($arg)
{
	$arg = ereg_replace("@", " [snabel-a] ", $arg);
	$arg = ereg_replace("\.", " [prik] ", $arg);
	return $arg;
}

function format_url($arg)
{
	$valid_url = "^http://[^<>[:space:]]+[[:alnum:]/]$";
	if(eregi($valid_url, $arg) == true)
	{
		return $arg;
	} 
	else
	{
		unset($arg);
		return false;
	}
}

function dirify($arg)
{
	$arg = strtolower($arg);
	if(strstr($arg, "_"))
	{
		$arg = ereg_replace("_", "-", $arg);	
	}
	else
	{
		$arg = ereg_replace("_", " ", $arg);

	}
#	$dk_char = array('aae','ae','Ae','oe','Oe','aa','Aa');
#	$rpl_char = array('&aring;e','&aelig;','&AElig;','&oslash;','&Oslash;','&aring;','&Aring;');
    $dk_char = array('ae','æ','Æ','ø','Ø','å','Å',' ','...','[',']','?');
    $rpl_char = array('a.e','ae','Ae','oe','oe','aa','Aa','_','','','','');
    $arg = str_replace($dk_char, $rpl_char, $arg);
#	$arg = substr($arg, 0, 15);
	return $arg;
}

function undirify($arg)
{
	if(strstr($arg, "-")) 
	{
		$arg = ereg_replace("-", "_", $arg);	
	}
	else
	{
		$arg = ereg_replace("_", " ", $arg);
	}
    $dk_char = array('ae','a.e','Ae','oe','oe','aa','Aa');
    $rpl_char = array('æ','ae','Æ','%','Ø','å','Å');
    $arg = str_replace($dk_char, $rpl_char, $arg);
	return $arg;
}

function dateify($arg)
{
	switch ($arg)
	{
		case 'January':
			$arg = 'januar';
			return $arg;
		case 'February':
			$arg = 'februar';
			return $arg;
		case 'March':
			$arg = 'marts';
			return $arg;
		case 'May':
			$arg = 'maj';
			return $arg;
		case 'June':
			$arg = 'juni';
			return $arg;
		case 'July':
			$arg = 'juli';
			return $arg;
		case 'October':
			$arg = 'oktober';
			return $arg;
		default:
			$arg = strtolower($arg);
			return $arg;
	}
}
?>
