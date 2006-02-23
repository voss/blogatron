<?php
header('content-type: text/css');

$style = '

/*<group=basic layout elements>*/

body {
	padding: 0px;
	margin: 0;
	color: #000;
	background: #fff;
	font-family: \'lucida grande\', \'trebuchet ms\', trebuchet, verdana, sans-serif;
}

#container {
	width: 75%;
	\\width: 80%;
	w\\idth: 75%;
	max-width: 800px;
	margin-left: auto;
	margin-right: auto;
	padding: 10px 0 0 0;
	background: #fff;
}

#top * {
	text-decoration: none;
}

#top {
	padding: 33px;
	text-align:center;
	margin-bottom: 0px;
	color: inherit;';
	


/*  Do PHP-stuff here
*/
$random = mt_rand(0,1);

switch($random) 
{
	case 0:
	$style .= 'background: url(\'/img/top.jpg\') top center no-repeat #fff;';
	break;
		
#	case 1:
#	$style .= 'background: url(\'/img/bryggen.jpg\') bottom right no-repeat #ACB7D7;';
#	break;
	
	case 1:
	$style .= 'background: url(\'/img/tallbuilding.jpg\') bottom right no-repeat #fff;';
	break;
	
/*	case 3:
	$style .= 'background: url(\'/img/for_the_love_yall.jpg\') bottom right no-repeat #6f7170;';
	break;
	
	case 4:
	$style .= 'background: url(\'/img/solopg2k2002.jpg\') bottom right no-repeat #fff;';
	break;
*/
}

$style .= '
	border-bottom: 1px dashed #36f;
	font-size: 26px;
	display: block;
}

#top a {
	font-family: georgia, serif;
}

#footer {
	clear: both;
	padding: 0px;
	text-align: center;
	background: #e9e9ff;
	border-bottom: 1px solid #eee;
	border-top: 1px solid #eee;
}

#footer p {
	font-size: x-small;
	color: #669;
	background: inherit;
	margin: 0;
	padding: 10px;
	letter-spacing: 2px;
	font-variant: small-caps;
}

#footer p a:link, #footer p a:visited, #footer p a:hover {
	font-size: x-small;
	color: #00f;
	background: inherit;
	margin: 0;
	padding: 3px;
	font-weight: lighter;
}

.imgright {
	height: 128px;
	width: 170px;
	padding: 0;
	margin: 0;
}

img {
	border: 0;
}

h1, h2, h3 {
	margin: 0;
	padding: 10px 0 0 0;
	color: #c30;
	background: inherit;
}

h1, h2, h3 {
	font-size: medium;
	font-family: \'lucida grande\', georgia, palatino, serif;
	voice-family: "\\"}\\"";
	font-size: 14px;
}

p {
	font-size: small;
	line-height: 1.5em;
}
	
/*</group>*/

/*<group=mlist>*/

#mlist {
	padding: 16px;
	padding-right: 1px;
	margin-right: 0;
	text-align: right;
}

#mlist ul, #mlist li {
	display: inline;
	margin: 0;
	padding: 0;
	color: #339;
	background: inherit;
	font-size: x-small;
	font-weight: bold;
}

#mlist li:before {
	content:"ª";
	color: #b50100;
	background: inherit;
}

#mlist a:link {
	color: #232;
	background: inherit;
}

#mlist a:visited {
	color: #343;
	background: inherit;
	text-decoration: none;
}

#mlist a:hover {
	color: #b50100;
	background: inherit;
	text-decoration: none;
}
	
/*</group>*/

/*<group=right column>*/


div#rightc p {
	margin:0;
	margin-right: 5px;
	padding: 15px 15px 0 0;
	font-size: x-small;
}

#rightc h1 {
	text-align: left;
	padding-top: 10px;
	padding-left: 0px;
	margin-right: 0;
	font-size: medium;
/*	border-bottom: 1px solid #996; */
	color: #336;
	background: inherit;
}

div#rightc ul {
	list-style: none;
}

#rightc ul, #rightc li {
	line-height: 1.5em;
	margin: 0;
	padding: 0;
	font-size: x-small;
}

.unit {
	text-align: left;
	width: 90%;
	margin-top: 0;
	padding: 5px 7px 10px 0px;
}

#rightc .unit a {
	color: #006;
	background: inherit;
	text-decoration: none;
	border-bottom: 1px solid #ccf;
}

#rightc .unit a:visited {
	color: #44f;
	background: inherit;
	text-decoration: none;
	border-bottom: 1px solid #ccf;
}

#rightc .unit a:hover {
	color: #000;
	background: #ddf;
	text-decoration: none;
	border-bottom: 1px solid #00f;
}

div#rightc {
	float: right;
	width: 174px;
	margin-left: 0;
	padding-left: 0;
	padding-top: 20px;
	margin-right: 0;
	font-size: x-small;
	color: #000;
	text-align: right;
}
	
/*</group>*/

/*<group=content styling>*/

div#content {
	padding: 10px;
	margin-right: 176px;
	margin-top: 0;
	background: #fff;
	color: #000;
}

div#content p {
	padding-left: 30px;
	padding-right: 10px;
}

