<!DOCTYPE html>
<html>
<head>
	<title>Get trustee's repay</title>
</head>
<body>
<?php 

  include "./trustgameinfo.php";
  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $firstagent_state=CreateFirstagent($lccengineaddress,$institutionname,$gameprotocol_id,$firstagent_id,$firstagent_role);//create first agent 
    $interactionid_trusteeside=GetInteractionId($firstagent_state,$lccengineaddress,$institutionname);
    if ($interactionid_trusteeside!=""){//firstagent has been created successfully
      $interactionpath="http://{$lccengineaddress}/interaction/user/manager/{$institutionname}/{$interactionid_trusteeside}";
      CreateOtherAgent($lccengineaddress,$institutionname,$interactionid_trusteeside,$secondagent_id,$secondagent_role);//create second agent
      sleep(1);
      $allagentsstates_json=getrequest($interactionpath);
      $allagentsstates=json_decode($allagentsstates_json,true);
      
      if (count($allagentsstates["agents"])==2){//all two agents have been created successfully
        //$firstagent_nextstep_1=AskAgentNextStep($lccengineaddress,$institutionname,$interactionid_Trusteeside,$firstagent_id);
        //$investoroffer_now=$investoroffer;
        $investoroffer_now=getrandomoffer(2,$playerid,$sourcefiledir,$investorofferList);
        $trusteegetNum=$game_rate*$investoroffer_now;
        $firstagent_response_1="e(invest({$investoroffer_now}, {$secondagent_id}), _)";  
        AnswerAgentNextStep($lccengineaddress,$institutionname,$interactionid_trusteeside,$firstagent_id,$firstagent_response_1);
        sleep(1);  
        
        msgstorecsv("{$interactionid_trusteeside}","{$gameprotocol_id}","{$firstagent_id}","{$firstagent_role}","{$secondagent_id}","{$secondagent_role}","e(invest({$investoroffer_now}#{$secondagent_id}))","{$sourcefiledir}/gamemsgs.csv");
        mysql_insertmsgdata("{$interactionid_trusteeside}","{$gameprotocol_id}","{$firstagent_id}","{$firstagent_role}","{$secondagent_id}","{$secondagent_role}","e(invest({$investoroffer_now}#{$secondagent_id}))");
                           
      }
      else{
        echo "Failed to create the second agent. *_*<br><br>";
      }
    }else{
      echo "Failed to create new interaction. *_* <br><br>";
    }
  }else{
      if (isset($_POST["trusteechoice"])){
        if(!empty($_POST["trusteechoice"])){
          $pattern="/(\w+)@(int\w+)@(\w+)/";
          $postdata=$_POST["trusteechoice"];
          preg_match($pattern,$postdata,$matches);
          $investoroffer_now=$matches[1];
          $interactionid_trusteeside=$matches[2];
          $trusteechoice_now=$matches[3];

          $trusteegetNum=$investoroffer_now*$game_rate;
         
          $finalrepay=$trusteechoice_now;

          $secondagent_response_1="e(repay({$finalrepay}, {$firstagent_id}), _)";
          AnswerAgentNextStep($lccengineaddress,$institutionname,$interactionid_trusteeside,$secondagent_id,$secondagent_response_1);
          sleep(1);
        
          msgstorecsv("{$interactionid_trusteeside}","{$gameprotocol_id}","{$secondagent_id}","{$secondagent_role}","{$firstagent_id}","{$firstagent_role}","e(repay({$finalrepay}#{$firstagent_id}))","{$sourcefiledir}/gamemsgs.csv");
          mysql_insertmsgdata("{$interactionid_trusteeside}","{$gameprotocol_id}","{$secondagent_id}","{$secondagent_role}","{$firstagent_id}","{$firstagent_role}","e(repay({$finalrepay}#{$firstagent_id}))");

          //store player info
          $playerinfo_pid=$playerid;
          $playerinfo_prole=$secondagent_role;
          $playerinfo_interid=$interactionid_trusteeside;
          $playerinfo_filedir="{$sourcefiledir}/playerinfo.csv";
          store_playerinfo("{$playerinfo_pid}","{$playerinfo_prole}","{$playerinfo_interid}","{$playerinfo_filedir}");
          mysql_insertplayerinfodata("{$playerinfo_interid}","{$playerinfo_pid}","{$playerinfo_prole}");

          $finalrepay_int=intval($finalrepay);
          $finalrepay_binary=decbin($finalrepay_int);
          
          header("Location:http://{$gameserveraddress}/mergedgame/tul/trustee2/investorreply.php?code=$finalrepay_binary");
        }elseif($_POST["trusteechoice"]==0){
          $pattern="/(\w+)@(int\w+)@(\w+)/";
          $postdata=$_POST["trusteechoice"];
          preg_match($pattern,$postdata,$matches);
          $investoroffer_now=$matches[1];
          $interactionid_trusteeside=$matches[2];
          $trusteechoice_now=$matches[3];

          $trusteegetNum=$investoroffer_now*$game_rate;
         
          $finalrepay=$trusteechoice_now;

          $secondagent_response_1="e(repay({$finalrepay}, {$firstagent_id}), _)";
          AnswerAgentNextStep($lccengineaddress,$institutionname,$interactionid_trusteeside,$secondagent_id,$secondagent_response_1);
          sleep(1);
        
          msgstorecsv("{$interactionid_trusteeside}","{$gameprotocol_id}","{$secondagent_id}","{$secondagent_role}","{$firstagent_id}","{$firstagent_role}","e(repay({$finalrepay}#{$firstagent_id}))","{$sourcefiledir}/gamemsgs.csv");
          mysql_insertmsgdata("{$interactionid_trusteeside}","{$gameprotocol_id}","{$secondagent_id}","{$secondagent_role}","{$firstagent_id}","{$firstagent_role}","e(repay({$finalrepay}#{$firstagent_id}))");

          //store player info
          $playerinfo_pid=$playerid;
          $playerinfo_prole=$secondagent_role;
          $playerinfo_interid=$interactionid_trusteeside;
          $playerinfo_filedir="{$sourcefiledir}/playerinfo.csv";
          store_playerinfo("{$playerinfo_pid}","{$playerinfo_prole}","{$playerinfo_interid}","{$playerinfo_filedir}");
          mysql_insertplayerinfodata("{$playerinfo_interid}","{$playerinfo_pid}","{$playerinfo_prole}");

          $finalrepay_int=intval($finalrepay);
          $finalrepay_binary=decbin($finalrepay_int);
          
          header("Location:http://{$gameserveraddress}/mergedgame/tul/trustee2/investorreply.php?code=$finalrepay_binary");
        }
      }
        
  }


?>



<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <?php sleep(1); 

    if ($investoroffer_now!=0){
      echo "The investor has decided to offer £ ";
      echo $investoroffer_now;
      echo " to you. ";
      echo "So you have £ ";
      echo $trusteegetNum;
      echo ". Please select your repay from: ";
    }else{
      echo "The investor offer £0. Please click the submit button.";
    }


  ?> 
  <select name="trusteechoice">
    <?php
      //include "../trucontrol/trustgameinfo.php";
        for ($i=0;$i<=$trusteegetNum;$i++){
          $int_offer="$investoroffer_now@$interactionid_trusteeside@$i";
          echo "<option value=$int_offer>$i</option>";
        }
    ?>
  </select>
  
  <input type='submit'><br><br>
</form>

<br>
<img src="smile2.png">

</body>
</html>