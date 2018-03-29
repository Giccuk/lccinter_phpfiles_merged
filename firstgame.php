<?php  
include "mergedgameinfo.php";
	$defaultstate_json=getrequest("http://{$lccengineaddress}/institutions");echo '<br><br>';
    sleep(1);
    $defaultstate=json_decode($defaultstate_json,true);
    $subject=$defaultstate["0"]["path"];
    $pattern="/http:\/\/{$lccengineaddress}\/institution\/user\/manager\/(\w+)/";
    preg_match($pattern,$subject,$matches);
    if ($matches[1]=="{$defaultinst}"){
    	$gametype=rand(1,2);
		header("Location:http://{$gameserveraddress}/mergedgame/tul/trustee1/trusteeform2.php");
		/*if ($gametype==1){
			#echo "ultimatum game";
			header("Location:http://{$gameserveraddress}/mergedgame/ut/responderside/responderform.php");

		}else{
			#echo "trust game";
			header("Location:http://{$gameserveraddress}/mergedgame/tu/trusteeside/trusteeform2.php");
		}*/
	}

?>