<?php

/********************************************************************************

Capstone
Database Testing

********************************************************************************/
    //Establish our database user name password and the name of the database
    $DBF_PASS = "mysql";
    $DBF_USER = "root";
    $DBF_NAME = "fitavate";
    //Connect our database to the program
    $connect = mysqli_connect("localhost", "$DBF_USER", "$DBF_PASS", "$DBF_NAME");
    
    //Creating the database

    function createDatabase()
    {
        //Call our variables necessary for connecting and creating the database
        global $DBF_NAME;
        global $connect;
        //If somehow the database already exists it'll be dropped before its created again
        $sqlDropDB = "DROP DATABASE IF EXISTS $DBF_NAME";
        if (mysqli_query($connect, $sqlDropDB)) {
            echo "Successfully dropped database<br>";
        } else {
            echo "<br>ERROR:<br>" . mysqli_error($connect);
        }
        
        //Create database if it does not exist, hence why we drop anything first just in case
        $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $DBF_NAME";
        if (mysqli_query($connect, $sqlCreateDB)) {
            echo "Successfully created database";
        } else {
            echo "<br>ERROR:<br>" . mysqli_error($connect);
        }

    }//end of dropCreate()

    //Populate the table with data
    function createTables()
    {
        global $DBF_NAME;
        global $connect;
        //Create our table Store and initialize the values for the columns each table needs a primary key
        //Auto increment for the primary key to auto add 1 to the ID whenver a new data entry is added
        //User
        $sqlCreateUser = "CREATE TABLE IF NOT EXISTS user_profile(
            user_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            userDisplayName VARCHAR(50),
            email VARCHAR(255) UNIQUE,
            userPassword VARCHAR(30),
            firstName VARCHAR(20),
            lastName VARCHAR(20),
            bio VARCHAR(255),
            birthday DATE,
            city VARCHAR(255),
            userState VARCHAR(255),
            userImage BLOB
        )";
        runQuery($sqlCreateUser, "Creating User", false);

        //Direct Messaging
        $sqlCreateConversation = "CREATE TABLE IF NOT EXISTS convo(
            convo_id INTEGER AUTO_INCREMENT PRIMARY KEY,
            user_id INTEGER,
            convoMessage VARCHAR(255),
            lastMessage VARCHAR(255),
            createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES user_profile(user_id)
        )";
        runQuery($sqlCreateConversation, "Creating Conversation", false);

        $sqlCreateParpicipant = "CREATE TABLE IF NOT EXISTS participant(
            participant_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            user_id INTEGER,
            convo_id INTEGER,
            FOREIGN KEY (user_id) REFERENCES user_profile(user_id),
            FOREIGN KEY (convo_id) REFERENCES convo(convo_id)
        )";
        runQuery($sqlCreateParpicipant, "Creating Participant", false);

        $sqlCreateDM = "CREATE TABLE IF NOT EXISTS directMessage(
            directMessage_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            convo_id INTEGER,
            lastSent_id INTEGER,
            FOREIGN KEY (convo_id) REFERENCES convo(convo_id),
            FOREIGN KEY (lastSent_id) REFERENCES user_profile(user_id)
        )";
        runQuery($sqlCreateDM, "Creating Direct Message", false);
        
        //Create Fitavations
        $sqlCreateFitavation = "CREATE TABLE IF NOT EXISTS fitavation(
            fitavation_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            user_id INTEGER,
            fitavation VARCHAR(255),
            createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
            likes INTEGER,
            FOREIGN KEY (user_id) REFERENCES user_profile(user_id)
        )";
        runQuery($sqlCreateFitavation, "Creating Fitavation", false);

        $sqlCreateFitavationComment = "CREATE TABLE IF NOT EXISTS fitavationComment(
            fitavationComment_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            secondaryUser_id INTEGER,
            commentMessage INTEGER,
            commentedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (secondaryUser_id) REFERENCES user_profile(user_id)
        )";
        runQuery($sqlCreateFitavationComment, "Creating Comments", false);
        
        $sqlCreateFitavationLike = "CREATE TABLE IF NOT EXISTS fitavationLike(
            fitavationLike_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            secondaryUser_id INTEGER,
            likedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (secondaryUser_id) REFERENCES user_profile(user_id)
        )";
        runQuery($sqlCreateFitavationLike, "Creating Fitavation Like", false);
        
        //Follow
        $sqlCreateFollow = "CREATE TABLE IF NOT EXISTS follow(
            user_id INTEGER,
            following_id INTEGER,
            PRIMARY KEY (user_id, following_id),
            FOREIGN KEY (user_id) REFERENCES user_profile(user_id)
        )";
        runQuery($sqlCreateFollow, "Creating Follow", false);
        
        //Notifications
        $sqlCreateNotificationType = "CREATE TABLE IF NOT EXISTS notificationType(
            notificationType_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            notificationTypeName VARCHAR(255),
            notificationTypeMessage VARCHAR(255)
        )";
        runQuery($sqlCreateNotificationType, "Creating Notification Type", false);

        $sqlCreateNotifications = "CREATE TABLE IF NOT EXISTS notifications(
            notification_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            user_id INTEGER NOT NULL,
            secondaryUser_id INTEGER,
            notificationType_id INTEGER,
            notificationLink VARCHAR(255),
            notificationTime DATETIME,
            FOREIGN KEY (user_id) REFERENCES user_profile(user_id),
            FOREIGN KEY (secondaryUser_id) REFERENCES user_profile(user_id),
            FOREIGN KEY (notificationType_id) REFERENCES notificationType(notificationType_id)
        )";
        runQuery($sqlCreateNotifications, "Creating Notifications", false);

        //FiTines
        $sqlCreateMuscleGroup = "CREATE TABLE IF NOT EXISTS muscleGroup(
            muscleGroup_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            muscleGroupName VARCHAR(50)
        )";
        runQuery($sqlCreateMuscleGroup, "Creating MuscleGroup", false);

        $sqlCreateLift = "CREATE TABLE IF NOT EXISTS lift(
            lift_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            muscleGroup_id INTEGER,
            liftName VARCHAR(45),
            FOREIGN KEY (muscleGroup_id) REFERENCES muscleGroup(muscleGroup_id)
        )";
        runQuery($sqlCreateLift, "Creating Lift", false);

        $sqlCreateFiTine = "CREATE TABLE IF NOT EXISTS fitine(
            fitine_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            fitineName VARCHAR(20),
            viewStatus BOOLEAN NOT NULL,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        runQuery($sqlCreateFiTine, "Creating Fitine", false);

        $sqlCreateUserFitine = "CREATE TABLE IF NOT EXISTS userFitine(
            user_id INTEGER,
            fitine_id INTEGER,
            owner_id INTEGER,
            FOREIGN KEY (user_id) REFERENCES user_profile(user_id),
            FOREIGN KEY (fitine_id) REFERENCES fiTine(fitine_ID)
        )";
        runQuery($sqlCreateUserFitine, "Creating User FiTine", false);

        $sqlCreateFiTineLift = "CREATE TABLE IF NOT EXISTS fitineLift(
            fitineLift_id INTEGER PRIMARY KEY AUTO_INCREMENT,
            fitine_id INTEGER,
            lift_id INTEGER,
            liftWeight INTEGER,
            liftSet INTEGER,
            liftRep INTEGER,
            FOREIGN KEY (lift_id) REFERENCES lift(lift_id),
            FOREIGN KEY (fitine_id) REFERENCES fitine(fiTine_id)
        )";
        runQuery($sqlCreateFiTineLift, "Creating FiTine Lift", false);
    }

    function populateTables()
    {
        global $DBF_NAME;
        global $connect;
        //Manually input all of our data into the Table
        $insertUserData = "INSERT INTO user_profile(user_id, userDisplayName, email, userPassword, firstName, lastName, bio, birthday, city, userState, userImage)
            VALUES  ('1', 'Dominic', 'dominiccummings95@gmail.com', 'password', 'Dominic', 'Cummings', 'Whats up guys my name is Dominic', '2000-11-04', 'St. Paul', 'Minnesota', null),
                    ('2', 'jediKilla', 'killjedi@gmail.com', 'jedikiller', 'Kylo', 'Ren', 'I want to kill all jedis', '2000-11-04', 'St. Paul', 'Minnesota', null),
                    ('3', 'superWinner', 'thegoat@gmail.com', 'superabowl', 'Tom', 'Brady', 'Going to keep winning', '2000-11-04', 'St. Paul', 'Minnesota', null)";
        runQuery($insertUserData, "Inserting User", false);

        $insertFitavationData = "INSERT INTO fitavation(fitavation_id, user_id, fitavation, createdAt, likes)
            VALUES  ('1', '1', 'This is a new fit!', '2000-11-04 22:32:33', '4'),
                    ('2', '1', 'Wow I hate the cold', '2000-11-04 22:32:33', '3'),
                    ('3', '2', 'Just retired!', '2000-11-04 22:32:33', '48')";
        runQuery($insertFitavationData, "Inserting Fitavation", false);

        $insertFollowingData = "INSERT INTO follow(user_id, following_id)
            VALUES  ('2', '1'),
                    ('3', '1'),
                    ('1', '3'),
                    ('3', '2'),
                    ('1', '2')";
        runQuery($insertFollowingData, "Inserting Follow", false);

        //$insertDmData = "INSERT INTO directMessage(directMessage_id, convo_id, lastSent_id)
        //    VALUES  ('1', '3', 'Tom, you stink'),
        //            ('2', '1', 'Dominic, are you a jedi'),
        //            ('3', '2', 'Kylo, why dont you learn football')";

        $insertMuscleGroupData = "INSERT INTO muscleGroup(muscleGroup_id, muscleGroupName)
            VALUES  ('1', 'Back'),
                    ('2', 'Legs'),
                    ('3', 'Arms')";
        runQuery($insertMuscleGroupData, "Inserting MuscleGroup", false);
        
        $insertLiftData = "INSERT INTO lift(lift_id, muscleGroup_id, liftName)
            VALUES  ('1', '1', 'DeadLift'),
                    ('2', '2', 'Squat'),
                    ('3', '3', 'Bicep Curl'),
                    ('4', '2', 'Calf Raise')";
        runQuery($insertLiftData, "Inserting Lift", false);
                
        $insertFiTineData = "INSERT INTO fitine(fitine_id,fitineName, viewStatus, date_created)
            VALUES  ('1', 'Leg Day', TRUE, '2000-11-04 22:32:33'),
                    ('2', 'Get Swoll', FALSE, '2000-11-04 22:32:33')";
        runQuery($insertFiTineData, "Inserting FiTine", false);

        $insertFiTineLiftData = "INSERT INTO fitineLift(fitineLift_id, fitine_id, lift_id, liftWeight, liftSet, liftRep)
            VALUES  ('1', '1', '2', '100', '3', '10'),
                    ('2', '1', '4', '20', '3', '20'),
                    ('3', '2', '1', '200', '3', '12')";
        runQuery($insertFiTineLiftData, "Inserting FiTine Lift", false);
        
        $insertUserFiTineData = "INSERT INTO userFitine(user_id, fitine_id, owner_id)
            VALUES  ('1', '2', '1'),
                    ('1', '1', '2'),
                    ('2', '1', '2')";
        runQuery($insertUserFiTineData, "Inserting User FiTine", false);
            
    }//end of populateTable()

    //Issets with POST to send a reuqest to the server when user selects option
    if (isset($_POST['dropCreate'])) {
        //Call function
        createDatabase();
    }

    if (isset($_POST['populateTable'])) {
        createTables();
        populateTables();
    }
/****************************************
* runQuery()
**************************************/
    function runQuery($sql, $msg, $echoSuccess)
    {
        global $connect;
        //run the query
        if ($connect->query($sql)=== true) {
            if ($echoSuccess){
                echo $msg . " successful.<br />";
            }
        }else {
                echo "<strong>Error when: " . $msg . "</strong> using SQL: " .$sql . "<br />" . $connect->error;
            }
    }
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>prjDBFCreate</title>
</head>
<body>
    <!-- Create form with the buttons to create populate and display the tables -->
    <form method = "POST"> 
        <input type = "submit" name = "dropCreate" id = "dropCreate" value = "Drop/Create DB" />
        <input type = "submit" name = "populateTable" id = "populateTable" value = "Populate Table" />
    </form>

</body>
</html>
