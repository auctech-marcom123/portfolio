<?php
    $servername = "sql302.infinityfree.com";
    $username = "if0_36934103";
    $password = "D8RBWs";
    $database = "if0_36934103_auctech_portfolio";

    $con =  new mysqli($servername, $username, $password, $database);

    if($con->connect_error){
        die("Connection Failed: " . $con->connect_error);
    }
?>