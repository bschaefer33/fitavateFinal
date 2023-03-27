<?php
    session_start();
    //access to fitine functions
    require $config['LIB_PATH'] . 'fitineFunctions.php';
    $fullLiftArray = getAllLifts();
    $fitineID = $_SESSION['editFitID'];
    
    $fitine = getFitine($fitineID);
    $fitineName = $fitine['fitineName'];
    $viewStatus = $fitine['viewStatus'];
    $liftArray = getLift($fitineID);

    if ($fitine['viewStatus'] == 1) {
        $true = "checked";
    }else {
        $false = "checked";
    }

    function selectdCheck($value1,$value2)
   {
     if ($value1 == $value2) 
     {
      echo 'selected="selected"';
     } else 
     {
       echo '';
     }
     return;
   }
