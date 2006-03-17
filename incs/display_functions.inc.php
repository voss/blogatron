<?php

function display_entry_from_url()
{
	$expl = array_reverse(explode("/", $_SERVER['REQUEST_URI']));
	$entrydate = $expl[1];
	$e = undirify($expl[0]);
	$e = trim($e);
	$sql = "SELECT 
		entries.title, 
		entries.text,
		entries.text_more, 
		authors.uid, 
		entries.date, 
		entries.aid,
		entries.id, 
		entries.comments,
		authors.name 
			FROM 
		entries, 
		authors 
			WHERE 
		entries.aid = authors.uid 
			AND 
		entries.title LIKE ('$e%')
			AND
		entries.status = '1'
			AND
		FROM_UNIXTIME(entries.date, '%d%m%y') = '{$entrydate}'
			LIMIT 0,15";
	$result = @mysql_query($sql);

	if(!$result)
	{
		print "<h4>Knas med databasen, pr�v igen lidt senere.</h4><p>".mysql_error()."</p>";
	}
	
	if(@mysql_num_rows($result) == 1)
		{
		while($row = @mysql_fetch_array($result))
		{
			extract ($row);
			$hour = date("G:i", $date);
			$day = date("d.m.Y", $date);
			print '<div class="entry">';
			print "<h1><img src='/img/permlink.gif' alt='permalink' />{$title}</h1>\n";
			$text = stripslashes(format_entry($text));
			print "{$text}\n";
            if(!empty($text_more))
            {
                $text_more = stripslashes(format_entry($text_more));
                print "<div id=\"mere\">{$text_more}</div>\n";
            }
         print "<p class=\"byline\">{$day} @ {$hour}</p>\n";
			$sql_c = "SELECT * FROM comments WHERE eid = '{$id}' order by date";
			if(!$result_c = @mysql_query($sql_c))
			{
				print "<p>error ".mysql_error()."</p>";
			}
			else 
			{
				if(@mysql_num_rows($result_c) > 0)
				{
					print "<h2 id=\"c\">Kommentarer</h2>\n";
					while($row_c = @mysql_fetch_array($result_c))
					{
						extract($row_c);
						$data = "<div class=\"comment\">\n";
						$data .= format_entry($c_text);
						$data .= "<p class=\"komm\">$c_author";
						if(!empty($c_url))
						{
							$data .= " | <a title=\"Bes�g {$c_author} p� nettet\" href=\"{$c_url}\">web</a>";
						}
						if(!empty($c_email))
						{
							$data .= " | <a title=\"Skriv en email til {$c_author}\" href=\"mailto:".spam_safe($c_email)."\">@</a>";
						}
						
						$c_date = date("G:i / d.m / Y", $date);
						$c_date = strtolower($c_date);
						$data .= " / {$c_date}";
						$data .= "</p>\n";
						print $data;
						print "</div>\n";
					}
				}

			}
			if($comments == 'on')
			{
				@include('incs/includes.inc.php');
				print $comments_form;
			}
			print "</div>\n";
			}
	}
	else
	{
		#print "<p>Der findes ingen indl�g med den adresse.</p>";
		#print "<p>{$sql}</p>";
	}
}

function display_front_page($lastentries)
{
	global $install_path;
	$sql = "SELECT
	entries.title, 
	entries.text, 
	entries.text_more,
	authors.uid, 
	entries.date, 
	entries.aid, 
	entries.id, 
	entries.comments,
	authors.name 
		FROM
	entries, 
	authors 
		WHERE 
	entries.aid = authors.uid
	 	AND
	entries.status = '1'
	 	ORDER BY 
	entries.date 
	 	DESC LIMIT 0,{$lastentries}";
	
	$result = @mysql_query($sql);

	if(!$result)
	{
		print "<h4>Knas med databasen, pr�v igen lidt senere.</h4><p>".mysql_error()."</p>";
		$no_success = 1;
	} else 
	{
	while($row = mysql_fetch_array($result))
	{
		extract ($row);
		$hour = date("G:i", $date);
		$day = date("d.m.Y", $date);
		$title_d = dirify($title);
		$date = date('dmy', $date);
		print "<div class='entry'>\n";
		print "<h1><img src='/img/permlink.gif' alt='permalink' />{$title}</h1>\n";
		print stripslashes(format_entry($text));
        if(!empty($text_more))
        {
            print "<p><a href=\"{$date}/{$title_d}#mere\" style=\"font-weight: bold\" title=\"Klik for at l�se mere af '{$title}'\">L�s mere...</a></p>";
        }
#		print "</p>";
		if($comments == 'on')
		{
			$sql2 = "SELECT c_text, c_author, date eid FROM comments WHERE comments.eid = '{$id}'";
			if(!$result2 = @mysql_query($sql2))
			{
				print "<p>Error performing query: " . mysql_error() . "</p>";
				exit();
			}
			else
			{
				#$count_comments = @mysql_num_rows($result2);
				switch ($count_comments = mysql_num_rows($result2))
				{
					case 1:
					print "<p class=\"byline\">{$day} @ {$hour} | <a href=\"{$install_path}/{$date}/".dirify($title)."#c\" title=\"{$count_comments} har tilf�jet noget\">Kommentar [ {$count_comments} ]</a> | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";
					break;
					
					case 0:
					print "<p class=\"byline\">{$day} @ {$hour} | <a href=\"{$install_path}/{$date}/".dirify($title)."#ca\" title=\"Noget at tilf�je?\">Kommentarer [ {$count_comments} ]</a> | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";
					break;
					
					default:
					print "<p class=\"byline\">{$day} @ {$hour} | <a href=\"{$install_path}/{$date}/".dirify($title)."#c\" title=\"{$count_comments} har tilf�jet noget\">Kommentarer [ {$count_comments} ]</a> | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";
					break;
				}
			}
		}
		else
		{
			print "<p class=\"byline\">{$day} @ {$hour} | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";

		}
		print '<div class="splitter"></div>';
		print "</div>\n";
	}
	}
	
}

