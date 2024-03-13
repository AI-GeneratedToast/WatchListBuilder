<?php //COMMENCER SESSION
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/general.css">
    <script src="../JS/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Admin Page</title>
        <script>
            //DELETING USER 
            $(document).ready(function(){
                $("#deleteUserForm").submit(function(event){
                    event.preventDefault();
                    var name=$('input[name=radioUser]:checked').val();
                    var submit=$("#submit").val();
                    $(".deleteUserMessage").load("../PHP/DeleteUser.php",{
                        name: name,
                        submit: submit
                    });
                });
                //DELETING TRAILER
                $("#deleteTrailerForm").submit(function(event){
                    event.preventDefault();
                    var name=$('input[name=radioTrailer]:checked').val();
                    var submit=$("#submit").val();
                    $(".deleteTrailerMessage").load("../PHP/DeleteTrailer.php",{
                        name: name,
                        submit: submit
                    });
                });
                //ADDING TRAILER
                $("#addTrailerForm").submit(function(event){
                    event.preventDefault();
                    var name=$("#name").val();
                    var description=$("#description").val();
                    var url=$("#url").val();
                    var submit=$("#submit").val();
                    $(".addTrailerMessage").load("../PHP/AddTrailer.php",{
                        name: name,
                        description: description,
                        url: url,
                        submit: submit
                    });
                });
                //RETURN TO LOGIN AND CLOSE SESSION
                $("#logOut").click(function () {
                    window.location.replace("../HTML/LogIn.html");
                })
            });
        </script>
</head>
<body class="bodyColor">
    <?php //CONNECTER À LA BD ET COMMENCER SESSION
        include("../DB/db_connect.php");
    ?>

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
    
    <h1 class="row justify-content-center text-center textColor">
        Add a New Trailer     
    </h1>

    <!--ADD TRAILER FORM -->
<section class="">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form class="d-grid" id="addTrailerForm" method="post" action="../PHP/AddTrailer.php">
                    <!-- INPUT NAME -->
                    <div class="form-outline mb-4">
                        <input type="text" name="name" id="name" class="form-control form-control-lg" />
                        <label class="form-label" for="name">Trailer name</label><br>
                    </div>
                    <!-- INPUT DESCRIPTION -->
                    <div class="form-outline mb-4">
                        <input type="text" name="description" id="description" class="form-control form-control-lg" />
                        <label class="form-label" for="signUpEmail">Description</label>
                    </div>
                    <!-- INPUT URL -->
                    <div class="form-outline mb-4">
                        <input type="text" name="url" id="url" class="form-control form-control-lg" />
                        <label class="form-label" for="url">Embeded url</label>
                    </div>
                    <br>
                    <a href="https://www.classynemesis.com/projects/ytembed//" the target="_blank">Generate link</a>
                    <!-- ERROR MESSAGE -->
                    <div class="addTrailerMessage"></div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-lg">Add</button>
                    </div>
                </form>
            </div>
        </div>
     </div>
</section>
<hr>
<h1 class="row justify-content-center text-center textColor">
    Delete a Trailer
</h1>
        <!--DELETE TRAILER FORM -->
<section class="">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form class="d-grid" id="deleteTrailerForm" method="post" action="../PHP/DeleteTrailer.php">
                   <!-- SELECT A CHECKBOX TO DELETE A TRAILER -->
                    <table border=1>
                        <th class="text-center"><h4>Name</h4></th>
                    <?php
                    //FETCH TRAILER NAMES
                        $query="select *
                        from movies";
                        $result=mysqli_query($BDD,$query);

                        while($row=mysqli_fetch_array($result)){        
                    ?>
                    <tr>
                        <td>
                            <input type="radio" name="radioTrailer" value="<?php echo $row['name']; ?>"> <?php echo $row['name']; ?>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                     <!-- ERROR MESSAGE -->
                    <div class="deleteTrailerMessage"></div>
                    </table>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-lg">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<hr>
<h1 class="row justify-content-center text-center textColor">
    Delete a User
</h1>
        <!--DELETE USER FORM -->
<section class="">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <form class="d-grid" id="deleteUserForm" method="post" action="../PHP/DeleteUser.php">
                    <!-- SELECT A RADIO TO DELETE A USER -->
                    <table border="1">
                        <th class="text-center"><h4>Username</h4></th>
                    <?php
                    //FETCH USERNAMES
                        $query="select *
                        from account";
                        $result=mysqli_query($BDD,$query);
                        //IF ADMIN , DO NOT SHOW
                        while($row=mysqli_fetch_array($result)){  
                            if($row['username']=="Administrator"){
                                continue;
                            }      
                    ?>
                    <tr>
                        <td>
                            <input type="radio" name="radioUser" value="<?php echo $row['username']; ?>"> <?php echo $row['username']; ?>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                    </table>
                    <br>

                     <!-- ERROR MESSAGE -->
                    <div class="deleteUserMessage"></div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block btn-lg">Remove</button>
                    </div>
                </form>
            </div>
        </div>
     </div>
</section>
</body>
</html>