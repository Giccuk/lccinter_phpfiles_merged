<!DOCTYPE html>
<html>
<head>
	<title>Demo of interaction system</title>
</head>
<body>
<h2>Please click the button when you are ready for the game</h2>
<?php
include "mergedgameinfo.php";

?>
<input type="button" value="Start the game" onclick="location.href='http://<?php echo $gameserveraddress;?>/mergedgame/firstgame.php'" >
</body>