div#content h2 {
	font-size: medium;
	font-weight: lighter;
}

div#content a:link {
	color: #006;
	text-decoration: none;
	border-bottom: 1px solid #006;
	background: inherit;
}

div#content a:visited {
	color: #006;
	border-bottom: 1px solid #aaf;
	background: inherit;
	text-decoration: none;
}

div#content a:hover {
	text-decoration: none;
	border-bottom: 1px solid #00f;
	color: #005;
	background: #ddf;
}
div#content ul, ol {
	padding-left: 45px;
}

div#content ul {
	list-style: square;
}

div#content li {
	font-size: small;
	line-height: 1.5em;
}
	
/*</group>*/


/*<group=entry styling>*/

p#tilladt {
	font-size: x-small;
	border: 1px solid #99c;
	margin: 0 60px 0 30px;
	padding: 10px;
}

.head {
	border-bottom: 1px solid #bbf;
}

.entry {
	padding: 10px;
	margin-bottom: 20px;
	margin-right: 40px;
	color: #000;
	background: inherit;
	clear: left;
/*	border: 1px dotted #666; */
}

.entry h1 {
	display: inline;
	font-family: georgia, serif;
	padding-top: 10px;
}

.entry h1 a {
	margin-left: 8px;
}

.entry h2 {
	clear: left;
}

.entry img {
	border: 1px solid #999;
}

.date {
	color: #444;
	background: inherit;
	margin: 0;
	font-size: xx-small;
	padding: 5px 0 3px 0;
}

.harkiv {
	color: #000;
	background: inherit;
}

div#content div#entrya p {
	line-height: .3em;
	font-size:small;
}
	
/*</group>*/

/*<group=forms>*/

div#add, form#edit {
	margin-left: 20px;
}

div#add fieldset {
	border: 0;
}

form#mail {
	font-family: \'lucida grande\', georgia, palatino, serif;
	font-size: small;
	color: #000;
	background: inherit;
	line-height: 20px;
	margin-left: 30px;
}

form#mail input:hover, form#mail textarea:hover {
	color: #000;
	background: #eee;
}


form#search {
	margin: 0;
	padding-top: 2px;
	padding-left: 2px;
	text-align: left;
}

input#search {
}

form#search input {
	font-size: small;
}

form#search input:hover {
	background: #F9FFF9;
	color: #000;
}

fieldset.transmo {
	border: none;
	padding-left: 0;
	margin-left: 0;
	border-top: 1px solid #600;
}

fieldset.transmo textarea {
	border: 1px solid #600;
}

fieldset.transmo input {
	font-size: small;
}

form#b2s {
	font-size: small;
	padding-top:10px;
}

fieldset#b2sec {
	border: none;
	border-top: 1px solid #600;
}

fieldset#b2sec input {
	margin-bottom:10px;
	border: 1px solid #600;
}
	
/*</group>*/

/*<group=kommentarer>*/

form#ca {
	border: 0;
}

form#ca input {
	border: 1px solid black;
	font-size: small;
}

form#ca input:hover, form#ca textarea:hover {
	background: #f6f6f6;
	color: #000;
}

form#ca textarea {
	width: 250px;
}

form#ca div {
	margin-top: 10px;
	border: 0;
	font-weight: lighter;
	color: #000;
	background: inherit;
	line-height: 20px;
}

form#ca input[type="submit"]:hover {
	background: #f0e7d7;
	color: black;
}

form#ca input[type="reset"]:hover {
	background: #f0e7d7;
	color: black;
}

.comment * {
	font-size: x-small;
}

.comment {
	margin: 10px 30px 10px 30px;
	border: 1px dotted #7d9478;
	padding: 0;
}

.comment p {
	line-height: 1.4em;
	margin: 0;
	padding: 5px;
}

.komm {
	font-size: x-small;
	clear: left;
}

.kage {
	font-size: x-small;
}
	
/*</group>*/


/*<group=misc.>*/

abbr, acronym {
	border-bottom: 1px dotted #999;
}

blockquote {
	font-family: \'lucida sans\', \'trebuchet ms\', trebuchet, verdana, arial, sans-serif;
	border-left: 1px solid #bbb;
	padding-left: 0px;
	margin-left: 30px;
	display: block;
	color: #333;
	background: inherit;
}

q {
	font-family: \'lucida sans\', \'trebuchet ms\', trebuchet, verdana, arial, sans-serif;
/*	font-style: italic; */
	color: #333;
	background: inherit;
}

.red {
	color: red;
	font-weight: bold;
	background: transparent;
}

code {
	font-family: monospace;
	font-size: small;
	color: #000;
	background: inherit;
}

em {
	font-family: \'lucida sans\', \'trebuchet ms\', trebuchet, helvetica, verdana, arial, sans-serif;
}

#result {
	color: black;
	background: #F3FFF3;
	border: 1px solid #666;
	padding: 8px;
	text-align: left;
}

ul#services {
	padding-left: 40px;
	margin: 0;
}

ul#services li {
	padding-bottom: 10px;
}
	
/*</group>*/

';

print $style;

?>
