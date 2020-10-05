<?php
  $servername = "207.180.240.117";
  $username = "hidoyatmz";
  $password = "2DKbR3h7tpT3";

  try {
      $bdd = new PDO("mysql:host=$servername;dbname=soso", $username, $password);
      // set the PDO error mode to exception
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
      }
  catch(PDOException $e)
      {
      echo "Connection failed: " . $e->getMessage();
      }
?>