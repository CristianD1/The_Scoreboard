<?php


// This whole file needs to be re-written to rank individuals rather than teams



include 'conn.php';

$db = new Db();

$retVal = array(
    'teamRanking' => array(),
    'matchesList' => array()
  );

$teamsList = $db->select("SELECT * FROM FooseballTeams WHERE NOT(PersonID1 IS NULL AND PersonID2 IS NULL) ORDER BY elo desc LIMIT 20;");
if($teamsList != false){
  foreach($teamsList as $team){

    $p1Name = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID=".$team['PersonID1'].";");
    $p2Name = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID=".$team['PersonID2'].";");

    $retValJSONArray = array(
        'teamID'        => $team['TeamID'],
        'teamName'      => $team['TeamName'],
        'Person1'       => $p1Name[0]['FirstName'] . " " . $p1Name[0]['LastName'],
        'Person2'       => $p2Name[0]['FirstName'] . " " . $p2Name[0]['LastName'],
        'wins'          => $team['wins'],
        'elo'           => $team['elo'],
        'aboutTeam'     => $team['AboutTeam'],
        'matchesPlayed' => $team['MatchesPlayed']
      );

    array_push($retVal['teamRanking'], $retValJSONArray);
  }
}else{
  array_push($retVal['teamRanking'], Array('error'  =>  'No foosball teams have been found.'));
}


$matchesList = $db->select("SELECT * FROM GamesPlayed ORDER BY GameID desc LIMIT 10;");
if($matchesList != false){
  foreach($matchesList as $match){
    
    $team1Name = $db->select("SELECT TeamName FROM FooseballTeams WHERE TeamID=".$match['Team1ID'].";");
    $team2Name = $db->select("SELECT TeamName FROM FooseballTeams WHERE TeamID=".$match['Team2ID'].";");

    $retValJSONArray = array(
        'gameID'        => $match['GameID'],
        'team1Name'     => $team1Name[0]['TeamName'],
        'team1Score'    => $match['Team1Score'],
        'team2Name'     => $team2Name[0]['TeamName'],
        'team2Score'    => $match['Team2Score']
      );

    array_push($retVal['teamRanking'], $retValJSONArray);
  }
}else{
  array_push($retVal['teamRanking'], Array('error'  =>  'No games played.'));
}

$retVal = "'".json_encode($retVal)."'";

?>
