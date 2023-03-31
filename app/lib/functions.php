<?php
/*******************************************************
*  Functions are in alphabetical order
*******************************************************/

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
function printImage($image){
    //Convert the binary data into a base64-encoded string
    $userImageEncoded = base64_encode($image);
    //check if image is portriat or landscape and apply correct css - BLS
    list($w, $h, $t, $a) = getimagesizefromstring($image);
    if ($w > $h) {
        // Embed the base64-encoded string in an HTML img tag
        echo '<img class="circular--landscape" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
    } else {
        echo '<img class="circular--portrait" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
    }
}