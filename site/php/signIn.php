<?php

include 'conn.php';

$db = new Db();

$hashedCode = $db -> quote(htmlspecialchars(hash("sha512", $_POST['securityCode'])));
$dbString = "SecurityCode=". $hashedCode;

$userInfo = $db -> select("SELECT PersonID, LastName, FirstName, AboutMe FROM Persons WHERE " . $dbString . ";");

$loggedIn = false;
if (!empty($userInfo)) {
  $accountInfo = array(
    'personID'    => $userInfo[0]['PersonID'],
    'lastName'    => $userInfo[0]['LastName'],
    'firstName'   => $userInfo[0]['FirstName'],
    'aboutMe'     => $userInfo[0]['AboutMe']
  );
  $loggedIn = true;
  session_start();
  setcookie("ilikecookies","true");
  $accountInfo = "'".json_encode($accountInfo)."'";
}
?>
