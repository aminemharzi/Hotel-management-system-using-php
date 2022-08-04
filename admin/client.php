<?php
     session_start();
     if($_SESSION['emailUs'] ==""){
        header("location: index.php");

    }

  include "base de donnée/db_connect.php";
 
  @$error = $_GET['error'];
  if($error === "true"){
      echo "<script>alert('Vous devez selectionez le client');</script>";

  }

  @$emailUs = $_SESSION['emailUs'] ;
  @$nameUs = $_SESSION['nameUs'] ;
  @$iduser = $_SESSION['iduserUs'];  
  @$roleUs = $_SESSION['roleUs'];
  

    if(isset($_POST["submit"])){
        $nomCli = $_POST["nomClient"];
        $prenom = $_POST["prenomClient"];
        $adresse = $_POST["adresseClient"];
        $tele = $_POST["telephoneClient"];
        $dateNss = $_POST["dateN"];
        $pays = $_POST["paysClient"];
        $genre = $_POST["genreClient"];
    
        
        $sql = "INSERT INTO client  VALUES (default ,'$nomCli' , '$prenom', '$adresse' , '$pays', '$tele', '$genre', '$dateNss');";
            $exute = $conn -> query($sql);
            if($exute){
                echo "<script>alert('Vous etes Enregistré');</script>";
            }else{
                echo "<script>alert('Il y a un probleme');</script>";

            
        }
    
        if(isset($_POST["modifi"])){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $tele = $_POST["telephone"];
        $dateNss = $_POST["dateN"];
        $pays = $_POST["pays"];
        $genre = $_POST["genre"];
        $emailC = $_POST["email"];

        $sql = "INSERT INTO client  VALUES (default ,'$nomCli' , '$prenom', '$adresse' ,'$pays','$tele', '$genre','$dateNss', '$emailC');";
            $exute = $conn -> query($sql);
            if($exute){
                echo "<script>alert('Votre modification est bien enregistré');</script>";
            }else{
                echo "<script>alert('Pardon Il y a un probleme ...');</script>";

            }
        }
    }
?>

<html>
    <head>
        <title>
            admin
        </title>

        <link rel="stylesheet" href="client.css">
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
      <li ><i class="fas fa-chart-pie"></i><a href="adminmanagement.php">Gestion des chambres</a></li>
      <li><i class="fas fa-address-book"></i><a href="company.php">Gestion d'Hotel</a></li>
      <?php   } ?>
      <li><i class="fas fa-user"></i><a href="user.php">Utilisateurs</a></li>
      <li><i class="fas fa-money-check-alt"></i><a href="payement.php">Paiement</a></li>
      <li class="this"><i class="fas fa-id-badge"></i><a href="#">Gestion  des clients</a></li>
      <li><i class="fas fa-file-contract"></i><a href="reserve.php">Reservation</a></li>
      <br><br><br><br>
      <a href="log-out.php"><button  class="btn btn-Danger mb-3 w-100"><i class="fas fa-door-closed">Se déconnecter</i></button></a>
  </ul>

  </nav>
    <div class="chambres">
        <div class="form">
        <fieldset>
            <legend>Ajouter une Client</legend>
            <form action="client.php" method="post">
                <div class="half1"> 
                <p>Nom</p>
                <input type="text" name="nomClient" required>
                <p>Prenom</p>
                <input type="text" name="prenomClient" required>
                <p>Adresse</p>
                <input type="text" name="adresseClient" required>
                <p>Telephone</p>
                <input type="text" name="telephoneClient" required>
                </div>
                <div class="half2">
                <p>Age</p>
                <input type="number" name="ageClient" min="18" required>
                <p>Date de Naissance</p>
                <input type="date" name="dateN" required>
                <p>Pays</p>
                <input type="text" name="paysClient" required>              
                <p>Genre</p>
                <select name="genreClient" id="">
                    <option value="M">Musculin</option>
                    <option value="F">Femnin</option>
                </select>
                </div>
                <input type="submit" value="Enregitrer" name="submit" required>
               
               

            </form>
        </fieldset>
        </div>
        <div>
        <table class="table table-striped table-hover">
       
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse</th>
                <th>Pays</th>
                <th>Telephone</th>
                <th>genre</th>
                <th>Date de naissance</th>
                <th>Suppression</th>          
                <th>Modification</th>
                <th>Reserve</th>
            </tr>
            <?php

$requete = "SELECT * FROM client";
$result = $conn -> query($requete);

while($row = $result -> fetch_row()){ ?>
                <tr>
                <td><?php echo $row[0] ?></td>
                <td><?php echo $row[1] ?></td>
                <td><?php echo $row[2] ?></td>
                <td><?php echo $row[3] ?></td>
                <td><?php echo $row[4] ?></td>
                <td><?php echo $row[5] ?></td>
                <td><?php echo $row[6] ?></td>
                <td><?php echo $row[7] ?></td>
                <td class='sup'><a href="suppression/supp_client.php?id=<?php echo $row[0]?>"><i class='far fa-trash-alt'></i></a></td>
                <td class='modif'><a href="modification/modif_client.php?id=<?php echo $row[0]?>"><i class="fas fa-edit"></i></a></td>
                <td><a href="reserve.php?idclient=<?php echo $row[0]?>"><i class='fas fa-key'></i></a></td>
                
            </tr>
            <?php }
            
            mysqli_free_result($result);
            
            mysqli_close($conn);?>
        </table>
        </div>

    </div>
    <div class="modal" id="modif">
        <div class="modal-contenu" id="modif-contenu">
            <span class="close">&times;</span>
            <header><h2>Modification</h2></header>

            <form action="client.php" methode="post">
            <?php

    $requete = "SELECT nomCl, prenomCl, adresseCl, paysCl, telephone, genre, dateNiss  FROM client WHERE idClient";
    $result = $conn -> query($requete);
    $row = $result -> fetch_row(); ?>
        

            <p>Nom</p>
            <input type='text' name='nom' id='' min='1' max='4' value=<?php echo "$row[0]"?>>
            <p>Prenom</p>
            <input type='text' name='prenom' id='' min='10' value=<?php echo "$row[1]"?>>
            <p>Adresse</p>
            <input type='text' name='adresse' id='' value=<?php echo "$row[2]"?>>
            <p>Telephone</p>
            <input type='text' name='tele' value=<?php echo "$row[3]"?>>
            <p>Pays</p>
            <input type='text' name='pays' value=<?php echo "$row[4]"?>>
            <p>Age</p>
            <input type='number' min='18' name='age' value=<?php echo "$row[5]"?>>
            <p>Date de Naissance</p>
            <input type='date' name='dateN' id='' value=<?php echo "$row[6]"?>><br><br>
            <input type='submit' name='modifi' value='Mdifier'>
            </form>
        
        </div>

    </div>
    
        <script>
             function btns(){
        var modal = document.getElementById("modif");
        var ferme =  document.getElementsByTagName("span")[0];
            modal.style.display = "block";
        ferme.onclick = function (){
            modal.style.display = "none";
        }

     }
    
        </script>
    </body>
</html>