function display_archive_entry()
{
	global $install_path;
	$url_expl = array_reverse(explode("/", $_SERVER['REQUEST_URI']));
	list($month, $year) = explode(".",$url_expl[0]);
	$sql = "
	SELECT
		*
	FROM
		entries
	WHERE
		FROM_UNIXTIME(entries.date, '%M') = '{$month}'
	AND
		FROM_UNIXTIME(entries.date, '%Y') = '{$year}'
	AND
		entries.status = '1'
	ORDER BY
		entries.date
	DESC";
	$result = @mysql_query($sql);
	
	if(!$result)
	{
		print "<p>Error performing query 1: ".mysql_error()."</p>\n";
	}
	
	$u_expl[0] = dateify($u_expl[0]);
	print '<h1 class="arkiv">Arkiv for '.dateify($month).' m�ned, �r '.$year.'</h1>';

	while($row = @mysql_fetch_array($result))
	{
		extract ($row);
		$hour = date("G:i", $date);
		$day = date("d.m.Y", $date);
		$title_d = dirify($title);
		$date = date('dmy', $date);
		$post_head = "<div class='entry'>\n";
		$post_head .= "<h1><img src='/img/permlink.gif' alt='permalink' />{$title}</h1>";
#		$post_head .= "<p class=\"date\">{$edate}</p>\n";
		$post_head .= stripslashes(format_entry($text));
		if(!empty($text_more))
		{
			$post_head .= "<p><a href=\"/{$date}/{$title_d}#mere\" style=\"font-weight: bold\" title=\"L�s mere af '{$title}'\">L�s mere...</a></p>";
		}
#		$post_head .= "</p>";
		print $post_head;
		$title_slashed = addslashes($title);
		if($comments == 'on')
		{
			$sql2 = "SELECT entries.title, comments.eid, entries.id FROM ".$db_name.".comments, ".$db_name.".entries WHERE entries.title LIKE ('{$title_slashed}') AND comments.eid = entries.id";
			if(!$result2 = @mysql_query($sql2))
			{
				print "<p>Error performing query: " . mysql_error() . "</p>";
				exit();
			}
			else 
			{
				#$count_comments = @mysql_num_rows($result2);
				switch ($count_comments = mysql_num_rows($result2))
				{
					case 1:
					print "<p class=\"byline\">{$day} @ {$hour} | <a href=\"{$install_path}/{$date}/".dirify($title)."#c\" title=\"{$count_comments} har tilf�jet noget\">Kommentar [ {$count_comments} ]</a> | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";
					break;
					
					case 0:
					print "<p class=\"byline\">{$day} @ {$hour} | <a href=\"{$install_path}/{$date}/".dirify($title)."#ca\" title=\"Noget at tilf�je?\">Kommentarer [ {$count_comments} ]</a> | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";
					break;
					
					default:
					print "<p class=\"byline\">{$day} @ {$hour} | <a href=\"{$install_path}/{$date}/".dirify($title)."#c\" title=\"{$count_comments} har tilf�jet noget\">Kommentarer [ {$count_comments} ]</a> | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";
					break;
				}
			}
		}
		else
		{
			print "<p class=\"byline\">{$day} @ {$hour} | <a title=\"Permanent link til '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">Permalink</a></p>\n";
		}
		print "</div>\n";
	}
}

function display_archive_months()
{
	global $install_path;
	print '<select id="ark" onchange="document.location=options[selectedIndex].value;"><option>Arkiv</option>
	';
	$sql_year = "SELECT DISTINCT(FROM_UNIXTIME(date, '%Y')) as year FROM ".$db_name.".entries ORDER BY date DESC";
	if(!$result_year = @mysql_query($sql_year))
	{
		print "Error: ".mysql_error();
	}
	else
	{
		while($row = @mysql_fetch_array($result_year))
		{
			extract($row);
			print '<option>---'.$year.'---</option>
			';
			$sql_date = "SELECT DISTINCT(FROM_UNIXTIME(date, '%M')) as date_month FROM ".$db_name.".entries where FROM_UNIXTIME(date, '%Y') = '{$year}' ORDER BY date DESC";
			if(!$result_date = @mysql_query($sql_date))
			{
				print "Error: ".mysql_error();
			}
			while($row2 = @mysql_fetch_array($result_date))
			{
				extract($row2);
				$date_u = $date_month;
				$date = dateify($date_month);
				print "<option value=\"{$install_path}/arkiv/{$date_u}.{$year}\">".ucwords($date)."</option>\n";
			}
		}
	}
	print "</select>\n";
}
?>