
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
    
<form action="modifP.php" method="post">
 <?php 
 include "base de donnée/db_connect.php";
    @$idP = $_GET['idP'];
    //echo "$idU";
    $query = "SELECT * FROM paiement WHERE idpa = '$idP'";
    $result = $conn -> query($query);
    $row = $result -> fetch_assoc();

 ?>
    <div class="col-md-12">
        <label for="inputEmail4" class="form-label">ID Reserve</label>
        <input type="Number" class="form-control" name="idreserve" id="inputEmail4" value=<?php echo $row['idreserve']; ?>>
    </div>
    <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Date de Paiement</label>
        <input type="date" class="form-control" name="dateP" id="inputEmail4" value="<?php echo $row['dateP']; ?>">
        <input type="hidden" class="form-control" name="idP" id="inputEmail4" value=<?php echo $idP ;?>>
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Montant</label>
        <input type="number" class="form-control" min="0" max=<?php echo $row['montant'];?> id="inputEmail4" name="montant" value=<?php echo $row['montant'];?>>
    </div>
    <div class="col-md-6">
    <label for="montant" class="form-label">Montant</label><br>
            <select class="form-select" aria-label="Default select example" name="modep">
            <?php 
      
      
      if($row['modeP'] == "caisse"){
        ?>
       <option value="caisse" selected>Caisse</option>
       <option value="banque">Banque</option>
       <option value="chaique">Chaique</option>

      <?php }
      elseif($row['modeP'] == "banque"){
       
       ?>
       <option value="admin" >Caisse</option>
       <option value="banque" selected>Banque</option>
       <option value="chaique">Chaique</option>
       <?php }else{
        
       ?>
        <option value="admin" >Caisse</option>
       <option value="banque" >Banque</option>
       <option value="chaique" selected>Chaique</option>
       <?php } ?>
            </select>
        
    </div>
    <div class="col-12">
    </div> 
    <div class="col-12">
        <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
    </div>
    </form>
<?php
  include "base de donnée/db_connect.php";
  if (isset($_POST['submit'])){

    $idP = $_POST['idP'];
    $modeP = $_POST['modep'];
    $montant = $_POST['montant'];
    $idR = $_POST['idreserve'];
    $dateP = $_POST['dateP'];
    $ress = "SELECT * FROM reserve WHERE idreserve = '$idR';";
    // echo $ress;
    // exit ;
    $resE = $conn -> query($ress);
    $resR = $resE -> fetch_assoc();
    $reste = $resR['prix'] - $montant;
    
    $sql ="UPDATE paiement SET modeP = '$modeP' , montant = ' $montant' , reste = '$reste' , dateP = '$dateP' WHERE idpa = '$idP';";
    // echo $sql;
    $exute = $conn -> query($sql);
    if($exute){
      echo"<script>alert('Votre modification est bien enregitré ..');</script>";
      header("location: payement.php");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  }

?>
</div>
</div>
</body>
</html>
