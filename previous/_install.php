<?php 
if(isset($_POST['submit']) && isset($_POST['db_hostname']) && isset($_POST['db_name']) && isset($_POST['db_username']) && isset($_POST['db_passwd']))
{
	$db_hostname = $_POST['db_hostname'];
	$db_username = $_POST['db_username'];
	$db_pass = $_POST['db_passwd'];
	$db_name = $_POST['db_name'];
	
	$data = '<?php
# Set some stuff for the headings:
# The title of your blog:
$blog_title = "'.$_POST['blog_title'].'";

# Base domain name for your weblog, typically yourdomain.com
$domain_name = "'.$_POST['domain_name'].'";

# Meta-description for your weblog:
$description = "'.$_POST['description'].'";

# Keywords for your weblog:
$key_words = "'.$_POST['key_words'].'";

# DC.Title tag:
$dc_title = "'.$_POST['blog_title'].'";

# MySQL-info for your hostmachine:
$db_host = "'.$_POST['db_hostname'].'";
$db_user = "'.$_POST['db_username'].'";
$db_pass = "'.$_POST['db_passwd'].'";
$db_name = "'.$_POST['db_name'].'";

# Do you want statistics included on your webpage? Set to true or false.
$statistics = '.$_POST['statistics'].';

# emailaddress to sent comments to:
$comments_address = "'.$_POST['comments_address'].'";

# Adminaddress will be shown if databaseproblems arises;
$admin_address = "'.$_POST['admin_address'].'";

# Include path:
$inc_path = $_SERVER[\'DOCUMENT_ROOT\']."/incs/";

# Define offset for server time:
$offset = '.$_POST['offset'].';


?>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style type="text/css">
	body{
		background: #fff;
		color: #000;
		font-family: tahoma, verdana, sans-serif;
		padding: 5px;
	}
	
	#wrapper {
		border: 1px solid #269;
		height: 100%;
	}
	
	.db-set{
		float: left;
		font-size: small;
	}
	
	.db-set2 {
		clear:left;
		font-size: small;
	}
	
	h1 {
		padding: 0px;
		color: #269;
	}
	</style>
	<title>Installation</title> 
</head>
<body>
<div id="wrapper">
<h1>Velkommen til installationen af min blogmaskine!</h1>

<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
<fieldset class="db-set">
<legend>Database-indstillinger</legend>
<label>Værtsnavn for din MySQL-database (typiskt 'localhost')</label><br />
<input type="text" name="db_hostname" /><br />
<label>Databasens navn (f.eks. blog)</label><br />
<input type="text" name="db_name"><br />
<label>Brugernavn til databasen</label /><br />
<input type="text" name="db_username" /><br />
<label>Password til databasen</label /><br />
<input type="password" name="db_passwd" /><br />
</legend>
</fieldset>
<fieldset class="db-set">
<legend>Statistik, emailadresser og tidsforskel</legend>

<label>Statistik (0 = slået fra, 1 = slået til)</label><br />
<input type="text" name="statistics" /><br />

<label>Email-adresse kommentarer skal sendes til</label><br />
<input type="text" name="comments_address" /><br />

<label>Adminemail-adresse (bliver vist i forbindelse med fejlmeddelelser)</label><br />
<input type="text" name="admin_address" /><br />

<label>Tidsforskel til serveren (hvis din server står i udlandet).<br />0 for ingen tidsforskel</label><br />
<input type="text" name="offset" /><br />
</fieldset>

<fieldset class="db-set2">
<legend>Titel og beskrivelse af blog</legend>
<label>Titel på din blog</label><br />
<input type="text" name="blog_title" /><br />

<label>Dit domæne</label><br />
<input type="text" name="domain_name" /><br />

<label>Beskrivelse af din blog (til meta-tags)</label><br />
<textarea cols="40" rows="5" name="description"></textarea><br />

<label>Nøgleord til din blog (til meta-tags, skal kommasepareres)</label><br />
<textarea cols="40" rows="5" name="key_words"></textarea><br />

<input type="submit" name="submit" value="Send" />
</fieldset>
</form>
<?php
if(isset($_POST['submit']))
{
	$oldumask = umask(0);
	$file = "incs/config.inc.php";
	if(!$file_handle = fopen($file,"w"))
	{
		print "<p>Cannot open $file</p>";
	}
	if(!fwrite($file_handle, $data))
	{
		print "<p>Cannot write to file</p>";
	}
	print "<p>Success</p>";
	chmod('incs/config.inc.php', 0775);
	umask($oldumask);
	fclose($file_handle);
}
?>
</div>
</body>
</html>
