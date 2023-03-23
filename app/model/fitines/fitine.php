<?php
  //Establish our database user name password and the name of the database
  $DBF_PASS = "mysql";
  $DBF_USER = "root";
  $DBF_NAME = "fitavate";
  //Connect our database to the program
  $connect = mysqli_connect("localhost", "$DBF_USER", "$DBF_PASS", "$DBF_NAME");
  //check connection
  if ($connect->connect_error) {
      die("Connection failed: ".$conn->connect_error);
  }
  //require the fitines functions from library
  require $config['LIB_PATH'] . 'fitineFunctions.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fitineName= $_POST['newFitineName'];
    $status = $_POST['tempViewStatus'];
    startNewFitine($fitineName, $status);
  }
  
  createFitine(1);
  $userArray = getUserFitines();
  $savedArray = getSavedFitines();

  $count = 0;



 

