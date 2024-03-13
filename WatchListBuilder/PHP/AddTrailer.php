<?php
//CONNECT TO DB
include("../DB/db_connect.php");

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $url=$_POST['url'];

    if(empty($name) || empty($description) || empty($url)){
        echo"<span class='errorMessage'>Remplis tous les champs! </span>";
    }else {
        //SEE IF NAME EXISTS
        $nameQuery= "select * 
        from movies 
        where name='$name'";
        $nameQueryResult=mysqli_query($BDD,$nameQuery);

        if(mysqli_num_rows($nameQueryResult)>0){
            echo"<span class='errorMessage'>Le trailer existe deja!</span>";
        }else{
            //ADD MOVIE INFORMATION TO THE DATABASE
            $queryInsert="INSERT INTO movies (name,description,url)
            VALUES ('$name','$description','$url')";

            $queryResult=mysqli_query($BDD,$queryInsert);
            echo"<span class='succes'>Le Trailer est ajouté!</span>";
            ?>
            <script>
                $("#name").val("");
                $("#description").val("");
                $("#url").val("");
            </script>
            <?php
        }        
    }
}else{
    echo"ERREUR";
}
?>