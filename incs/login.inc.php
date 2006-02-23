<?php

# Check for valid user, set cookie and redirect if valid, otherwise print error message and loginform:
if(isset($_POST['name']) && isset($_POST['passwd'])) {
	$name = $_POST['name'];
	$passwd = $_POST['passwd'];
	$sql ="select name from authors where passwd = MD5('$passwd')";
	if(!$result = mysql_query($sql)) {
		print "DB-Error...";
		print_footer();
		exit();
	} else {
		$login_check = mysql_num_rows($result);
		if($login_check > 0) {
		#	print "error!";
			setcookie("blog","1", time()+3600*24, "/");
			header("Location: http://localhost{$_SERVER['REQUEST_URI']}");
		#	print "no error!";
		} else {
			print "<p>Wrong username or password provided. Please try again.</p>";
		}
	}	
}

?>
