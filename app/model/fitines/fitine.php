<?php
    require $config['LIB_PATH'] . 'fitineFunctions.php';
    //Establish our database user name password and the name of the database
    //$DBF_PASS = "mysql";
    //$DBF_USER = "root";
    //$DBF_NAME = "fitavate";
    //Connect our database to the program
    //$connect = mysqli_connect("localhost", "$DBF_USER", "$DBF_PASS", "$DBF_NAME");

    //$sql = "SELECT *
      //      FROM userFitine
      //    JOIN fitine ON userFitine.fitine_id = fitine.fitine_id
    //$result = $connect->query($sql);
    createFitine(1);
    $userArray = getUserFitines();
    $savedArray = getSavedFitines();

    if(isset($_POST['new'])){
      $_SESSION['tempFitineName'] = $_POST['newFitineName'];
    }