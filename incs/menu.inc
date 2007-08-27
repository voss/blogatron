<form style="display:inline;" action="/do_search.php" method="get" id="searchform" onsubmit="if(this.q.value=='Search' || this.q.value=='') { alert('Please write a valid query'); this.q.select(); return false;} else { this.submit();}">
	<div style="display:inline;">
		<input type="text" name="q" value="Search" onclick="this.select()" style="width: 100px;" />
	</div>
</form>
