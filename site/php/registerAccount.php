<?php

include 'conn.php';

$db = new Db();

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$aboutMe = $_POST["aboutMe"];
$securityCode = $_POST["securityCode"];

if ( $firstName && $lastName && $securityCode ) {
  echo $firstName . " " . $lastName . " " . $securityCode;

  $sqlfirstName = htmlspecialchars($db -> quote($firstName));
  $sqllastName = htmlspecialchars($db -> quote($lastName));
  $sqlaboutMe = htmlspecialchars($db -> quote($aboutMe));
  $sqlsecurityCode = htmlspecialchars($securityCode);
  $hashedCode = $db -> quote(htmlspecialchars(hash("sha512", $sqlsecurityCode)));

  echo "Starting sql";

  // Ensure duplicate person doesn't exist
  $checkDupes = $db -> select("SELECT Count(PersonID) as dupeCount FROM Persons WHERE SecurityCode=" . $hashedCode . ";");

  if($checkDupes[0]['dupeCount'] == 0){
    $result = $db -> query("INSERT INTO Persons (LastName, FirstName, SecurityCode, AboutMe) VALUES (" . $sqllastName . "," . $sqlfirstName . "," . $hashedCode . "," . $sqlaboutMe . ");");
 
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
