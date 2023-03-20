<?php
/*******************************************************
*  Functions are in alphabetical order
*******************************************************/
function createConnection()
{
    // Create connection object
    $conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Select the database
    $conn->select_db(DATABASE_NAME);
} // end of createConnection( )
function get($name, $def='')
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
}
function displayResult($result, $sql){
    if ($result-> num_rows>0){
        echo "<table border='1'>";
        $heading = $result-> fetch_assoc();
        echo "<tr>";
        foreach($heading as $key=>$value){
            echo "<th>". $key . "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach($heading as $key=>$value){
            echo "<td>" . $value . "</td>";
        }
        while($row=$result->fetch_assoc()){
            echo "<tr>";
            foreach($row as $key=>$value) {
                echo "<td>" . $value. "</td>";
            }
            echo"</tr>";
        }
        echo "</table>";
    }else{
        echo "<strong>zero results using SQL: </strong>". $sql;
    }
}