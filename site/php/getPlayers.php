<?php

include 'conn.php';

$db = new Db();


// PINNED FOR SESSIONS
$userID = intval($_SESSION['personID']);; // Will be taken from session

$playerList = $db->select("SELECT FirstName, LastName, AboutMe, PersonID FROM Persons WHERE PersonID !=".$userID.";");

$retVal = Array();

foreach($playerList as $player){
  $retValJSON = Array(
      'playerName'      => $player['FirstName'] . " " . $player['LastName'],
      'playerAbout'     => $player['AboutMe'],
      'playerID'        => $player['PersonID']
    );
  array_push($retVal, $retValJSON);
}


$retVal = "'".json_encode($retVal)."'";

?>