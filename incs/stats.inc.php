<?php

#file: stats.inc.php

# SQL for counting number of total posts:
#$sql_count_posts = "select aid, count(*) as stats from entries where status = '1' group by aid";
$sql_count_posts = "select count(*) as stats from entries where status = '1'";
$count_posts = @mysql_query($sql_count_posts);
while($row3 = @mysql_fetch_array($count_posts)) {
	extract($row3);
}
print "{$stats} indlæg og";

$sql_count_comments = "select count(*) as stats_comm from comments";
$count_comments = @mysql_query($sql_count_comments);
while($row4 = @mysql_fetch_array($count_comments)) {
	extract($row4);
}
print " {$stats_comm} kommentarer på bloggen.";
?>
