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

?>
    <html>
    <head>
        <title>
        BOOKING.com
        </title>
        <link rel="icon" href="../logo/hotel-icon-isolated-on-black-background-simple-vector-20046631.jpg">
        <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
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
            <li  class="this"><i class="fas fa-home"></i><a href="#">Tableau de bord</a></li>
            <li ><i class="fas fa-chart-pie"></i><a href="adminmanagement.php">Gestion des chambres</a></li>
            <li><i class="fas fa-address-book"></i><a href="company.php">Gestion d'Hotel</a></li>
            <li><i class="fas fa-user"></i><a href="user.php">Utilisateurs</a></li>
            <li><i class="fas fa-money-check-alt"></i><a href="payement.php">Paiement</a></li>
            <li ><i class="fas fa-id-badge"></i><a href="client.php">Gestion des clients</a></li>
            <li><i class="fas fa-file-contract"></i><a href="reserve.php">Reservation</a></li>
            <br><br><br><br>
            <a href="log-out.php"><button  class="btn btn-Danger mb-3 w-100"><i class="fas fa-door-closed">Se déconnecter</i></button></a>
        </ul>
        </nav>
        <?php
            $today = date("Y-m-d");
            //TOTAL PAYEMENT
            $toP = "SELECT SUM(montant) AS tot FROM paiement";
            $ExuteP = $conn -> query($toP);
            $totaP = $ExuteP -> fetch_assoc();

            //TOTAL CHAMBRE
            $totalChambre = "SELECT * FROM chambre";
            $Exute = $conn -> query($totalChambre);
            $totalC = mysqli_num_rows($Exute); 
            //TOTAL RESERVER CHAMBRE
            $totalReser = "SELECT * FROM reserve";
            $exuteRe = $conn -> query($totalReser);
            $totalR = mysqli_num_rows($exuteRe);
            //TOTAL CHAMBRE VIDE
            $emptyC = "SELECT * FROM chambre WHERE idchambre not in (SELECT distinct c. idchambre as 'idchambre' FROM chambre c , reserve r WHERE c. idchambre = r. idchambre)";
            $emptyE = $conn -> query($emptyC);
            $empty = mysqli_num_rows($emptyE);
            //TOTAL CLIENT
            $totalClient = "SELECT * FROM client";
            $client = $conn -> query($totalClient);
            $toClient = mysqli_num_rows($client);
            //TOTAL USER
            $totalUser = "SELECT * FROM user";
            $user = $conn -> query($totalUser);
            $TCLIENT = mysqli_num_rows($user);
            //TOTAL PAYEMENT
            $payRe = "SELECT SUM(prix) as total FROM reserve";
            $prixE = $conn -> query($payRe);
            $totalPrix = $prixE -> fetch_row();
            $duree = abs(strtotime(date('Y-m-d H:i:s')) - strtotime(date('Y-m-d H:i:s')));
            $days = floor($duree/86400);
            $moins = "select sum(montant) AS montantM , month(dateP) AS mois, year(dateP) AS annee FROM paiement group by mois ORDER BY dateP ";
           //$moins =  "select montant , month(dateP) AS mois, year(dateP) AS annee FROM paiement group by mois ORDER BY dateP ";
           $moinsE = $conn -> query($moins);
           
           
           //$dateDiff = date_diff(date_create(date('Y-m-d H:i:s')), date_create(date('Y-m-d H:i:s')));
            // echo "<script>alert('$days');</script>";
            // while($row = $Exute -> fetch_assoc()) {  
            //     if($row['dateD'] ){

            //     }
            // } 
            //echo "<script>alert('$totalC chambre vide et  $totalPrix[0] $ et $TCLIENT total client et $empty chambre vide');</script>"; 
            ?>


<div class="main">
  <div class="date">
    <header><h2>Welcome Back <?php echo "$nameUs Le $today"; ?></h2></header>
    <br><br><br>
  </div>
  <div class="row mb-4">
    <div class="col-sm-3 bg-Light shadow ml-4">
    <h4>TOTAL CHAMBRE</h4></span>
      <h4><?php echo "$totalC Chambres";?></h4>
       <a href="adminmanagement.php"><button class="btn btn-Light">details</button></a>
    </div>
    <div class="col-sm-3 bg-Secondary shadow ml-4">
    <h4>TOTAL PAYEMENT</h4>
    <h4><?php echo $totaP['tot']." MAD";?></h4>
       <a href="payement.php"><button class="btn btn-Secondary">details</button></a>
    </div>
    <div class="col-sm-3 bg-info shadow ml-4">
    <h4>TOTAL RESERVATION</h4>
    <h4><?php echo "$totalR reserve";?></h4>
      <a href="reserve.php"><button class="btn btn-Info">details</button></a>

    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 bg-Success shadow ml-4">
    <h4>CHAMBRE VIDE</h4>
    <h4><?php echo "$empty Chambres";?></h4>
    <a href="adminmanagement.php"><button class="btn btn-Success">details</button></a>
    </div>
    <div class="col-sm-3  bg-Danger shadow ml-4">
    <h4>TOTAL CLIENT</h4>
    <h4 class="text-light"><?php echo $toClient." clients";?></h4>
      <a href="client.php"><button class="btn btn-Danger">details</button></a>
      
    </div>
    <div class="col-sm-3 mr-6  bg-Warning shadow ml-4">
    <h4>TOTAL FACTURE</h4>
    <h4><?php echo $totalPrix[0]." MAD";?></h4>
    <a href="reserve.php"><button class="btn btn-warning">details</button></a>

    <!-- </div> -->
  </div>
  <br><br><br>
            <head class="headerrrr">
              <h3>LES RESERVATIONS D'AUJOURD'HUI</h3>
            </head>
            <br><br><br>
            <table class="table table-success table-striped mt-5">
              <thead>
                <td>Numéro reserve</td>
                <td>Date de début</td>
                <td>Date de Fin</td>
                <td>Numéro de chambre</td>
                <td>Numéro de client</td>
              </thead>
              <tr>
                <?php 
                include "base de donnée/db_connect.php";
                $requete = "SELECT * FROM reserve WHERE  dateD = '$today'";
                $exe = $conn -> query($requete);
                while ($test =  $exe -> fetch_assoc()) {
    
                ?>
              <td><?php echo $test['idreserve'] ?></td>
              <td><?php echo $test['dateD'] ?></td>
              <td><?php echo $test['dateF'] ?></td>
              <td><?php echo $test['idchambre'] ?></td>
              <td><?php echo $test['idClient'] ?></td>
              </tr>
              <?php } ?>


             </table>
             </div>

             <div class="charts"> 
               <header class="text-center"><h2>Statistiques</h2></header>
        <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
        </div>
        
  
    </div>
    
    <script>
    

    google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Mois', 'paiement'],
              <?php
              while($rowM = $moinsE -> fetch_assoc()){
              
                echo"['".$rowM['mois']."-".$rowM['annee']."',". $rowM['montantM']."],";
        
              }

             ?>
    
            ]);
            var options = {
              chart: {
                title: 'paiement par mois',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      function addDarkmodeWidget() {
    new Darkmode().showWidget();
      }
    window.addEventListener('load', addDarkmodeWidget);
      
  
</script>

    
</body>
</html>