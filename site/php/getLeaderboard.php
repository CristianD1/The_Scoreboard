<?php

include 'conn.php';

$db = new Db();

// Get games played info
$gamesPlayedRetVal = Array();
$gamesPlayed = $db->select("SELECT * FROM GamesPlayed ORDER BY GameID DESC LIMIT 25;");
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
$foosballRetVal = Array();
$foosball = $db->select("SELECT PersonID, wins, elo, @rownum:=@rownum + 1 AS rank FROM FoosballSingles, (SELECT @rownum:=0) rownum ORDER BY elo DESC LIMIT 25;");
if($foosball != false){
  foreach($foosball as $game){
    $pName = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID=".$game['PersonID'].";");

    $foosballTemp = Array(
        'name'  => $pName[0]['FirstName']." ".$pName[0]['LastName'],
        'wins'  => $game['wins'],
        'elo'   => $game['elo'],
        'rank'  => $game['rank']
      );
    array_push($foosballRetVal, $foosballTemp);
  }
}else{
  $foosballRetVal = Array(
      'error' => 'No Foosball scores found.'
    );
}
//var_dump($foosballRetVal);

// Get pingpong info
$pingpongRetVal = Array();
$pingpong = $db->select("SELECT PersonID, wins, elo, @rownum:=@rownum + 1 AS rank  FROM PingPongSingles, (SELECT @rownum:=0) rownum ORDER BY elo DESC LIMIT 25;");
if($pingpong != false){
  foreach($pingpong as $game){
    $pName = $db->select("SELECT FirstName, LastName FROM Persons WHERE PersonID=".$game['PersonID'].";");

    $pingpongTemp = Array(
        'name'  => $pName[0]['FirstName']." ".$pName[0]['LastName'],
        'wins'  => $game['wins'],
        'elo'   => $game['elo'],
        'rank'  => $game['rank']
      );
    array_push($pingpongRetVal, $pingpongTemp);
  }
}else{
  $pingpongRetVal = Array(
      'error' => 'No Ping Pong scores found.'
    );
}


$gamesPlayedRetVal = "'".json_encode($gamesPlayedRetVal)."'";
$foosballRetVal = "'".json_encode($foosballRetVal)."'";
$pingpongRetVal = "'".json_encode($pingpongRetVal)."'";

// Returns:
//  $playerInfoRetval
//  $gamesPlayedRetVal
//  $foosballRetVal
//  $pingpongRetVal

?>
