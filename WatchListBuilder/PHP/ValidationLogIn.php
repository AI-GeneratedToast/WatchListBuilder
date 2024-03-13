<?php 
//Connecter a la bd
include "../DB/db_connect.php";

if(isset($_POST['submit'])){
    //GET LOG IN DATA FROM POST
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    if(empty($email) || empty($pwd)){
        echo"<span class='errorMessage'>Remplis tous les champs! </span>";
        $errorEmpty = true;
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
    //ERROR MESSAGE IF EMAIL IS
        echo"<span class='errorMessage'>Courriel n'est pas valide!</span>";
        $errorEmail = true;
    }else{
        //SEE IF THE ACCOUNT EXISTS,IF NOT ERROR MESSAGE
        $accountCheckQuery = "select *
        from account 
        where email='$email' and password='$pwd'";
        $QueryResult=mysqli_query($BDD, $accountCheckQuery);
        
        //IF IS AN ADMIN ,GO TO ADMIN PAGE ELSE GO TO USER PAGE
        if(mysqli_num_rows($QueryResult)==1){
            $row=mysqli_fetch_assoc($QueryResult);
            echo"<span class='succes'>Connexion Success</span>";
            
            // CREATE A SESSION 
            if($email=="admin@gmail.com"){
                session_start();
                $_SESSION["user"] = $row['username'];
            ?>
                <script>
                    window.location.replace("../HTML/AdminPage.php");
                </script>
            <?php
            }else{
                //CREATE A SESSION FOR USER AND MAKE INSTANTIATE WATCHLIST 
                session_start();
                $_SESSION["user"] = $row['username'];
                if(empty($_SESSION['watchList'])){
                    $_SESSION['watchList'] = array();
                }
                ?>
                <script>
                    window.location.replace("../HTML/Generator.php");
                </script>
            <?php
            }
        }else{
            echo"<span class='errorMessage'>
            Les informations d'identification du compte sont erronées<br>
            ou le compte existe pas!
            </span>";
        }
    }
}
?>