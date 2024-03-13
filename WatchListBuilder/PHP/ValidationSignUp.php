<?php 
include("../DB/db_connect.php");
$valide=0;


if(isset($_POST['submit'])){

    //GET SIGN IN DATA FROM POST
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //ERROR MESSAGE IF INPUT IS EMPTY
    if(empty($username) || empty($email) || empty($password)){
        echo"<span class='errorMessage'>Remplis tous les champs! </span>";
    }
    elseif(filter_var(!$email, FILTER_VALIDATE_EMAIL)){  
    //ERROR MESSAGE IF EMAIL IS
        echo"<span class='errorMessage'>Courriel n'est pas valide!</span>";
    }else{
        //SEE IF USERNAME EXISTS
        $usernameQuery= "select * 
        from account 
        where username='$username'";
        $usernameQueryResult=mysqli_query($BDD,$usernameQuery);

        if(mysqli_num_rows($usernameQueryResult)==0){
            $valide++;
        }else{
            echo"<span class='errorMessage'>Le nom existe deja!</span>";
        }
        //SEE IF EMAIL EXISTS
        $emailQuery= "select * 
        from account 
        where email='$email'";
        $emailQueryResult=mysqli_query($BDD,$emailQuery);

        if(mysqli_num_rows($emailQueryResult)==0){
            $valide++;
        }else{
            echo"<span class='errorMessage'>Le email existe deja!</span>";
        }

        //SEE IF PASSWORD EXISTS
        $passwordQuery= "select * 
        from account 
        where password='$password'";
        $passwordQueryResult=mysqli_query($BDD,$passwordQuery);

        if(mysqli_num_rows($passwordQueryResult)==0){
            $valide++;
        }else{
            echo"<span class='errorMessage'>Le password existe deja!</span>";
        }
        if($valide==3){
            //ADD ACCOUNT INFORMATION TO THE DATABASE
            $queryInsert="INSERT INTO account (username,email,password)
            VALUES ('$username','$email','$password')";

            $queryResult=mysqli_query($BDD,$queryInsert);
            echo"<span class='succes'>Le compte est creer!</span>";
            ?>
            <script>
                $("#signUpName").val("");
                $("#signUpEmail").val("");
                $("#signUpPwd").val("");
            </script>
            <?php
        }
    }
}else{
    echo"ERREUR";
}
?>
