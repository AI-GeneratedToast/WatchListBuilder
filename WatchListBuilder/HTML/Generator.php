<?php 
//COMMENCER SESSION
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/general.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script  src="../JS/jquery-3.1.1.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Generator</title>
    <script>
        $(document).ready(function(){
            //RANDOMIZE ROWS AND PICK 1
            <?php
                include "../DB/db_connect.php";

                $query="select * from movies
                order by rand()
                limit 1";

                $result=mysqli_query($BDD,$query);
                $row=$result->fetch_assoc();

                $title=(string) $row['name'];
                $thumbnail=(string)$row['url'];
                $description=(string) $row['description'];
            ?>

            //GENERATE TRAILER
            $("#generate").click(function(){

            $("#title").text("<?php echo $title; ?>");
            $("#url").attr('src',"<?php echo $thumbnail; ?>");
            $("#description").text("<?php echo $description; ?>");
            });
            //ADD TRAILER TO WATCHLIST /*WATCH THIS!!*/
            $("#addWatchList").click(function(){
                <?php
                    //array_push($_SESSION['watchList'],$title);
                ?>
                $("#title").text("Title");
                $("#url").attr('src',"");
                $("#description").text("Description");
                location.reload(); 
            });
            //SKIP TRAILER
            $("#sawIt").click(function(){   
                $("#title").text("Title");
                $("#url").attr('src',"");
                $("#description").text("Description");
                location.reload(); 
            });
            //RETURN TO LOGIN 
            $("#logOut").click(function() {
                window.location.replace("LogIn.html");
            });
        });
    </script>
</head>
<body class="bodyColor">
    <!-- NAVBAR -->
    <nav class="navbar container-fluid navbar-expand-lg justify-content-between ">
        <a class="navbar-brand">WatchList Builder</a>
        <ul class="navbar-nav ">
        <li class="nav-item">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Compte: <?php echo $_SESSION['user'] ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" id="logOut">Log Out</a>
                </div>
            </div>
        </li>
        </ul>
    </nav>

    <!-- CARD CONTAINING GENERATED PICTURE  -->
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 mx-auto">
                <div class="card text-center mx-auto" style="width: 36rem;">
                    <h5 class="card-title" name="title" id="title">Movie Title</h5>
                    <hr>
                    <iframe class="mx-auto" id="url" src="" allowfullscreen></iframe>
                    <div class="card-body">
                        <hr>
                        <p class="card-text" name="description" id="description">Description</p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button id="sawIt" name="sawIt" class="btn btn-danger btn-block btn-lg">Already Seen It</button>

                            <button type="submit" id="generate" name="submit" class="btn btn-primary btn-block btn-lg">Generate</button>

                            <button id="addWatchList" name="addWatchList" class="btn btn-success btn-block btn-lg">Add to Watch List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>

</body>
</html>