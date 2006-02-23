<?php

// Code for notifying Weblogs.com and others about updates using the 
// weblogUpdates.ping syntax - by Christian Schmidt
// The code may be freely used, copied, modified, distributed etc.


// Tilret blot følgende to linjer og indsæt så hele filen et passende sted i dit 
// weblog-system.
$weblog_name = '. verture.net | her skriver jeg .';
$weblog_url = 'http://blog.verture.net/';


function weblogUpdates_ping($host, $port, $path, $method, $name, $url, $debug = false) {
	$postdata = '<?xml version="1.0" encoding="iso-8859-1"?>
	   <methodCall>
	     <methodName>' . htmlspecialchars($method) . '</methodName>
	     <params>
	       <param><value><string>' . htmlspecialchars($name) . '</string></value></param>
	       <param><value><string>' . htmlspecialchars($url) . '</string></value></param>
	     </params>
 	   </methodCall>';

	$timeout = 20;

	$fp = fsockopen($host, $port, $errno, $errstr, $timeout);
	if (!$fp) {
		return array(-1, "Could not connect to $host:$port");
	}
	socket_set_timeout($fp, $timeout);
	
	$request = "POST $path HTTP/1.0\r\n" .
		"Host: $host\r\n" .
		"Content-Type: text/xml\r\n" .
		"User-Agent: Aggemam XML-RPC client\r\n" .
		"Content-Length: " . strlen($postdata) . "\r\n" .
		"\r\n" .
		$postdata;
	fputs($fp, $request);
	
	if ($debug) {
		print "<div style='color: blue; white-space: pre'>";
		print htmlspecialchars($request);
		print "</div>";
	}

	$response = '';
	while (!feof($fp)) {
		$response .= fgets($fp, 1024);
		
		$status = socket_get_status($fp);
		if ($status['timed_out']) {
			fclose($fp);
			return array(-2, "Request timed out");
		}
	}
	fclose($fp);

	if ($debug) {
		print "<div style='color: green; white-space: pre'>";
		print htmlspecialchars($response);
		print "</div>";
	}


	if (preg_match('|<methodResponse>\s*<params>\s*<param>\s*<value>\s*<struct>\s*' .
		'<member>\s*<name>flerror</name>\s*<value>\s*<boolean>([^<])</boolean>\s*</value>\s*</member>\s*' .
		'<member>\s*<name>message</name>\s*<value>(\s*<string>)?([^<]*)(</string>\s*)?</value>\s*</member>\s*' .
		'</struct>\s*</value>\s*</param>\s*</params>\s*</methodResponse>' .
		'|s', $response, $reg)) {

		return array($reg[1], $reg[3]);

	} else {

		return array(-3, "Malformed reply:\n" . $response);
	}
}



// Sites der skal pinges
$sites = array(
	array('host' => 'blogbot.dk',
		'port' => 80,
		'path' => '/io/xml-rpc.php',
		'method' => 'weblogUpdates.ping')/*,


	array('host' => 'rpc.weblogs.com',
		'port' => 80,
		'path' => '/RPC2',
		'method' => 'weblogUpdates.ping'),
	array('host' => 'ping.blo.gs',
		'port' => 80,
		'path' => '/',
		'method' => 'weblogUpdates.ping') */
);

// Hvis det ikke virker, som det skal, prøv da at sætte flg. til true
$debug = false;

foreach ($sites as $site) {
	print "<p style=\"padding: 10px;\">Pinger $site[host] ... ";
	flush();

	list($error, $message) = weblogUpdates_ping($site['host'], $site['port'], $site['path'], $site['method'], 
		$weblog_name, $weblog_url, $debug); 
		
	if ($error == 0) {
		print "<span class=\"red\">det virkede!</p>";
		
	} else {
		print "noget gik galt:</p>";
		print "<p style='font-size: smaller; color: red; white-space: pre'>" . htmlspecialchars($message) . "</p>";
	}
}

?>