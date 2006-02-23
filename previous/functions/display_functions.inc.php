<?php

function display_entry_from_url()
{
	$expl = explode("/", $_SERVER['REQUEST_URI']);
	$entrydate = $expl[1];
	$e = undirify($expl[2]);
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
		print "<p>Error executing query: " . mysql_error() . "</p>\n";
	}
	if(@mysql_num_rows($result) == 1)
		{
		while($row = @mysql_fetch_array($result))
		{
			extract ($row);
			$hour = date("G:i", $date);
			$day = date("d.m.Y", $date);
			$date = date("G:i d. d.m || Y", $date);
			print "<div class='entry'>\n";
			print "<div class='head'>\n";
            print "<h1><img src='/img/permlink.gif' alt='' style=\"border: 0; vertical-align:middle; margin-right: 6px;\" />{$title}</h1>";
			print "</div>\n";
			print "<p class='date'>Kl. {$hour} d.{$day} af {$name}</p>\n";
			$text = stripslashes($text);
			print "{$text}\n";
            if(!empty($text_more))
            {
                $text_more = stripslashes($text_more);
                print "<div id=\"mere\">{$text_more}</div>\n";
            }
			$sql_c = "SELECT * FROM comments WHERE eid = '{$id}' order by date";
			if(!$result_c = @mysql_query($sql_c))
			{
				print "<p>error ".mysql_error()."</p>";
			}
			else 
			{
				if(@mysql_num_rows($result_c) > 0)
				{
					print "<h2 id=\"c\" style=\"font-size: medium;\">Kommentarer</h2>\n";
					while($row_c = @mysql_fetch_array($result_c))
					{
						extract($row_c);
						$data = "<div class=\"comment\">\n";
						$data .= "<p>{$c_text}</p>\n";
						$data .= "<p class=\"komm\">$c_author";
						if(!empty($c_url))
						{
							$data .= " | <a title=\"Besøg {$c_author} på nettet\" href=\"{$c_url}\">web</a>";
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
			print "<p>Der findes ingen indlæg med den adresse.</p>";
		#	print "<p>{$sql}</p>";
	}
}

function display_front_page($lastentries)
{
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
		print "<p>Error performing query: " . mysql_error() . "</p>";
		exit();
	}
	while($row = mysql_fetch_array($result))
	{
		extract ($row);
		$hour = date("G:i", $date);
		$day = date("d.m.Y", $date);
		$edate = strtolower(date("G:i || d.m || Y", $date));
#		$edate = strtolower($edate);
		$title_d = dirify($title);
		$date = date('dmy', $date);
		print "<div class='entry'>\n";
		print "<div class='head'>\n";
		print "<h1><a title=\"Permanent link til '{$title}'\" href=\"{$date}/{$title_d}\"><img src='/img/permlink.gif' alt='' style=\"border: 0; vertical-align:middle;\" /></a>{$title}</h1>";
		print "</div>\n";
		print "<p class=\"date\">Kl {$hour} d.{$day} af {$name}</p>\n";
		print stripslashes($text);
        if(!empty($text_more))
        {
            print "<p><a href=\"{$date}/{$title_d}#mere\" style=\"font-weight: bold\" title=\"Klik for at læse mere af '{$title}'\">Læs mere &raquo;</a></p>\n";
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
				$count_comments = @mysql_num_rows($result2);
				if(@mysql_num_rows($result2) == 1)
				{
					print "<p class=\"komm\"><a href=\"/{$date}/".dirify($title)."#c\" title=\"{$count_comments} har tilføjet noget\">Kommentar [ {$count_comments} ]</a></p>\n";
				} 
				elseif(@mysql_num_rows($result2) == 0)
				{
					print "<p class=\"komm\"><a href=\"/{$date}/".dirify($title)."#ca\" title=\"Noget at tilføje?\">Kommentarer [ {$count_comments} ]</a></p>\n";
				}
				else
				{
					print "<p class=\"komm\"><a href=\"/{$date}/".dirify($title)."#c\" title=\"{$count_comments} har tilføjet noget\">Kommentarer [ {$count_comments} ]</a></p>\n";
				}
			}
		}
		print "</div>\n";
	}
}

function display_archive_entry()
{
	$url_expl = explode("/", $_SERVER['REQUEST_URI']);
	list($month, $year) = explode(".",$url_expl[2]);
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
	print "<h1 class=\"harkiv\">Arkiv for ".dateify($month)." måned, år {$year}</h1>";

	while($row = @mysql_fetch_array($result))
	{
		extract ($row);
		$edate = date("G:i || d.m || Y", $date);
		$post_head = "<div class='entry'>\n";
		$post_head .= '<div class="head">';
		$post_head .= "<h1><a title=\"Permanent link til '{$title}'\"";
		$title_d = dirify($title);
		$date = date('dmy', $date);
		$post_head .= " href=\"/{$date}/{$title_d}\"><img style=\"border: 0; vertical-align:middle;\" src=\"/img/permlink.gif\" alt=\"\" /></a>{$title}</h1>\n";
		$post_head .= '</div>';
		$post_head .= "<p class=\"date\">{$edate}</p>\n";
		$post_head .= stripslashes($text);
		if(!empty($text_more))
		{
			$post_head .= "<p><a href=\"/{$date}/{$title_d}#mere\" style=\"font-weight: bold\" title=\"Læs mere af '{$title}' | Read more of '{$title}'\">Læs mere...</a></p>";
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
				$count_comments = @mysql_num_rows($result2);
				if(@mysql_num_rows($result2) > 0)
				{
					print "<p class=\"komm\"><a href=\"/{$date}/".dirify($title)."#c\">Kommentar [ {$count_comments} ]</a></p>\n";
				}
				else
				{
					print "<p class=\"komm\"><a href=\"/{$date}/".dirify($title)."#ca\">Kommentarer [ {$count_comments} ]</a></p>\n";
				}
			}
		}
		print "</div>\n";
	}
}

function display_archive_months()
{
	print '<select id="ark" onchange="document.location=options[selectedIndex].value;"><option>Arkiv</option>';
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
			print '<option>---'.$year.'---</option>';
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
				print "<option value=\"/arkiv/{$date_u}.{$year}\">".ucwords($date)."</option>";
			}
		}
	}
	print '</select>';
#	print '</form>';
	print "</div>\n";
}
?>
