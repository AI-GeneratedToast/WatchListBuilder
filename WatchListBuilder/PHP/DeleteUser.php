<?php
//CONNECT TO DB
include("../DB/db_connect.php");

if(isset($_POST['submit'])){
    $name=$_POST['name'];


    //REMOVE TRAILER INFORMATION IN THE DATABASE
    $queryInsert="DELETE FROM account 
    WHERE username='$name'";

    $queryResult=mysqli_query($BDD,$queryInsert);
    echo"<span class='succes'>Le User ".$name." est suprimé!</span>";
}else{
    echo"ERREUR";
}
?>