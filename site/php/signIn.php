<?php

include 'conn.php';

$db = new Db();

if(isset($_POST['personID'])){
  $dbString = "PersonID=".htmlspecialchars($db -> quote($_POST['personID']));
}else{
  $hashedCode = $db -> quote(htmlspecialchars(hash("sha512", $_POST['securityCode'])));
  $dbString = "SecurityCode=". $hashedCode;
}

$dbString = $dbString;


$userInfo = $db -> select("SELECT PersonID, LastName, FirstName, AboutMe FROM Persons WHERE " . $dbString . ";");

$personID = htmlspecialchars($db->quote($userInfo[0]['PersonID']));

$accountInfo = array(
    'personID'    => $userInfo[0]['PersonID'],
    'lastName'    => $userInfo[0]['LastName'],
    'firstName'   => $userInfo[0]['FirstName'],
    'aboutMe'     => $userInfo[0]['AboutMe']
  );

$accountInfo = "'".json_encode($accountInfo)."'";

?>
