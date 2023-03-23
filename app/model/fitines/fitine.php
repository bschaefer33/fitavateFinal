<?php
  session_start();
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
  
  //get the user fitines and assign them as saved or user created
  createFitine(1);
  $userArray = getUserFitines();
  $savedArray = getSavedFitines();

  //used to control card output for saved arrays
  $count = 0;

  //new fitine information
  $fitineName = ($_POST['newFitineName']);
  $viewStatus = ($_POST['tempViewStatus']);

  if(isset($_POST['newFitineName']) && isset($_POST['tempViewStatus'])) {
    $_SESSION['newFitine'] = $fitineName;
    $_SESSION['tempStatus'] = $viewStatus;
    header("Location: ?page=fitines/fitinesNew");
  }
  


 

