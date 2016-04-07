<?php

session_start();

include 'conn.php';

$db = new Db();

// HELPERS
function getNumerical($value){
  if(!is_int($value)){
    return 0;
  }
  return value;
}

// gameType: $('#gameTypeStorage').data('type'),
// team1ID: $('#team1Btn').data('tID'),
// team1Status: $('#t1Winner').data('win'),
// p1ID: $('#p1t1').data('pID'),
// p2ID: $('#p2t1').data('pID'),
// team2ID: $('#team2Btn').data('tID'),
// team2Status: $('#t2Winner').data('win'),
// p3ID: $('#p1t2').data('pID'),
// p4ID: $('#p2t2').data('pID')

$gameType = $_POST['gameType'];

$t1ID = $db->quote($_POST['team1ID']);
$t2ID = $db->quote($_POST['team2ID']);

$p1ID = $db->quote($_POST['p1ID']);
$p2ID = $db->quote($_POST['p2ID']);
$p3ID = $db->quote($_POST['p3ID']);
$p4ID = $db->quote($_POST['p4ID']);

$t1Status = $_POST['team1Status'];
$t2Status =$_POST['team2Status'];

$retVal = Array();

if( $t1Status == 1 || $t2Status == 1 ){ // a winner is chosen
  if( $gameType == 1 || $gameType == 2 ){ // a gametype is chosen
    if ( ($p1ID != '' || $p2ID != '') && ($p3ID != '' || $p4ID != '') ) { // 1 player per team

      $tableName = "";
      if($gameType == 1){
        $tableName = " FoosballSingles ";
      }else{
        $tableName = " PingPongSingles ";
      }

      $enterMatch = $db -> query("INSERT INTO GamesPlayed (GameType, Team1ID, Player1ID, Player2ID, Team1Won, Team2ID, Player3ID, Player4ID, Team2Won) VALUES (".$gameType.",".$t1ID.",".$p1ID.",".$p2ID.",".$t1Status.",".$t2ID.",".$p3ID.",".$p4ID.",".$t2Status.");");


      /* Do elo calculations */

        // Get team1 average elo
        $p1Elo = getNumerical($db -> select("SELECT elo FROM ".$tableName." WHERE PersonID=".$p1ID.";"));
        $p2Elo = getNumerical($db -> select("SELECT elo FROM ".$tableName." WHERE PersonID=".$p2ID.";"));
        $t1EloInitial = ($p1Elo + $p2Elo) / 2;

        // Get team2 average elo
        $p3Elo = getNumerical($db -> select("SELECT elo FROM ".$tableName." WHERE PersonID=".$p3ID.";"));
        $p4Elo = getNumerical($db -> select("SELECT elo FROM ".$tableName." WHERE PersonID=".$p4ID.";"));
        $t2EloInitial = ($p3Elo + $p4Elo) / 2;

        $K = 64; // How much games affect rankings

        // Transformed rating
        $r1 = pow(10, ($t1EloInitial/400));
        $r2 = pow(10, ($t2EloInitial/400));

        // Expected score
        $e1 = $r1 / ($r1 + $r2);
        $e2 = $r2 / ($r1 + $r2);

        // Get team elo change
        $r1 = $K * ($t1Status - $e1);
        $r2 = $K * ($t2Status - $e2);

        // Get player counts
        $team1PlayerCount = 1;
        if($p1ID != null && $p2ID != null){
          $team1PlayerCount = 2;
        }
        $team2PlayerCount = 1;
        if($p3ID != null && $p4ID != null){
          $team2PlayerCount = 2;
        }

        // Get per person elo change
        $r1 = $r1 / $team1PlayerCount;
        $r2 = $r2 / $team2PlayerCount;

        // Set new elos
        $updateElo1 = $db -> query("UPDATE ".$tableName." SET elo=elo+".$r1.", wins=wins+".$t1Status." WHERE PersonID=".$p1ID.";");
        $updateElo2 = $db -> query("UPDATE ".$tableName." SET elo=elo+".$r1.", wins=wins+".$t1Status." WHERE PersonID=".$p2ID.";");
        $updateElo3 = $db -> query("UPDATE ".$tableName." SET elo=elo+".$r2.", wins=wins+".$t2Status." WHERE PersonID=".$p3ID.";");
        $updateElo4 = $db -> query("UPDATE ".$tableName." SET elo=elo+".$r2.", wins=wins+".$t2Status." WHERE PersonID=".$p4ID.";");

      /* End elo calculations */

      $retVal = Array('success' => 'Match recorded. Probably?');
    }else{
      $retVal = Array('error' => 'At least 1 player per team.');
    }
  }else{
    $retVal = Array('error' => 'No game type was selected.');
  }
}else{
  $retVal = Array('error' => 'No winner was selected.');
}

$retVal = json_encode($retVal);

echo $retVal;

?>
