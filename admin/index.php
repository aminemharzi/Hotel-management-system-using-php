<?php 
    session_start();
    include "base de donnée/db_connect.php";

    if(isset($_POST["submit"])){
        @$email = $_POST["email"];
        @$password = $_POST["password"];
        
        if(empty($email) || empty($password)){
            if(empty($email)){
                
                $_SESSION['emailUs'] = "";
                $emailM = "vous devez entrer votre email...";
            }
            if(empty($password)){
                $passM = "vous devez entrer votre password...";

            }
            echo "<script>alert($emailM"."\n"."$passM);</script>";
        }else{
            $sql = "SELECT * FROM user WHERE emailUs = '$email'";
            $exute = $conn -> query($sql);
            $row = $exute -> fetch_assoc();
            if($row['password'] === $password){
                $_SESSION['emailUs'] = $row['emailUs'];
                $_SESSION['nameUs'] = $row['nomUs'];
                $_SESSION['iduserUs'] = $row['iduser'];
                $_SESSION['roleUs'] = $row['role'];
                $_SESSION['password'] = $row['password'];
                if($row['role'] === "admin"){
                    header("location: dashoard.php?iduser=".$_SESSION['iduserUs']);

                }else{
                    header("location: user.php?iduser=".$_SESSION['iduserUs']);

                }

        

                

            }elseif($row && $row['password'] != $password){
                echo "<script>alert('The password is wrong !!');</script>";
            }else{
                echo "<script>alert('This email is not existe !!');</script>";

            }


        }

    }

    





?>

<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        <link rel="stylesheet" href="style/style.css">


</head>
<body>
    <div class="form">
        <fieldset>
            <legend>CONNEXION</legend>
            <form action="#" method="post">
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="email address">
                </div>
            </div>
                <div class="mb-3 row">
                <div class="col-sm-10">
                 <input type="password" name="password" class="form-control" id="inputPassword" placeholder="password">
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">CONNEXION</button>
  



            </form>
            <!-- form Addition -->
            
        </fieldset>
    </div>
    


</body>
</html>