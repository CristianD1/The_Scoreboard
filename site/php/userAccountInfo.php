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
$gamesPlayed = $db->select("SELECT * FROM GamesPlayed WHERE Player1ID=".$userID." OR Player2ID=".$userID." OR Player3ID=".$userID." OR Player4ID=".$userID." ORDER BY GameID DESC LIMIT 25;");
if($gamesPlayed != false){
  foreach($gamesPlayed as $game){
    $p1 = '';
    $p2 = '';
    $p3 = '';
    $p4 = '';
    if($game['Player1ID'] != '0'){ 
      $p1 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player1ID'].";");
      $p1 = $p1[0]['FirstName'].' '.$p1[0]['LastName'];
    }
    if($game['Player2ID'] != '0'){ 
      $p2 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player2ID'].";"); 
      $p2 = $p2[0]['FirstName'].' '.$p2[0]['LastName'];
    }
    if($game['Player3ID'] != '0'){ 
      $p3 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player3ID'].";"); 
      $p3 = $p3[0]['FirstName'].' '.$p3[0]['LastName'];
    }
    if($game['Player4ID'] != '0'){ 
      $p4 = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID = ".$game['Player4ID'].";"); 
      $p4 = $p4[0]['FirstName'].' '.$p4[0]['LastName'];
    }

    $tempGameInfo = Array(
        'gameType'    => $game['GameType'],
        'p1Name'      => $p1,
        'p2Name'      => $p2,
        'team1Won'    => $game['Team1Won'],
        'p3Name'      => $p3,
        'p4Name'      => $p4,
        'team2Won'    => $game['Team2Won']
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
$foosball = $db->select("SELECT PersonID, wins, elo, @rownum:=@rownum + 1 AS rank FROM FoosballSingles, (SELECT @rownum:=0) rownum ORDER BY elo DESC LIMIT 25;");
if($foosball != false){
  foreach($foosball as $game){
    if($game['PersonID'] != $userID){

    }else{
      $foosballRetVal = Array(
        'wins'  => $game['wins'],
        'elo'   => $game['elo'],
        'rank'  => $game['rank']
      );
      break;
    }
  }
}else{
  $foosballRetVal = Array(
      'error' => 'No Foosball scores found.'
    );
}
//var_dump($foosballRetVal);

// Get pingpong info
$pingpong = $db->select("SELECT PersonID, wins, elo, @rownum:=@rownum + 1 AS rank  FROM PingPongSingles, (SELECT @rownum:=0) rownum ORDER BY elo DESC LIMIT 25;");
if($pingpong != false){
  foreach($pingpong as $game){
    if($game['PersonID'] != $userID){

    }else{
      $pingpongRetVal = Array(
        'wins'  => $game['wins'],
        'elo'   => $game['elo'],
        'rank'  => $game['rank']
      );
      break;
    }
  }
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
