<?php

// include 'conn.php';

// $db = new Db();

<<<<<<< HEAD
// if(isset($_POST['personID'])){
//   $dbString = "PersonID=".htmlspecialchars($db -> quote($_POST['personID']));
// }else{
//   $hashedCode = $db -> quote(htmlspecialchars(hash("sha512", $_POST['securityCode'])));
//   $dbString = "SecurityCode=". $hashedCode;
// }

// $dbString = $dbString;

=======
$hashedCode = $db -> quote(htmlspecialchars(hash("sha512", $_POST['securityCode'])));
$dbString = "SecurityCode=". $hashedCode;
>>>>>>> 1fa2aca0f8e950ddcfede35bdb19047dabb8b982

// $userInfo = $db -> select("SELECT PersonID, LastName, FirstName, AboutMe FROM Persons WHERE " . $dbString . ";");

<<<<<<< HEAD
// $personID = htmlspecialchars($db->quote($userInfo[0]['PersonID']));

// $accountInfo = array(
//     'personID'    => $userInfo[0]['PersonID'],
//     'lastName'    => $userInfo[0]['LastName'],
//     'firstName'   => $userInfo[0]['FirstName'],
//     'aboutMe'     => $userInfo[0]['AboutMe']
//   );

// $accountInfo = "'".json_encode($accountInfo)."'";

=======
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
  $_SESSION["personID"] = $userInfo[0]['PersonID'];
  $_SESSION["authenticated"] = true;
  $accountInfo = "'".json_encode($accountInfo)."'";
}
>>>>>>> 1fa2aca0f8e950ddcfede35bdb19047dabb8b982
?>
