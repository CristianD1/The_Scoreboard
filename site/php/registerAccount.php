<?php

include 'conn.php';

$db = new Db();

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$aboutMe = $_POST["aboutMe"];
$securityCode = $_POST["securityCode"];

$defaultElo = 1000;

if ( $firstName && $lastName && $securityCode ) {
  echo $firstName . " " . $lastName . " " . $securityCode;

  $sqlfirstName = htmlspecialchars($db -> quote($firstName), ENT_QUOTES);
  $sqllastName = htmlspecialchars($db -> quote($lastName), ENT_QUOTES);
  $sqlaboutMe = htmlspecialchars($db -> quote($aboutMe), ENT_QUOTES);
  $sqlsecurityCode = $securityCode;
  $hashedCode = $db -> quote( hash("sha512", $sqlsecurityCode));

  echo "Starting sql";

  // Ensure duplicate person doesn't exist
  $checkDupes = $db -> select("SELECT Count(PersonID) as dupeCount FROM Persons WHERE SecurityCode=" . $hashedCode . ";");

  if($checkDupes[0]['dupeCount'] == 0){
    $result = $db -> query("INSERT INTO Persons (LastName, FirstName, SecurityCode, AboutMe) VALUES (" . $sqllastName . "," . $sqlfirstName . "," . $hashedCode . "," . $sqlaboutMe . ");");

    // Create user info in foosballSingles and pingpongSingles
    $userInfo = $db -> select("SELECT PersonID FROM Persons WHERE SecurityCode=".$hashedCode.";");
    $userID = $userInfo[0]['PersonID'];
    $foosballResult = $db -> query("INSERT INTO FoosballSingles (PersonID, wins, elo) VALUES (".$userID.", 0, ".$defaultElo.");");
    $pingPongResult = $db -> query("INSERT INTO PingPongSingles (PersonID, wins, elo) VALUES (".$userID.", 0, ".$defaultElo.");");
 
    include_once('signIn.php'); // Do a login
    echo "success";
  }else{
    echo "dupe";
    header('Location: ../accountContent.php');
  }

} else {
  echo "One or more necessary fields left blank.";
  header('Location: ../accountContent.php');
}

?>
