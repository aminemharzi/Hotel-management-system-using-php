
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
    height: 90%;
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
    
<form action="modif_client.php" method="post">
 <?php 
 include "../base de donnée/db_connect.php";
    @$id = $_GET['id'];
    $query = "SELECT * FROM client WHERE idClient = '$id'";
    $result = $conn -> query($query);
    $row = $result -> fetch_assoc();

 ?>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" class="form-label text-success">Nom</label>
      <input type="text" class="form-control " name="nom" id="inputEmail4" placeholder="Nom" value=<?php echo $row['nomCl'] ?>>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Prenom</label>
      <input type="text" class="form-control is-success" name="prenom" id="inputPassword4" placeholder="Prenom" value=<?php echo $row['prenomCl'] ?>>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Date de naissance</label>
    <input type="date" class="form-control txt-success" name="dateN" id="inputAddress2" placeholder="Date de Naissance" value=<?php echo $row['dateNiss']?> >
   
  </div>
  <div class="form-group">
    <label for="inputAddress2">Adresse</label>
    <input type="text" class="form-control txt-success" name="adresse" id="inputAddress2" placeholder="Adresse" value=<?php echo $row['adresseCl']?> >
    
  </div>
  <div class="form-group">
    <label for="inputAddress2">Pays</label>
    <input type="text" class="form-control txt-success" name="pays" id="inputAddress2" placeholder="Pays" value=<?php echo $row['paysCl']?> >
  </div>
  <div class="form-group">
    <label for="inputAddress2">Telephone</label>
    <input type="text" class="form-control txt-success" name="tele" id="inputAddress2" placeholder="Telephone" value=<?php echo $row['telephone']?> >
    <input type="hidden" name="id" id="id" value=<?php echo $id ;?>>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Genre</label>
      <select id="inputState" class="form-control text-success" name="genre" >
      <?php 
      
      
       if($row['genre'] == "M"){
         ?>
        <option value="M" selected>Musculin</option>
        <option value="F">Feminin</option>

       <?php }
       else{
        
        ?>
        <option value="M">Musculin</option>
        <option value="F" selected>Feminin</option>
        <?php } ?>
        
      
      </select>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
</form>
<?php
  include "../base de donnée/db_connect.php";
  if (isset($_POST['submit'])){
   
    $idC = $_POST['id'];
    $name = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['tele'];
    $adresse = $_POST['adresse'];
    $dateN = $_POST['dateN'];
    $pays = $_POST['pays'];
    $genre = $_POST['genre'];
    echo "user Id :$id";

    $sql ="UPDATE client SET nomCl = '$name' , prenomCl = '$prenom' , telephone = '$telephone' ,adresseCl = '$adresse' , dateNiss = '$dateN' , paysCl = '$pays' , genre = '$genre' WHERE idClient = '$idC';";
    echo $sql ;
    $exute = $conn -> query($sql);
    if($exute){
      echo"<script>alert('Votre modification est bien enregitré ..');</script>";
      header("location: ../client.php");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  }

?>
</div>
</div>
</body>
</html>
