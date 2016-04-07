<?php

include 'conn.php';

$db = new Db();


$playerList = $db->select("SELECT FirstName, LastName, AboutMe, PersonID FROM Persons;");

$retVal = Array();

foreach($playerList as $player){
  $retValJSON = Array(
      'playerName'      => $player['FirstName'] . " " . $player['LastName'],
      'playerAbout'     => $player['AboutMe'],
      'playerID'        => $player['PersonID']
    );
  array_push($retVal, $retValJSON);
}


$retVal = json_encode($retVal);

echo $retVal;

?>