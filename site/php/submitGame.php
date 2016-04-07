<?php

session_start();

include 'conn.php';

$db = new Db();

// team1ID: $('#team1Btn').data('tID'),
// team1Status: $('#t1Winner').data('win'),
// p1ID: $('#p1t1').data('pID'),
// p2ID: $('#p2t1').data('pID'),
// team2ID: $('#team2Btn').data('tID'),
// team2Status: $('#t2Winner').data('win'),
// p3ID: $('#p1t2').data('pID'),
// p4ID: $('#p2t2').data('pID')

$t1ID = $_POST['team1ID'];
$t2ID = $_POST['team2ID'];

$p1ID = $_POST['p1ID'];
$p2ID = $_POST['p2ID'];
$p3ID = $_POST['p3ID'];
$p4ID = $_POST['p4ID'];

$t1Status = $_POST['team1Status'];
$t2Status = $_POST['team2Status'];

$retVal = Array();

if( $t1Status != 1 && $t2Status != 1 ){

  $t1s = false;
  $t2s = false;
  if($t1Status == 1){
    $t1s = true;
  }else{
    $t2s = true;
  }

  $enterMatch = $db -> query("INSERT INTO GamesPlayed (Team1ID, Player1ID, Player2ID, Team1Won, Team2ID, Player3ID, Player4ID, Team2Won) VALUES (".$t1ID.",".$p1ID.",".$p2ID.",".$t1s.",".$t2ID.",".$p3ID.",".$p4ID.",".$t2s.");");

  

  // Do elo calculations here

  

  // end elo calculations






  $retVal = Array('success' => 'Match recorded. Probably?');

}else{
  $retVal = Array('error' => 'No winner was selected.');
}

$retVal = "'".json_encode($retVal)."'";

?>
