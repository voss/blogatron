<?php
@include($_SERVER['DOCUMENT_ROOT'].'/incs/accesscontrol.php');

if(isset($_POST['submit']))
{
	if(($_POST['title'] != "") && ($_POST['text'] != ""))
	{
		$title = $_POST['title'];
		$text = $_POST['text'];
		$slug = $_POST['slug'];
		$text_more = $_POST['text_more'];
		$aid = $_POST['aid'];
		$status = $_POST['status'];
		$comments = $_POST['comments'];
		if(($_POST['month']) == 0)
		{
			$date = time() + ($offset * 3600);
		}
		else
		{
			$date = mktime($_POST['hh'], $_POST['mm'], $_POST['ss'], $_POST['month'], $_POST['day'], $_POST['year']);
		}
		$sql = "
				INSERT INTO entries SET
				title = ('{$title}'),
				text = ('{$text}'),
				slug = ('{$slug}'),
				text_more = ('{$text_more}'),
				aid = ('{$aid}'),
				date = ('{$date}'),
				status = ('{$status}'),
				comments = ('$comments')";
		# debug:
		# print $sql;
		$insert_result = @mysql_query($sql) or print mysql_error();
		
	} else {
		$success = false;
	}
}

print_header(". {$blog_title} | Post et indlæg .", "edit.css", $domain_name, $description, $key_words, $dc_title, $install_path);
?>
<script type="text/javascript" src="<?=$install_path;?>/js/jquery.js"></script>
<script type="text/javascript" src="<?=$install_path;?>/js/markitup/jquery.markitup.js"></script>
<script type="text/javascript" src="<?=$install_path;?>/js/markitup/sets/html/set.js"></script>
<link rel="stylesheet" type="text/css" href="<?=$install_path;?>/js/markitup/skins/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="<?=$install_path;?>/js/markitup/sets/html/style.css" />
<script type="text/javascript" >
	$(document).ready(function() {
		$(".text").markItUp(mySettings);
	});
</script>
</head>
<body>
<div id="container">
<div id="top">
	<p style="float: right;">Bruger: <?=$_SESSION['aname'];?></p>
	<h1>Administration af <?=stripslashes($blog_title);?> på http://<?=$domain_name.$install_path;?>/</h1>
</div>
<div id="leftbar">
<div id="mlist">
<?php
	print_ulist($edit_menu);
?>
</div>
<?php
	display_archive_months_edit();
?>
</div>
<div id="content">
<?php
	# Error handling on non-valid form:
	$success = (isset($_POST['submit']) && $success == false) ? '<p class="redalert">Alle felter skal udfyldes.</p>' : ''; 
?>
<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" id="postForm" name="postForm" onsubmit="return validPost();">
<div style="margin: 0 20px 0 0; padding: 0; border: 0">		
<h1>Post et indlæg</h1>
        <input type="hidden" name="aid" value="<?=$_SESSION['aid'];?>" />
        <label>Titel</label><br />
        <input tabindex="1" type="text" name="title" value='<?=htmlspecialchars($_POST['title'], ENT_QUOTES)?>' size="50" /><br />
        <label>Slug</label><br />
        <input tabindex="2" type="text" name="slug" value='<?=$_POST['slug']?>' size="50" /><br />
        <label>Tekst</label><br />
        <textarea tabindex="2" cols="55" rows="10" name="text" class="text" style="width: 65%;"><?=stripslashes($_POST['text']);?></textarea><br />
		<div id="inputform">
		<label>Kommentarer</label>
		<input tabindex="4" type="checkbox" checked="checked" name="comments" />
        <label>Status</label>
        <select tabindex="5" name="status">
			<option value="0">Kladde</option>
			<option selected="selected" value="1">Postet</option>
		</select>
		<input tabindex="6" type="submit" name="submit" value="Publicér" id="submitpost" />
        <?php
        if($insert_result != false)
        {
			print '<span style="padding: 10px; color: white; background: darkgreen">Indlægget er postet.</span>';
			if($rss_enabled == 1)
			{
				@include($inc_path.'rss.inc.php');
			}
			if($hasBlogbot == 1)
			{
				@include($inc_path.'xml-rpc.inc.php');
			}
        }
		else
		{
			print $success;
		}
        ?>
        </div>
		<p><span onclick="var forumtext = document.getElementById('forumtext');if(forumtext.style.display == 'none') {forumtext.style.display = '';}else {forumtext.style.display = 'none';}">&rarr;</span></p>
		<div id='forumtext' style='display:none;'>
		<label>Udvidet Tekst</label><br />
		<textarea tabindex="3" cols="55" rows="15" name="text_more" style="width: 65%"><?=stripslashes($_POST['text_more']);?></textarea><br />
    		<label>Dato og tid [tomme felter indsætter aktuel tid]</label><br />
		<label>Dag</label><input type="text" name="day" size="2" />
		<select name="month">
		<?php 
		for($i=1;$i<=12;$i++)
		{
			print "<option value=\"{$i}\">".dateify(date('F',mktime(0,0,0,$i)))."</option>\n";
		}		
		?>
		<option value="0" selected="selected">-- Måned --</option>
		</select>
		<label>År</label>
		<input type="text" name="year" size="4" />
		<label>@</label>
		<input type="text" name="hh" size="2" />:
		<input type="text" name="mm" size="2" />:
		<input type="text" name="ss" size="2" />
		</div>
</div>
</form>
</div>
</div>
<?php
	print_footer();
?>
