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

  //Sets session variables for when the user wants to create a new fitine
  if(isset($_POST['fitineSubmit'])){
    if (isset($_POST['newFitineName']) && isset($_POST['tempViewStatus'])) {
      $_SESSION['newFitine'] = $fitineName;
      $_SESSION['tempStatus'] = $viewStatus;
      header("Location: ?page=fitines/fitinesNew");
    }
  }


  if(isset($_POST['fitineEdit'])){
      $fitineID = $_POST['tempFitID'];
      $_SESSION['editFitID'] = $fitineID;
      header("Location: ?page=fitines/fitinesEdit");
  }

  //Deletes fitine and reloads the page
  if(isset($_POST['fitineDelete'])){
      $fitineID = $_POST['tempFitID'];
      deleteUserFitine($fitineID);
      header("Location: ?page=fitines/fitine");
  }

  if(isset($_POST['unfollowFitine'])){
      $fitineID = $_POST['tempSaveID'];
      unfollowFitine(1, $fitineID);
      header("Location: ?page=fitines/fitine");
}

 

