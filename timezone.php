<?php

print("Serverens tidszone er: " . getenv('TZ') . "<br>\n");
print("Klokken på serveren er: " . date("H:i:s") . "<br><br>\n");
print("Skifter tidszone til  København....<br><br>\n");
putenv("TZ=Europe/Copenhagen");
print("Klokken på serveren er nu: " . date("H:i:s") . "<br>\n");
print("Tidszonen for dette script er nu: " . getenv('TZ')."<br><br>");
print("Skifter tidszone til  Dublin....<br><br>\n");
putenv("TZ=Europe/Dublin");
print("Klokken på serveren er nu: " . date("H:i:s") . "<br>\n");
print("Tidszonen for dette script er nu: " . getenv('TZ'));


?>
