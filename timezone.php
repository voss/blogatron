<?php

print("Serverens tidszone er: " . getenv('TZ') . "<br>\n");
print("Klokken p� serveren er: " . date("H:i:s") . "<br><br>\n");
print("Skifter tidszone til  K�benhavn....<br><br>\n");
putenv("TZ=Europe/Copenhagen");
print("Klokken p� serveren er nu: " . date("H:i:s") . "<br>\n");
print("Tidszonen for dette script er nu: " . getenv('TZ')."<br><br>");
print("Skifter tidszone til  Dublin....<br><br>\n");
putenv("TZ=Europe/Dublin");
print("Klokken p� serveren er nu: " . date("H:i:s") . "<br>\n");
print("Tidszonen for dette script er nu: " . getenv('TZ'));


?>
