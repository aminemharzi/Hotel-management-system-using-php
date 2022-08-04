<?php

    session_start();
    @$_SESSION['idC'] = $idCli;
    @$emailUs = $_SESSION['emailUs'];
    @$nameUs = $_SESSION['nameUs'];
    @$iduser = $_SESSION['iduserUs'];  
    @$roleUs = $_SESSION['roleUs'];
    if(empty($emailUs) && empty($nameUs) && empty($iduser) && empty($roleUs)){
        header("location: index.php");

    }
include "base de donnée/db_connect.php";
 @$idCli = $_GET["idclient"];

        ?>
        <html>
            <head>
                <title>
            admin
            </title>
            <link rel="icon" href="../logo/hotel-icon-isolated-on-black-background-simple-vector-20046631.jpg">
            <link rel="stylesheet" href="reserve.css">
            <link rel="stylesheet" href="menubar.css">
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
      <li><i class="fas fa-chart-pie"></i><a href="adminmanagement.php">Gestion des chambres</a></li>
      <li><i class="fas fa-address-book"></i><a href="company.php">Gestion d'Hotel</a></li>
            <?php } ?>
      <li><i class="fas fa-user"></i><a href="user.php">Utilisateur</a></li>
      <li><i class="fas fa-money-check-alt"></i><a href="payement.php">Paiement</a></li>
      <li><i class="fas fa-id-badge"></i><a href="client.php">Gestion des clients</a></li>
      <li class="this"><i class="fas fa-file-contract"></i><a href="reserve.php">Reservation</a></li>
      <br><br><br><br>
      <a href="log-out.php"><button  class="btn btn-Danger mb-3 w-100"><i class="fas fa-door-closed">Se déconnecter</i></button></a>
  </ul>

  </nav>
    <div class="chambres">
    <div class="reserve">
            <fieldset>
            <header class="text-primary">ID Client = <?php echo $idCli?></header>
                <legend>RESERVE ICI</legend><br><br>
                <form action="reserve.php" method="post">
                <div class="row">
                    <div class="col">
                        Date de début
                    <input type="date" class="form-control" name="dateD" aria-label="First name">
                    <input type="hidden" name="idC" value=<?php echo $idCli?>>
                    </div>
                    <div class="col">
                        Date de fin
                    <input type="date" class="form-control" name="dateF" aria-label="First name">
                    </div>
                    <div class="col">
                        Nombre des Adults
                    <input type="number" class="form-control" onkeydown="filter()" id="adults" min="1" name="nbrAd" placeholder="Nombre des adults" aria-label="First name">
                    </div>
                    
                    <div class="col">
                        Nombre des enfants
                    <input type="number" class="form-control"  name="nbrEn"  id="enfants" min="0" placeholder="Nombre des enfants" aria-label="First name">
                    </div>
                    <div class="col">
                        Service 
                    <select name="service" id="" class="form-control">
                    <?php 
                    include "base de donnée/db_connect.php";
                $query = "SELECT idService , nomSe FROM service ;";
                $ser = $conn -> query($query);
               while($array = $ser -> fetch_assoc()){
                ?>
                <option value=<?php echo $array['idService']; ?>><?php echo $array['nomSe']; ?></option>          
                <?php } ?>  
                    </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Nombre des Lits
                    <input type="number" class="form-control"  min="1" name="nbrLit" placeholder="Nombre des adults" aria-label="First name">
                    
                    </div>
                </div>
                <br><br>
                
                <div class="filter">
                <table class="content-table" id="table">
            <thead>
                <tr>
                <th>#</th>
                <th>Lits</th>
                <th>Nombre des enfants</th>
                <th>Nombre des adultes</th>
                <th>Prix</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "base de donnée/db_connect.php";
                $request =$conn->query( "select * from chambre where idchambre not in (select distinct c.idchambre as 'idchambre' FROM chambre c, reserve r WHERE c.idchambre = r.idchambre)");
                while($Toutchambres = $request->fetch_assoc()){
                        ?>
                     <tr>
                         <td><?php echo $Toutchambres['idchambre']?></td>
                         <td><?php echo $Toutchambres['lits']?></td>
                         <td><?php echo $Toutchambres['max_child']?></td>
                         <td><?php echo $Toutchambres['max_adult']?></td>
                         <td><?php echo $Toutchambres['prixCH']?></td>
                         <td><input type="radio" name="numeroCh" id="" value=<?php echo $Toutchambres['idchambre']?>></td>
                        </tr>
                        
                    <?php
                }
                ?>
            </tbody>
            </table>
                </div>
                <div class="row">
                <div class="col">
                <input type="submit" value="Calculer" class="btn btn-primary" name="reserver">               
                </div>
                </div>
                <div>
                <table class="table table-striped table-hover">
                    <tr>
                        <th colspan="7">VOTRE RESEVERVATION</th>
                        
                    </tr>
                    <tr>
                        <th colspan="2">Chambre</th>
                        <th>Cout</th>
                        <th>Durée</th>
                        <th>Nombre des adults</th>
                        <th>Nombre des enfants</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    include "base de donnée/db_connect.php";
                    if(isset($_POST["reserver"])){
                        $dateD = $_POST["dateD"];
                        $dateF = $_POST["dateF"];
                        $service = $_POST["service"];
                        $nbrEnfant = $_POST["nbrEn"];
                        $nbrLit =  $_POST["nbrLit"];
                        $nbrAd = $_POST["nbrAd"];
                        $numeroC = $_POST["numeroCh"];
                        $idC = $_POST['idC'];
                        $duree = abs(strtotime($dateF) - strtotime($dateD));
                        $days = floor($duree/86400);
                        $_SESSION['id_client'] = $idC;
                        $_SESSION['dateD'] = $dateD ;
                        $_SESSION['dateF'] = $dateF ;
                        $_SESSION['service']= $service ;
                        $_SESSION['nbrEnfant'] = $nbrEnfant ;
                        $_SESSION['nbrLit'] =  $nbrLit ;
                        $_SESSION['nbrAd'] = $nbrAd ;
                        $_SESSION['numeroC'] = $numeroC ;
                        $_SESSION['days'] = $days ;    
                    }
                    @$idCli = $_GET["idclient"];
                    @$idCli = $_SESSION['id_client'];
                    @$dateD = $_SESSION['dateD'];
                    @$dateF = $_SESSION['dateF'];
                    @$serviceN = $_SESSION['service'];
                    @$nbrEnfant = $_SESSION['nbrEnfant'];
                    @$nbrLit = $_SESSION['nbrLit'];
                    @$nbrAd = $_SESSION['nbrAd'];
                    @$numeroC = $_SESSION['numeroC'];
                    @$days = $_SESSION['days'];   
                    @$chambre = "SELECT * FROM chambre WHERE idChambre  = '$numeroC';";
                    $exute = $conn -> query($chambre);
                    $infos = $exute -> fetch_assoc();
                    $total_chambre = $days * (($nbrAd * $infos['prixCH']) + ($nbrEnfant * 0.5 * $infos['prixCH']));
                    $serviceQ = "SELECT * FROM service WHERE idService = '$serviceN'";
                    $serviceE = $conn -> query($serviceQ);
                    $service = $serviceE -> fetch_assoc();
                    $prix_reserve = $total_chambre + $service['prixSe'];     
                  if(isset($_POST['check'])){
                    $email = $_POST['email'];
                    $subject = "Facture";
                    $body = "Bonjour Monsieur/Madame merci pour votre reservation voila votre facture \n la dureé est : $days jours.\n Numéro de chambre est : $numeroC. \n Numéro des personnes : $nbrAd. \n Numéro des enfants: $nbrEnfant. \n La service: $serviceN pour une prix de $prix_reserve. \n Total:$prix_reserve . ";
                    $headers = "From: HOTEL VOLUBILIS";
                    $mailto = mail($email, $subject, $body, $headers,);
                    if($mailto){
                       $messageE = "votre Facture est bien envoyé";
                    }else{
                        $messageE = "votre Facture n'est pas bien envoyé";
                    }
                    $verf ="SELECT * FROM reserve WHERE idchambre = '$numeroC'";
                    $verfE = $conn -> query($verf);
                    $verfChambre = $verfE -> fetch_assoc();
                    if($verfChambre['dateD'] === $dateD && ( $verfChambre['dateF'] === $dateF || $verfChambre['dateF'] > $dateF)){
                        echo "<script>vous ne pouvez pas de reserve cette chambre parce qu'il est déjà reserve</script>";
                    }else{
                    $id_client = $_SESSION['idC'];
                    $sql = "INSERT INTO reserve VALUES (default, '$dateD' , '$dateF', '$nbrAd' , '$nbrEnfant', '$prix_reserve' , '$idCli' , '$serviceN' , '$numeroC' )";
                    //echo $sql;
                    $requete = mysqli_query($conn, $sql);
                    if ($requete) {
                    echo "<script>alert('votre  etes enregistre')</script>";
    
                    }else{
                    echo "<script>alert('il y a un probleme')</script>";
                        }
                    }

                  }
                    ?>
                    <tr>
                    <td colspan="2"><?php echo $infos['idchambre'] ;?></td>
                        <td><?php echo $infos['prixCH'] ;?></td>
                        <td><?php echo $days ;?></td>
                        <td><?php echo $nbrAd ;?></td>
                        <td><?php echo $nbrEnfant ;?></td>
                        <td><?php echo $total_chambre ;?></td>
                    </tr>
                    <tr>
                    <th colspan="2">Service</th>
                        <th>Cout</th>
                        <th>Durée</th>
                        <th>Nombre des personnes</th>
                        <th>Total</th>
                    </tr>

                    <tr>
                    <td colspan="2"><?php echo $service['nomSe']; ?></td>
                        <td><?php echo $service['prixSe']; ?></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td><?php echo $service['prixSe']; ?></td>
                        </tr>        
                    <tr>
                        <th colspan="6">Total</th>
                        <td><?php echo $prix_reserve; ?></td>
                    </tr>
                </table>
                </div>
                <br><br>
                <div class="">
                <label for="form-control">Ajouter votre email pour recoie la facture</label>
                <input type="email" name="email" placeholder="email@example.com">
                </div>
                <input type="submit" value="RESERVE" name="check">
                
                </form> 
            </fieldset>
            </div>
            <div class="infos-reserve">
        <header><h2>LES RESERVATIONS</h2></header>
            <table class="table">
        <thead class="table-dark">
        <tr>
            <th>Numéro de chambre</th>
            <th>NOM client</th>
            <th>Prenom client</th>
            <th>Nombre des Adults</th>
            <th>Nombre des enfants</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Service</th>
            <th>Prix</th>
            <th>Payement</th>  
        </tr>
        </thead>
        <tbody>
        <?php
        include "base de donnée/db_connect.php";
        $rr= "SELECT   reserve.idreserve ,chambre.idchambre, client.nomCl , client.prenomCl,client.dateNiss ,reserve.dateD , reserve.dateF, service.nomSe, reserve.nombreAdulte , reserve.nombreEnfant , reserve.prix  FROM chambre , reserve , client , service WHERE chambre.idchambre = reserve.idchambre and reserve.idClient = client.idClient and reserve.idService = service.idService ";
        $rrE = $conn -> query($rr);
        while($reserveR = $rrE -> fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $reserveR['idchambre'] ?></td>
            <td><?php echo $reserveR['nomCl'] ?></td>
            <td><?php echo $reserveR['prenomCl'] ?></td>       
            <td><?php echo $reserveR['nombreAdulte'] ?></td>
            <td><?php echo $reserveR['nombreEnfant'] ?></td>
            <td><?php echo $reserveR['dateD'] ?></td>
            <td><?php echo $reserveR['dateF'] ?></td>
            <td><?php echo $reserveR['nomSe'] ?></td>
            <td><?php echo $reserveR['prix'] ?></td>
            <?php
             $reserveQ = "SELECT reste , idreserve ,montant FROM  paiement WHERE  idreserve = '".$reserveR['idreserve']."'";
             $reserveE = $conn -> query($reserveQ);
             $reserveM = $reserveE -> fetch_assoc();
              if($reserveM['reste'] == 0 && $reserveM['montant'] != 0 ){ 
                  ?>
                <td><a href="payement.php?idreserve=<?php echo "vous avez payé" ?>"><button class="btn btn-Success"><i class="fas fa-check"></i></button></a></td>

            <?php  }elseif($reserveM['reste']  > 0){
            
            ?>
            <td><a href="payement.php?idreserve=<?php echo $reserveM['idreserve'] ?>"><button class="btn btn-warning"><i class="fas fa-times-circle"></i></button></a></td>
            <?php }else{
            ?>
            <td><a href="payement.php?idreserve=<?php echo $reserveR['idreserve'] ?>"><button class="btn btn-primary"><i class="fas fa-exclamation-triangle"></i></button></a></td>

            <?php } ?>
        </tr>
        <?php  
        
        
        } ?>
        </tbody>
        </table>
        </div>
        </div>
        <script>
        function filter(){
            var input , table , tr, filter;
            input  = document.getElementById('adults');
            table = documment.getElemetById('table');
            filter = input.value;
            tr = table.getElementsByTagName('tr');
            for(i=0 , i < tr.lenght , i++){
                td = tr[i].getElementsByTagName('td')[3];
                if(td){
                    textValue = td.textContent || td.Text;
                    if(textValue.indexOf(filter) > -1){
                        tr[i].style.display = "";

                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        </script>
    </body>
</html>