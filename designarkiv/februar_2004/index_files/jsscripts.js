// Script for making deletion of posts cancelable. Thanks to Andreas Haugstrup <solitude@solitude.dk>.
function checkDelete() {
	var value = confirm("Er du sikker på at du vil slette dette indlæg?");
	if (value == true) {
		return true;
	} else {
		return false;
	}
}

// Script for making deletion of posts cancelable. Thanks to Andreas Haugstrup <solitude@solitude.dk>.
function checkDeleteC() {
	var value = confirm("Er du sikker på at du vil slette denne kommentar?");
	if (value == true) {
		return true;
	} else {
		return false;
	}
}


// function for checking input in search box
function submit_search()
{
	if(this.q.value=='Skriv søgeord' || this.q.value=='')
	{
		alert('Du skal skrive et gyldigt søgeord først.');
		this.q.select();
		return false;
	}
	else
	{ 
		this.submit();
	}
}