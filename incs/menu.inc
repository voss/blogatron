<form style="display:inline;" action="/do_search.php" method="get" id="searchform" onsubmit="if(this.q.value=='Skriv søgeord' || this.q.value=='') { alert('Du skal skrive et gyldigt søgeord først.'); this.q.select(); return false;} else { this.submit();}">
	<div style="display:inline; padding-left: 30%;">
		<input type="text" name="q" value="Skriv søgeord" onclick="this.select()" style="width: 100px;" />
	</div>
</form>
