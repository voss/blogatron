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

function validPost()
{
	// start off valid
	valid = true;
	
	// set some shorthands
	var postTitle = document.postForm.title;
	var postText = document.postForm.text;
	var postMoreText = document.postForm.text_more;
	
	if(postTitle.value == '')
	{
		alert('Du skal give dit indlæg en titel.');
		postTitle.focus();
		return false;
	}
	
	if(postText.value == '')
	{
		alert('Du skal skrive noget tekst til dit indlæg.');
		postText.focus();
		return false;
	}
	
	 if (valid == true) {
	     document.postForm.submit();
	 }
	
	return false;
}

// Dalager hacks
function moveFlickr(){
    document.getElementById('newFlickr').innerHTML = document.getElementById('lazyFlickr').innerHTML==""?"<small>Flickr is down</small>":document.getElementById('lazyFlickr').innerHTML;
    document.getElementById('lazyFlickr').innerHTML = "";
}

function move23(){
    document.getElementById('new23').innerHTML = document.getElementById('lazy23').innerHTML==""?"<small>23 is down</small>":document.getElementById('lazy23').innerHTML;
    document.getElementById('lazy23').innerHTML = "";
}

function moveLastfm(){
    document.getElementById('newLastfm').innerHTML = document.getElementById('lazyLastfm').innerHTML==""?"<small>Lastfm is down</small>":document.getElementById('lazyLastfm').innerHTML;
    document.getElementById('lazyLastfm').innerHTML = "";
}