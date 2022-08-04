<?php
    include "base de donnée/db_connect.php";
    session_start();

  @$emailUs = $_SESSION['emailUs'] ;
  @$nameUs = $_SESSION['nameUs'] ;
  @$iduser = $_SESSION['iduserUs'];  
  @$roleUs = $_SESSION['roleUs'];
  if(empty($emailUs) && empty($nameUs) && empty($iduser) && empty($roleUs)){
    header("location: index.php");

}
        
        if(isset($_POST["chambre"])){
            $telephone = $_POST["tele"];
            $prix = $_POST["prix"];
            $type = $_POST["typeCh"];
            $lits = $_POST["nombreLits"];
            $max_child = $_POST["max_child"];
            $max_adults = $_POST["max_personne"];
            if($type == "familiale"){
                $idCategorie = 1;

            }elseif ($type == "personnelle") {
                $idCategorie = 2;
            }


            $sql = "INSERT INTO chambre VALUES (default, '$telephone', '$lits', '$prix','1','$idCategorie', '$max_child', '$max_adults');";
            $result = $conn -> query($sql);
            if($result){
                $message = "Le chambre est bien enregitré ...";
                $color = "0";
                echo "<script>alert($message);</script>";

            }else{
                $message = "Le chambre n'est pas enregistré ...";
                $color = "1";
                echo "<script>alert($message);</script>";

            }


        }
?>

<html>
    <head>
        <title>
            admin
        </title>

        <link rel="stylesheet" href="adminmana.css">
        <link rel="stylesheet" href="menubar.css">
        <link rel="icon" href="../logo/hotel-icon-isolated-on-black-background-simple-vector-20046631.jpg">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

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
<header><h4>Mon Menu</h4></header>

<ul>
    <?php 
        if($roleUs === "admin"){

     ?>
      <li><i class="fas fa-home"></i><a href="dashoard.php">Tableau de bord<i class="fas fa-caret-down"></i></a></li>
      <li class="this"><i class="fas fa-chart-pie"></i><a href="#">Gestion des chambres</a></li>

      <li><i class="fas fa-address-book"></i><a href="company.php">Gestion d'Hotel</a></li>
      <?php  } ?>
      <li><i class="fas fa-user"></i><a href="user.php">Utilisateur</a></li>
      <li><i class="fas fa-money-check-alt"></i><a href="payement.php">Paiement</a></li>
      <li ><i class="fas fa-id-badge"></i><a href="client.php">Gestion des clients</a></li>
      <li><i class="fas fa-file-contract"></i><a href="reserve.php">Reservation</a></li>
      <br><br><br><br>
      <a href="log-out.php"><button  class="btn btn-Danger mb-3 w-100"><i class="fas fa-door-closed">Se déconnecter</i></button></a>
  </ul>

  </nav>
    <div class="chambres">
        <header>
            <h2>LES CHAMBRES</h2>
        </header>
            <table class="table table-striped table-hover" id="table">
      <thead>
      <tr>
        <th>#</th>
        <th>Telephone</th>
        <th>Lits</th>
        <th>Prix</th>
        <th>Max enfants</th>
        <th>Max adult</th>
        <th>Suppression</th>
        <th>Modification</th>
      </tr>
        </thead>
      <tbody>
            
            <?php 
            $sql = "SELECT * FROM chambre";
            $exute = $conn -> query($sql);
            $row = $exute -> fetch_row();
            
            while($row = $exute -> fetch_row()) {  ?>                  
            <tr>
                <td><?php echo $row[0]?></td>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[2]?></td>
                <td><?php echo $row[3]?></td>
                <td><?php echo $row[6]?></td>
                <td><?php echo $row[7]?></td>
                <td class="sup"><a href="suppression/supp_chambre.php?id=<?php echo $row[0] ?>"><i class="far fa-trash-alt"></i></a></td>
                <td class="modif"><a href="modification/modif_chambre.php?id=<?php echo $row[0] ?>"><i class="fas fa-edit"></i></a></td>
                
            </tr>
            <?php } ?>
            
        </tbody>
        </table>
            <?php
            if($roleUs === "admin"){

            
            
            ?>
            <header class="mt-4"><h2>Ajouter une chambre</h2></header>

        <div class="ajoute">
        <form action="adminmanagement.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="form-label">Nombre des lits</label>
                    <input type="number" class="form-control" name="nombreLits" id="inputEmail4" min="1" placeholder="Nombre des lits">
                </div>
                <div class="form-group col-md-6">
                <label for="inputPassword4">Prix</label>
                <input type="number" class="form-control is-success" name="prix" id="inputPassword4" min="10" placeholder="Prix">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword">Telephone</label>
                <input type="text" class="form-control text-success" name="tele" id="inputAddress" placeholder="Telephone">
            </div>
            <div class="form-group">
                <label for="inputPassword">Max personnes</label>
                <input type="text" class="form-control text-success" name="max_personne" id="inputAddress" placeholder="nombre des personne">
            </div>
            <div class="form-group">
                <label for="inputPassword">Max enfants</label>
                <input type="text" class="form-control text-success" name="max_child" id="inputAddress" placeholder="nombres des enfants">
            </div>
        <div class="form-row">
             <div class="form-group col-md-4">
            <label for="inputState">type</label>
            <select id="inputState" class="form-control" name="typeCh">
                <option selected>Choose...</option>
                <option value="familiale">familiale</option>
                <option value="personnelle">personnelle</option>
            </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="chambre">Ajouter</button>
    </form>
   
                <?php } ?>
        
           
        </div>


    </div>
    <div class="modal" id="modal">
        <div class="modal-contenu">
            <span class="close">&times;</span>
            <header><h2>Modification</h2></header>
            <form action="" methode="post">
            <p>Nombres des Lits</p>
            <input type="number" name="nombresLis" id="" min="1" max="4">
            <p>Prix</p>
            <input type="number" name="prix" id="" min="10">
            <p>L'etat</p>
            <input type="text" name="etat" id="">
            <p>Telephone</p>
            <input type="text" name="telephone" id="">
            <p>Type</p>
            <select name="type" id="">
                <option value="familiale">Familiale</option>
                <option value="personnell">Personnelle</option>
            </select>
            <p>Service</p>
            <input type="text" name="service" id=""><br><br>
            <input type="submit" name="submit" value="Mdifier">
        
            </form>
        
        </div>

    </div>


        
        <script>
     function btns(){
        var modal = document.getElementById("modal");
        var ferme =  document.getElementsByTagName("span")[0];
            modal.style.display = "block";
        ferme.onclick = function (){
            modal.style.display = "none";
        }

     }
        </script>
    </body>
</html>