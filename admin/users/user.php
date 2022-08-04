<?php
session_start();

@$emailUs = $_SESSION['emailUs'] ;
@$nameUs = $_SESSION['nameUs'] ;
@$iduser = $_SESSION['iduserUs'];  
@$roleUs = $_SESSION['roleUs'];
if(empty($emailUs) && empty($nameUs) && empty($iduser) && empty($roleUs)){
  header("location: index.php");


}
include "base de donnée/db_connect.php";
  


 if(isset($_POST["submit"])){
     @$email = $_POST["email"];
     @$pass = $_POST["pass"];
     @$confirmpass = $_POST["confirmpass"];
     @$nom = $_POST["nom"];
     @$role = $_POST["role"];

    
    
      $search = "SELECT * FROM user WHERE emailUs = '$email'";

      $check = $conn -> query($search);
      $what = $check -> fetch_assoc();
      if(!$what){


        if($pass === $confirmpass){



          $sql = "INSERT INTO user VALUES (default,'$nom','$role','$email','$pass')";
          $exute = $conn -> query($sql);
     
        }else{
          echo "<script>alert('Votre mot de passe et confirm est misMatch');</script>";
      }
    }else{
      echo "<script>alert('this user is already tacken!!!  Please enter another one');</script>";
    }
    }


 

?>
<html>
    <head>
        <title>
            admin
        </title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        <link rel="stylesheet" href="user.css">
        <link rel="stylesheet" href="menubar.css">

    </head>
    <body>
    <nav id="nav">
  
  <!--<button class="toggle" id="toggle">
  <i class="fas fa-bars"></i>
   <i class="fas fa-times"></i>

  </button>-->
  <center>
<header><h3><?php echo @$nameUs?></h3></header>
<p style="color: grey;"><?php echo $roleUs ?></p>
</center>
<br>
<header><h4>My Menu</h4></header>

<ul>

      <li><i class="fas fa-home"></i><a href="dashoard.php">Dashboard<i class="fas fa-caret-down"></i></a></li>
      <li><i class="fas fa-chart-pie"></i><a href="adminmanagement.php">Admmin management</a></li>
      <li><i class="fas fa-address-book"></i><a href="#">Company management</a></li>
      <li class="this"><i class="fas fa-user"></i><a href="user.php">Users</a></li>
      <li><i class="fas fa-id-badge"></i><a href="client.php">Client Management</a></li>
      <li ><i class="fas fa-file-contract"></i><a href="reserve.php">Resrvé</a></li>
      <br><br><br><br>
      <a href="log-out.php"><button  class="btn btn-Danger mb-3 w-100"><i class="fas fa-door-closed">Log out</i></button></a>
  </ul>
  </nav>

  <?php

@$message = $_GET['message'];
if(!empty($message)){
  echo "<script>aert('hello $message');</script>";

}

  ?>
  
    <div class="chambres">
        <h3>Welcome back <?php echo $nameUs?></h3>
        <div class="profile">
          <img src="" alt="">
          <h1><?php echo $nameUs ?></h1>
          <p><?php echo $emailUs ?></p>
          <p class="title"><?php echo $roleUs?></p>
          <a href="#"><i class="fa fa-dribbble"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-linkedin"></i></a>
          <a href="#"><i class="fa fa-facebook"></i></a>
          <p><button>Contact</button></p>
          
            
        </div>
       
        <div class="activite">
        <!-- <table class="tableau">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Role</th>
                <th>Email</th>
                <th>Supression</th>
                <th>Modification</th>
            </tr> -->
            <table class="content-table" id="table">
      <thead>
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Role</th>
        <th>Email</th>
        <th>Supression</th>
        <th>Modification</th>
      </tr>
        </thead>
      <tbody>
            <?php 

        
            $requete = "SELECT * FROM user ORDER BY role;";
            $result = $conn -> query($requete);
            while($row = $result -> fetch_row()) { ?>
               
            
           <tr>
                <td><?php echo "$row[0]"?></td>
                <td><?php echo "$row[1]"?></td>
                <td><?php echo "$row[2]"?></td>
                <td><?php echo "$row[3]"?></td>
                <td class='sup'><a style="text-decoration:none; color: ;"href="suppression.php?idU=<?php echo $row[0] ;?>"><i class='far fa-trash-alt'></i></a></td>
                <td class='modif' onclick='btns()'><a href="modif.php?idU=<?php echo $row[0] ;?>"><i class='fas fa-plus-circle'></i></a></td>
            </tr>
            <?php  } 
            mysqli_free_result($result);           
            mysqli_close($conn);
        
         ?>
            
            </tbody>
            </table>
        </div>
        <div class="ajoute-user">
            <header><h2>AJOUTER UNE USER</h2></header>
        <form action="user.php" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" class="form-label ">Email</label>
      <input type="email" class="form-control " name="email" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control " name="pass" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword">Confirm Password</label>
    <input type="password" class="form-control" name="confirmpass" id="inputAddress" placeholder="confirm password">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Nom</label>
    <input type="text" class="form-control" name="nom" id="inputAddress2" placeholder="Nom">
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Role</label>
      <select id="inputState" class="form-control" name="role">
        <option selected>Choose...</option>
        <option value="admin">Admin</option>
        <option value="user">user</option>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
</form>          
      
        
    </div>
    <div class="modal" id="modal">
        <div class="modal-contenu">
            <span class="close">&times;</span>
            <header><h2>Modification</h2></header>
            <form action="user.php" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control is-valid" name="email" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control is-valid" name="pass" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword">Confirm Password</label>
    <input type="password" class="form-control is-valid" name="confirmpass" id="inputAddress" placeholder="confirm password">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Nom</label>
    <input type="text" class="form-control is-valid" name="nom" id="inputAddress2" placeholder="Nom">
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Role</label>
      <select id="inputState" class="form-control is-valid" name="role">
        <option selected>Choose...</option>
        <option value="admin">Admin</option>
        <option value="user">user</option>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>       
        </div>

    </div>

  
        <script>
      
    
        </script>
    </body>
</html>