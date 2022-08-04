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

    $sql = "SELECT nomH, adresseH, telephoneH, ville ,classH FROM hotel";

    $requete = $conn -> query($sql);
    $infoH = mysqli_fetch_row($requete);


    if(isset($_POST["ajoute"])){
        @$nomService = $_POST["nomService"];
        @$PrixService = $_POST["prixService"];

        $sql1 = "SELECT nomSe, prixSe FROM service WHERE nomSe = '$nomService'";
        $query = $conn -> query($sql);
        $info = mysqli_fetch_row($requete);
        if($info){
            echo "<script>alert('Cette service est déjà existe');</script>";

        }else{


        $query = "INSERT INTO service  VALUES (default ,'$nomService' , '$PrixService');";
        $exute = $conn -> query($query);
        }

    }

?>

<html>
    <head>
        <title>
            admin
        </title>
        <link rel="icon" href="../logo/hotel-icon-isolated-on-black-background-simple-vector-20046631.jpg">
        <link rel="stylesheet" href="company.css">
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

      <li><i class="fas fa-home"></i><a href="dashoard.php">Tableau de bord<i class="fas fa-caret-down"></i></a></li>
      <li><i class="fas fa-chart-pie"></i><a href="adminmanagement.php">Gestion des chambres</a></li>
      <li class="this"><i class="fas fa-address-book"></i><a href="#">Gestion d'Hotel</a></li>
      <li><i class="fas fa-user"></i><a href="user.php">Utilisateurs</a></li>
      <li><i class="fas fa-money-check-alt"></i><a href="payement.php">Paiement</a></li>
      <li><i class="fas fa-id-badge"></i><a href="client.php">Gestion des clients</a></li>
      <li><i class="fas fa-file-contract"></i><a href="reserve.php">Reservation</a></li>
      <br><br><br><br>
      <a href="log-out.php"><button  class="btn btn-Danger mb-3 w-100"><i class="fas fa-door-closed">Se déconnecter</i></button></a>
  </ul>

  </nav>
    <div class="chambres">
    <h1>Welcome Back <?php echo $nameUs?></h1>
    <div class="infos-hotel">
    <table class="table table-striped table-hover">
    <tr><th colspan="2">INFORMATION D'HOTEL</th></tr>
    <tr>
        <td class="non">Nom d'Hotel</td>
        <td><?php echo $infoH[0];?></td>
        
    
    </tr>
    <tr>
        <td class="non">Adresse d'Hotel</td>
        <td><?php echo $infoH[1];?></td>
        
    
    </tr>
    <tr>
        <td class="non">Telephone d'Hotel</td>
        <td><?php echo $infoH[2];?></td>
        
    
    </tr>
    <tr>
        <td class="non">VILLE</td>
        <td><?php echo $infoH[3];?></td>
       
    
    </tr>
    <tr>
        <td class="non">CLASSEMENT</td>
        <td><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></td>
        
    
    </tr>
    <tr>
        <td class="non">LOCALISATION</td>
        <td onclick="btns()"><i class="fas fa-map"></i></td>
        
    
    </tr>
    </table>
    </div>

    <div class="service">
        <header><h2>SERVICE DISPONIBLE</h2></header>
        <table class="table table-striped table-hover">
        <?php  
        $SQL = "SELECT * FROM service";

        $execute = mysqli_query($conn , $SQL);
        $row = $execute -> fetch_row(); 
        
        
        
        while($row = $execute -> fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row['nomSe']?></td>
                <td><?php echo $row['prixSe']?></td>
                <td><a href="suppression/supp_service.php?id=<?php echo $row['idService'];?>"><i class="far fa-trash-alt"></i></a></td>
                <td><a href="modification/modif_service.php?id=<?php echo $row['idService'];?>"><i class="fas fa-edit"></i></a></td>
            </tr>
            <?php 
        }
            mysqli_free_result($execute);  
            mysqli_close($conn);  

        
        ?>
            <tr><td colspan="4"><i onclick="ajouteService()" class="fas fa-plus-circle"></i></td></tr>
        </table>


    </div>
        

    </div>
    <div class="modal" id="modal">
        <div class="modal-contenu">
        <span class="close">&times;</span>
        <h2>Localisation</h2>
        <br><br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13225.358653010277!2d-5.004016!3d34.0351572!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x66f61984ec85f8f1!2sH%C3%B4tel%20Atlas%20Volubilis!5e0!3m2!1sfr!2sma!4v1626454342729!5m2!1sfr!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    <div class="modal" id="service">
        <div class="modal-contenu" id="service-ajoute">
        <span class="close">&times;</span>
        <h2>AJOUTER UNE SERVICE</h2>
        <br><br>
        <form action="company.php" method="post">
        <input type="text" name="nomService" placeholder="Nom de service">
        <br><br>
        <input type="number" name="prixService" min="1" placeholder="Prix de service">
        <br><br>
        <input type="submit" value="Ajouter" name="ajoute">
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
     function ajouteService(){
        var modal = document.getElementById("service");
        var ferme =  document.getElementsByTagName("span")[1];
            modal.style.display = "block";
        ferme.onclick = function (){
            modal.style.display = "none";
        }

     }
    
        </script>
    </body>
</html>