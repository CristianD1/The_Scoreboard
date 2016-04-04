<?php

include 'conn.php';

$db = new Db();

$userID = intval($_SESSION['personID']);

// Get user info
$playerInfo = $db->select("SELECT FirstName, LastName, AboutMe FROM Persons WHERE PersonID = ".$userID.";");
$playerInfoRetval = Array(
    'firstName' => $playerInfo[0]['FirstName'],
    'lastName'  => $playerInfo[0]['LastName'],
    'aboutMe'   => $playerInfo[0]['AboutMe']
  );
//var_dump($playerInfoRetval);

// Get games played info
$gamesPlayedRetVal = Array();
$gamesPlayed = $db->select("SELECT * FROM GamesPlayed WHERE Player1ID==".$userID." OR Player2ID==".$userID." OR Player3ID==".$userID." OR Player4ID==".$userID." ORDER BY GameID DESC LIMIT 25;");
if($gamesPlayed != false){
  foreach($gamesPlayed as $game){
    if($game['Player1ID'] != null){ $p1 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player1ID'].";"); }
    if($game['Player2ID'] != null){ $p2 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player2ID'].";"); }
    if($game['Player3ID'] != null){ $p3 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player3ID'].";"); }
    if($game['Player4ID'] != null){ $p4 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player4ID'].";"); }
    $tempGameInfo = Array(
        'gameType'    => $game['GameType'],
        'p1Name'      => $p1[0]['FirstName'].' '.$p1[0]['LastName'],
        'p2Name'      => $p2[0]['FirstName'].' '.$p2[0]['LastName'],
        'team1Score'  => $game['Team1Score'],
        'p3Name'      => $p3[0]['FirstName'].' '.$p3[0]['LastName'],
        'p4Name'      => $p4[0]['FirstName'].' '.$p4[0]['LastName'],
        'team2Score'  => $game['Team2Score']
      );
    array_push($gamesPlayedRetVal, $tempGameInfo);
  }
}else{
  $gamesPlayedRetVal = Array(
      'error' => 'No games have been played.'
    );
}
//var_dump($gamesPlayedRetVal);

// Get foosball info
$foosball = $db->select("SELECT wins, elo, @rownum:=@rownum + 1 AS rank FROM FoosballSingles WHERE PersonID = ".$userID." ORDER BY elo ASC LIMIT 25;");
if($foosball != false){
  $foosballRetVal = Array(
      'wins'  => $foosball[0]['wins'],
      'elo'   => $foosball[0]['elo'],
      'rank'  => $foosball[0]['rank']
    );
}else{
  $foosballRetVal = Array(
      'error' => 'No Foosball scores found.'
    );
}
//var_dump($foosballRetVal);

// Get pingpong info
$pingpong = $db->select("SELECT wins, elo, @rownum:=@rownum + 1 AS rank  FROM PingPongSingles WHERE PersonID = ".$userID." ORDER BY elo ASC LIMIT 25;");
if($pingpong != false){
  $pingpongRetVal = Array(
      'wins'  => $pingpong[0]['wins'],
      'elo'   => $pingpong[0]['elo'],
      'rank'  => $pingpong[0]['rank']
    );
}else{
  $pingpongRetVal = Array(
      'error' => 'No Ping Pong scores found.'
    );
}
//var_dump($pingpongRetVal);


$playerInfoRetval = "'".json_encode($playerInfoRetval)."'";
$gamesPlayedRetVal = "'".json_encode($gamesPlayedRetVal)."'";
$foosballRetVal = "'".json_encode($foosballRetVal)."'";
$pingpongRetVal = "'".json_encode($pingpongRetVal)."'";

// Returns:
//  $playerInfoRetval
//  $gamesPlayedRetVal
//  $foosballRetVal
//  $pingpongRetVal

?>
