<?php

$sourcefiledir="/Applications/XAMPP/htdocs/lccgame_mysql_merged";
$gameserveraddress="localhost/lccgame_mysql_merged";
$lccengineaddress="localhost:8888";
$institutionname="game_institution";
$defaultinst="game_institution";

  //0.
  function getrequest($getpath){
    $curlrequest = curl_init();
    curl_setopt($curlrequest, CURLOPT_URL, $getpath);
    curl_setopt($curlrequest, CURLOPT_HEADER,0); 
    curl_setopt($curlrequest, CURLOPT_RETURNTRANSFER,true);
    $out_json=curl_exec($curlrequest);
    curl_close($curlrequest);

    return $out_json;
  }

?>