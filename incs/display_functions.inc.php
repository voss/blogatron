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
		print "<h4>Problems with the database, please to try again later.</h4><p>".mysql_error()."</p>";
	}
	
	if(@mysql_num_rows($result) == 1)
		{
		while($row = @mysql_fetch_array($result))
		{
			extract ($row);
			$hour = date("G:i", $date);
			$day = date("d.m.Y", $date);
			print '<div class="entry">';
			print "<h1>{$title} <span style='color: #799dc6'>{$day}</span></h1>\n";
			print '<p class="byline">'.$hour.'</p>';
			$text = stripslashes(format_entry($text));
			print '<div class="ebody">';
			print "{$text}\n";
            if(!empty($text_more))
            {
                $text_more = stripslashes(format_entry($text_more));
                print "<div id=\"mere\">{$text_more}</div>\n";
            }
			print '</div>';
			$sql_c = "SELECT * FROM comments WHERE eid = '{$id}' order by date";
			if(!$result_c = @mysql_query($sql_c))
			{
				print "<p>error ".mysql_error()."</p>";
			}
			else 
			{
				if(@mysql_num_rows($result_c) > 0)
				{
					$comment_count = 1;
					print '<h2 id="c">Comments</h2>';
					while($row_c = @mysql_fetch_array($result_c))
					{
						extract($row_c);
#						$commentstyle = ($comment_count % 2) ? 'commentdark' : 'commentlight';
						$data = '<div class="'.$commentstyle.'">';
						#$commentnumber = ($comment_count % 2) ? 'commentnumberlight' : 'commentnumberdark';
						#$data .= '<div class="'.$commentnumber.'">'.$comment_count.'</div>';
						$data .= '<p class="komm">'.$c_author.'';
						if(!empty($c_url))
						{
							$data .= " | <a title=\"Besøg {$c_author} på nettet\" href=\"{$c_url}\" rel=\"nofollow\">web</a>";
						}
						if(!empty($c_email))
						{
							$data .= " | <a title=\"Skriv en email til {$c_author}\" href=\"mailto:".spam_safe($c_email)."\">@</a>";
						}
						
						$c_date = date("G:i / d.m / Y", $date);
						$c_date = strtolower($c_date);
						$data .= " / {$c_date}";
						$data .= "</p>\n";
						$data .= format_entry($c_text);
						print $data;
						print '<hr />';
						print "</div>\n";
						$comment_count++;
					}
				}

			}
			if($comments == 'on')
			{
				@include('incs/includes.inc.php');
				print $comments_form;
			}
/*			$sql_seek = "select * from entries;";
			$result_seek = mysql_query($sql_seek);
			mysql_data_seek($result_seek, 70);
			while ($row = mysql_fetch_array($result_seek)) {
				extract($row);
				print $id."--".$title."<br />";
				}
*/
			}
	}
	else
	{
		#print "<p>Der findes ingen indlæg med den adresse.</p>";
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
		print "<h4>Knas med databasen, prøv igen lidt senere.</h4><p>".mysql_error()."</p>";
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
					$actual_comments = 'Comment';
					break;
					
					default:
					$actual_comments = 'Comments';
					break;
				}
			}
		}
		print "<div class='entry'>\n";
		print "<h1><a title=\"Permanent link to '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">{$title}</a></h1>\n";
		print "<p class=\"byline\"><span style='color: #799dc6'>{$day}</span><br /> \n {$hour}<br /> \n <a href=\"{$install_path}/{$date}/".dirify($title)."#c\" title=\"{$count_comments} har tilføjet noget\">{$count_comments} {$actual_comments}</a></p>\n";
		print '<div class="ebody">'.stripslashes(format_entry($text));
        if(!empty($text_more))
        {
            print "<p><a href=\"{$date}/{$title_d}#mere\" style=\"font-weight: bold\" title=\"Click here to continue reading '{$title}'\">Continue reading '{$title}'...</a></p>";
        }
#		print '<div class="splitter"></div>';
		print "</div></div>\n";
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
	print '<h1 class="arkiv">Archive for '.$month.', '.$year.'</h1>';
	print '<ul>';
	while($row = @mysql_fetch_array($result))
	{
		extract ($row);
		$hour = date("G:i", $date);
		$day = date("d.m", $date);
		$title_d = dirify($title);
		$date = date('dmy', $date);
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
					$actual_comments = 'Comment';
					break;
					
					default:
					$actual_comments = 'Comments';
					break;
				}
			}
		}
		print "<li>{$day} <a title=\"Permanent link to '{$title}'\" href=\"{$install_path}/{$date}/{$title_d}\">{$title}</a>\n</li>";
	}
	print '</ul>';
}

function display_archive_months()
{
	global $install_path;
	print '<div style="padding-left: 15px; padding-bottom: 10px;">
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
			print '<h1>'.$year.'</h1>
			';
			$sql_date = "SELECT DISTINCT(FROM_UNIXTIME(date, '%M')) as date_month FROM ".$db_name.".entries where FROM_UNIXTIME(date, '%Y') = '{$year}' ORDER BY date DESC";
			if(!$result_date = @mysql_query($sql_date))
			{
				print "Error: ".mysql_error();
			}
			print '<ul>';
			while($row2 = @mysql_fetch_array($result_date))
			{
				extract($row2);
				$date_u = $date_month;
				$date = $date_month;
				print "<li><a href=\"{$install_path}/arkiv/{$date_u}.{$year}\">".ucwords($date)."</a></li>\n";
			}
			print '</ul>';
		}
	}
	print "</div>\n";
}

# For editing:
function display_archive_months_edit()
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
				print "<option value=\"{$install_path}/sheriff/ee.php?arcmonth={$date_u}.{$year}\">".ucwords($date)."</option>\n";
			}
		}
	}
	print "</select>\n";
}

# Grabs the title of the entry requested
function single_entry_title()
{
	$expl = array_reverse(explode("/", $_SERVER['REQUEST_URI']));
	$entrydate = $expl[1];
	$e = undirify($expl[0]);
	$e = trim($e);
	$sql = "SELECT *
			FROM 
		entries
			WHERE 
		entries.title LIKE ('$e%')
			AND
		entries.status = '1'
			AND
		FROM_UNIXTIME(entries.date, '%d%m%y') = '{$entrydate}'
			LIMIT 0,15";
	$result = @mysql_query($sql);

	if(!$result)
	{
		print "<h4>Problems with the database, please to try again later kthx bai</h4><p>".mysql_error()."</p>";
	}
	
	if(@mysql_num_rows($result) == 1)
	{
		while($row = @mysql_fetch_array($result))
		{
			extract ($row);
			return $title;
		}
	}
}


# Decide the <title>-tag for serving up single servings:
if ($_SERVER['REQUEST_URI'] != "/")
{
	$title_tag = single_entry_title();
}
else 
{
	$title_tag = $tagline;
}


?>
