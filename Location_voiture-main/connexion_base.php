<?php

  // $host_name = "localhost";
  // $database = "location_voiture";
  // $username = "marzouk";
  // $password = "";

  try {

 // $pdo = new PDO('mysql:host='.$host_name.';dbname='.$database,$username,$password);
  } catch (PDOException $e) {
      echo "Erreur : " .$e->getMessage();
  }
 
?>
