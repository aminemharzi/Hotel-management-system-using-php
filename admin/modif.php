
<html>
<head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

        <style>
          .modal{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0,0 , 0.4);
    z-index: center;
    text-align: center;
    display: block;

}

.modal-contenu{
    background-color: white;
    width: 60%;
    text-align: center;
    padding: 12px;
    margin: 15px auto;
    height: 70%;
    padding: 2%;

}
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
.modal-contenu span:hover{
      color: black;
      cursor: pointer;

}

        </style>

</head>
<body>
<div class="modal" id="modal">
        <div class="modal-contenu">
    
<form action="modif.php" method="post">
 <?php 
 include "base de donnée/db_connect.php";
    @$idU = $_GET['idU'];
    //echo "$idU";
    $query = "SELECT * FROM user WHERE iduser = '$idU'";
    $result = $conn -> query($query);
    $row = $result -> fetch_assoc();

 ?>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" class="form-label text-success">Email</label>
      <input type="email" class="form-control " name="email" id="inputEmail4" placeholder="Email" value=<?php echo $row['emailUs'] ?>>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control is-success" name="pass" id="inputPassword4" placeholder="Password" value=<?php echo $row['password'] ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Nom</label>
    <input type="text" class="form-control txt-success" name="nom" id="inputAddress2" placeholder="Nom" value=<?php echo $row['nomUs']?> >
    <input type="hidden" name="id" id="id" value=<?php echo $idU ;?>>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Role</label>
      <select id="inputState" class="form-control text-success" name="role" >
      <?php 
      
      
       if($row['role'] == "admin"){
         ?>
        <option value="admin" selected>Admin</option>
        <option value="user">user</option>

       <?php }
       else{
        
        ?>
        <option value="admin" >Admin</option>
        <option value="user" selected>user</option>
        <?php } ?>
        
      
      </select>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>
<?php
  include "base de donnée/db_connect.php";
  if (isset($_POST['submit'])){
   
    echo $idU;
    $idU = $_POST['id'];
    $nameU = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $role = $_POST['role'];
    echo "<script>alert('$nameU and $email and $password and $role');</script>";
    echo "user Id :$idU";

    $sql ="UPDATE user SET emailUs = '$email' , password = '$password' , role = '$role' , nomUs = '$nameU' WHERE iduser = '$idU';";
    echo $sql ;
    $exute = $conn -> query($sql);
    if($exute){
      echo"<script>alert('Votre modification est bien enregitré ..');</script>";
      header("location: user.php");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  }

?>
</div>
</div>
</body>
</html>
