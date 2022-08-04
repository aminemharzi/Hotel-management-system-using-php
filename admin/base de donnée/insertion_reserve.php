<?php
    include "db_connect.php";


if(isset($_POST["submit"])){
    $nameC = $_POST["nom"];
    $prenomC = $_POST["nom"];
    $adresseC = $_POST["adresseClient"];
    $teleC = $_POST["telephoneClient"];
    $ageC = $_POST["ageClient"];
    $dateN = $_POST["dateN"];
    $pays = $_POST["paysClient"];
    $genreC = $_POST["genreClient"];

    $sql = "INSERT INTO client(nomCl, prenomCl, adresseCl, paysCl,telephone, genre, dateNiss) VALUES ('$nom', '$prenomC', '$teleC', '$ageC', '$dateN','$pays','$genreC')";

    $requete = mysqli_query($conn, $sql);
    if ($requete) {
	echo "<script>alert('vous etes enregistre')</script>";
    }else{
	echo "<script>alert('il y a un probleme')</script>";
    }











}



?>


