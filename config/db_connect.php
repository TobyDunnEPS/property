<?php

// MySQLi or PDO - connect to database
$conn = mysqli_connect('127.0.0.1', 'root', 'dev', 'tutorial_property', '33062');

// check conection
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();

}

?>