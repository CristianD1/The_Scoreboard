<?php

session_start();

include 'conn.php';

$db = new Db();

$teamName = $_POST['teamName'];
$personID2 = intval($_POST['teammateID']);
$personID1 = intval($_SESSION['personID']);

$retVal = Array();

if( $teamName != null && $teamName != "" && $personID2 > 0 && $personID1 != $personID2) {

  // Check if a team with the same two people exists already
  $playerList = $db->select("SELECT Count(TeamID) AS resCount, TeamName FROM Teams WHERE (PersonID1=".$personID1." AND PersonID2=".$personID2.") OR (PersonID2=".$personID1." AND PersonID1=".$personID2.");");

  if($playerList[0]['resCount'] == 0){
    $result = $db -> query("INSERT INTO Teams (TeamName, PersonID1, PersonID2) VALUES (".$db->quote($teamName).", ".$personID1.", ".$personID2.");");

    $retVal = Array('success' => 'Team was created.');
  }else{
    $retVal = Array('error' => 'Group exists already: '.$playerList[0]['TeamName']);
  }


} else {
  $retVal = Array('error' => 'Some error occured.');
}

$retVal = json_encode($retVal);

echo $retVal;

?>