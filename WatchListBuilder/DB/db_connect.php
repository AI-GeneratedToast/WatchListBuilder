<?php
//Connecting to db 
include "dbConfig.php";
$BDD = new mysqli(HOST,USER,PASSWORD,DATABASE);
if(mysqli_connect_errno()){
    echo "Could not connect to database: ". mysqli_connect_error();
}
?>