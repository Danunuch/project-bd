<?php
$servername = "localhost";
$username = "root";
$password = "";


// $username = "thaibyhost_B2dd";
// $password = "wERlBeowD";
try {
  $conn = new PDO("mysql:host=$servername;dbname=bddesign;charset=utf8", $username, $password);
  // $conn = new PDO("mysql:host=$servername;dbname=thaibyhost_bdd22;charset=utf8", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
