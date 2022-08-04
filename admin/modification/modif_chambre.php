
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
        <header><h2>MODIFICATION</h2></header>
    
<form action="modif_chambre.php" method="post">
 <?php 
 include "../base de donnée/db_connect.php";
    @$id = $_GET['id'];
    $query = "SELECT * FROM chambre WHERE idchambre = '$id'";
    $result = $conn -> query($query);
    $row = $result -> fetch_assoc();

 ?>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" class="form-label text-success">Nombre des personnes</label>
      <input type="number" class="form-control " name="nbrP" id="inputEmail4" placeholder="Nombre des personnes" value=<?php echo $row['max_adult'] ?>>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Nombre des enfants</label>
      <input type="number" class="form-control is-success" name="nbrC" id="inputPassword4" placeholder="Nombre des enfants" value=<?php echo $row['max_child'] ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Prix</label>
    <input type="number" class="form-control txt-success" name="prix" id="inputAddress2" placeholder="Prix" value=<?php echo $row['prixCH']?> >
   
  </div>
  <div class="form-group">
    <label for="inputAddress2">Telephone</label>
    <input type="number" class="form-control txt-success" name="tele" id="inputAddress2" placeholder="Telephone" value=<?php echo $row['telephoneCH']?> >
    
  </div>
  <div class="form-group">
    <label for="inputAddress2">Lits</label>
    <input type="number" class="form-control txt-success" name="lits" id="inputAddress2" placeholder="Pays" value=<?php echo $row['lits']?> >
    <input type="hidden" name="id" id="" value="<?php echo $id; ?>">
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>
<?php
  include "../base de donnée/db_connect.php";
  if (isset($_POST['submit'])){
   
    $id = $_POST['id'];
    $nbrP = $_POST['nbrP'];
    $nbrC = $_POST['nbrC'];
    $telephone = $_POST['tele'];
    $lits = $_POST['lits'];
    $prix = $_POST['prix'];
    echo "user Id :$id";
    if($nbrP > 1 || $nbrC > 0 ){
        $type = "1";

    }else{
        $type = "2";

    }

    $sql ="UPDATE chambre SET telephoneCH = '$telephone' , lits = '$lits' , prixCH = '$prix' ,idHotel = '1' , idcategorie = '$type' , max_child = '$nbrC' , max_adult = '$nbrP' WHERE idchambre = '$id';";
    echo $sql ;
    $exute = $conn -> query($sql);
    if($exute){
      echo"<script>alert('Votre modification est bien enregitré ..');</script>";
      header("location: ../adminmanagement.php");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  }

?>
</div>
</div>
</body>
</html>
