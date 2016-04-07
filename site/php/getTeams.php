<?php

include 'conn.php';

$db = new Db();

$teamList = $db->select("SELECT TeamID, TeamName, PersonID1, PersonID2 FROM Teams WHERE PersonID1 IS NOT NULL AND PersonID2 IS NOT NULL AND TeamName IS NOT NULL;");

$teamRetVal = Array();

foreach($teamList as $team){
  $p1N = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID=".$team['PersonID1'].";");
  $p2N = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID=".$team['PersonID2'].";");

  $retValJSON = Array(
      'teamID'        => $team['TeamID'],
      'teamName'      => $team['TeamName'],
      'p1ID'          => $team['PersonID1'],
      'p1Name'        => $p1N[0]['FirstName'] . ' ' . $p1N[0]['LastName'],
      'p2ID'          => $team['PersonID2'],
      'p2Name'        => $p2N[0]['FirstName'] . ' ' . $p2N[0]['LastName']
    );
  array_push($teamRetVal, $retValJSON);
}


$teamRetVal = json_encode($teamRetVal);

echo $teamRetVal;

?>