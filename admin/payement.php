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
            @$idreserve = $_GET['idreserve']; 
            
            $reserve = "SELECT * FROM reserve WHERE idreserve = '$idreserve' ;";
            $reserveE = $conn -> query($reserve);
            $res = $reserveE -> fetch_assoc();
            $rrr = "SELECT * FROM paiement WHERE idreserve = '$idreserve' ;";
                $rrrE = $conn -> query($rrr);
                $rrow = $rrrE -> fetch_assoc();
            $pp = $res['prix'] - $rrow['montant'];
            if (isset($_POST['submit'])) {

                $modeP = $_POST['modep'];
                $idR = $_POST['idreserve'];
                $montant = $_POST['montant'];
                $reserve = "SELECT * FROM reserve WHERE idreserve = '$idR' ;";
                $reserveE = $conn -> query($reserve);
                $res = $reserveE -> fetch_assoc(); 
                $dateP = $_POST['dateP'];
                $reste = $res['prix'] - $montant;
                $requete = "INSERT INTO paiement  VALUES (default , '$modeP' , '$montant' , '$reste' , '$dateP' , '$idR');";
                $Exute = $conn -> query($requete);

            }


?>
    <html>
    <head>
        <title>
        BOOKING.com
        </title>
        <link rel="icon" href="../logo/hotel-icon-isolated-on-black-background-simple-vector-20046631.jpg">
        <link rel="stylesheet" href="paiement.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    <body>

        <nav id="nav">
        
    <header class="text-center"><h3><?php echo @$nameUs;?></h3></header>
    <p class="text-center" id="role" style="color: grey;"><?php echo $roleUs ?></p>
      
    <br>
    <header><h4>Mon Menu</h4></header>
    <ul>
    <?php
        if($roleUs === "admin"){
  
    ?>

      <li><i class="fas fa-home"></i><a href="dashoard.php">Tableau de bord<i class="fas fa-caret-down"></i></a></li>
      <li ><i class="fas fa-chart-pie"></i><a href="adminmanagement.php">Gestion des chambres</a></li>
      <li><i class="fas fa-address-book"></i><a href="company.php">Gestion d'Hotel</a></li>
      <?php   } ?>
      <li><i class="fas fa-user"></i><a href="user.php">Utilisateurs</a></li>
      <li class="this"><i class="fas fa-money-check-alt"></i><a href="#">Paiement</a></li>
      <li ><i class="fas fa-id-badge"></i><a href="client.php">Gestion des Clients</a></li>
      <li><i class="fas fa-file-contract"></i><a href="reserve.php">Reservation</a></li>
      <br><br><br><br>
      <a href="log-out.php"><button  class="btn btn-Danger mb-3 w-100"><i class="fas fa-door-closed">Se déconnecter</i></button></a>
  </ul>
        </nav>

<div class="main">
        <header><h2>Paiement</h2></header>
        <?php
        if ($idreserve == "vous avez payé") {
            echo "<div class='bg-Success message'>$idreserve</div>";
         
        }
     
        ?>
    <div class="form">
    <form class="row g-3" action="payement.php" method="post">
    <div class="col-md-12">
        <label for="inputEmail4" class="form-label text-primary">ID Reserve = <?php echo "$idreserve"?></label>
        <input type="hidden" class="form-control" name="idreserve" id="inputEmail4" value=<?php echo $idreserve; ?> >
    </div>
    <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Date de Paiement</label>
        <input type="date" class="form-control" name="dateP" id="inputEmail4" required>
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Montant</label>
        <input type="number" class="form-control" min="0" id="inputEmail4" name="montant"value=<?php echo $pp;?> required>
    </div>
    <div class="col-md-6">
    <label for="montant" class="form-label">Montant</label><br>
            <select class="form-select" aria-label="Default select example" name="modep" required>
            <option value="caisse">Caisse</option>
            <option value="banque">Banque</option>
            <option value="chaique">Chaique banquaire</option>
            </select>
        
    </div>
    <div class="col-12">
    </div> 
    <div class="col-12">
        <button type="submit" class="btn btn-primary" name="submit">Payé</button>
    </div>
    </form>
    </div>
    <header><h2>Les Payements</h2></header>
    <table class="table table-hover">
            <thead>
                <th>#</th>
                <th>Mode de paiement</th>
                <th>Montant</th>
                <th>Date de Paiement</th>
                <th>Total de Facture</th>
                <th>ID client</th>
                <th>ID Reserve</th>
                <th>Reste</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                // $rem = "";
                $req = "SELECT p.idpa , p.modeP , p.montant , p.reste ,p.dateP , r.prix ,r.idClient , r.idreserve FROM paiement p , reserve r WHERE p.idreserve = r.idreserve;  ";
                $reqE = $conn -> query($req);
                while($row = $reqE -> fetch_assoc()){
   
                ?>
                <tr>
                    <td><?php echo $row['idpa'] ?></td>
                    <td><?php echo $row['modeP'] ?></td>
                    <td><?php echo $row['montant'] ?></td>
                    <td><?php echo $row['dateP'] ?></td>
                    <td><?php echo $row['prix'] ?></td>
                    <td><?php echo $row['idClient']?></td>
                    <td><?php echo $row['idreserve']?></td>
                    <td><?php echo $row['reste'];?></td>
                   
                    <td>
                        <a href="modifP.php?idP=<?php echo $row['idpa'];?>"><button class="btn btn-primary">Modifié</button></a>
                        <a href="suppP.php?idP=<?php echo $row['idpa'];?>"><button class="btn btn-Secondary">Supprimer</button></a>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
    </table>
  
        
    </div>
    
    <script>

    </script>

    
</body>
</html>