
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
    height: 40%;
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
        <header><h2>MODIFICATION</h2></header>
    
<form action="modif_service.php" method="post">
 <?php 
 include "../base de donnée/db_connect.php";
    @$id = $_GET['id'];
    $query = "SELECT * FROM service WHERE idService = '$id'";
    $result = $conn -> query($query);
    $row = $result -> fetch_assoc();

 ?>
  <div class="form-group">
      <label for="inputPassword4">Nom se service</label>
      <input type="text" class="form-control is-success" name="nomSe" id="inputPassword4" placeholder="Nom se service" value=<?php echo $row['nomSe'] ?>>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Prix</label>
    <input type="number" class="form-control txt-success" name="prixSe" id="inputAddress2" placeholder="Prix de service" value=<?php echo $row['prixSe']?> >
   <input type="hidden" name="id" value=<?php echo $row['idService']?>>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>
<?php
  include "../base de donnée/db_connect.php";
  if (isset($_POST['submit'])){
   
    $id = $_POST['id'];
    $nomSe = $_POST['nomSe'];
    $prixSe = $_POST['prixSe'];
    $sql ="UPDATE service SET  nomSe = '$nomSe' , prixSe = '$prixSe' WHERE idService = '$id';";
    $exute = $conn -> query($sql);
    if($exute){
      echo"<script>alert('Votre modification est bien enregitré ..');</script>";
      header("location: ../company.php");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }
  }

?>
</div>
</div>
</body>
</html>
