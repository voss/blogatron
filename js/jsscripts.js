// Make document.all[id] work like document.getElementById("id"), so we can actually make shit work in IE < 6 as well.
if(document.all && !document.getElementById) {
    document.getElementById = function(id) {
         return document.all[id];
    }
}

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


// function to add a little title tag automagically to links pointing to wikipedia:
function wikipediaTitles() {
	if (!document.getElementsByTagName) return false;
	if (!document.getElementById) return false;
	var contentwrapper = document.getElementById("left");
	var bloglinks = contentwrapper.getElementsByTagName("a");
	var regex = /wikipedia/;
	for (var i=0; i < bloglinks.length; i++) {
		if(regex.exec(bloglinks[i].href)) {
			var titleold = bloglinks[i].getAttribute("title");
			var titletext = 'Beskrivelse af '+titleold+' på wikipedia';
			bloglinks[i].setAttribute("title",titletext);
		}
	}
}

//function to validate comments input
function validateComment() {
	if (!document.getElementsByTagName) return false;
	if (!document.getElementById) return false;
	var requiredFields = document.getElementById("ca");
	if (requiredFields.c_author.value == '') {
		alert('You need to fill in a name.');
		requiredFields.c_author.focus();
		return false;
	}
	if (requiredFields.c_humanoid.value != '9')
	{
		alert('Your calculus seems off, 3 times 3 is not what you typed. Try again?')
		requiredFields.c_humanoid.select();
		return false;
	}
	
	if(requiredFields.c_text.value == '')
	{
		alert('You need to fill on some text in the comments field too post a comment.')
		requiredFields.c_text.focus();
		return false;
	}
	this.submit()
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

// Load more than one function at window.onload
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

addLoadEvent(wikipediaTitles); // addding opensidelinks function
//addLoadEvent(openexternallinks); // adding openexternallinks function
