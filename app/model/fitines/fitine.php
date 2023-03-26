<?php
  session_start();
  
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

  if (isset($_POST['newFitineName']) && isset($_POST['tempViewStatus'])) {
    $_SESSION['newFitine'] = $fitineName;
    $_SESSION['tempStatus'] = $viewStatus;
    header("Location: ?page=fitines/fitinesNew");
  }
  


 

