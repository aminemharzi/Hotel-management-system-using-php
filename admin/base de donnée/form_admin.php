<?php
    include "db_connect.php";


if(isset($_POST["ajoute"])){
    $nombresLits = $_POST["nombresLits"];
    $prix = $_POST["prix"];
    $etat = $_POST["etat"];
    $type = $_POST["typeCh"];
    $telephone = $_POST["telephone"];
    $service = $_POST["service"];



    $sql = "INSERT INTO chambre(nombresLits, prix, etat, telephone,telephone, genre, dateNiss) VALUES ('$nom', '$prenomC', '$teleC', '$ageC', '$dateN','$pays','$genreC')";

    $requete = mysqli_query($conn, $sql);
    if ($requete) {
	echo "<script>alert('vous etes enregistre')</script>";
    }else{
	echo "<script>alert('il y a un probleme')</script>";

    


}
if(isset($_POST["midifier"])){
    $nombresLits = $_POST["nombresLits"];
    $prix = $_POST["prix"];
    $etat = $_POST["etat"];
    $type = $_POST["typeCh"];
    $telephone = $_POST["telephone"];
    $service = $_POST["service"];



    $sql = "UPDATE chambre SET nombresLits = $nombresLits, prix = $prix , etat = $etat, telephone = $telephone  WHERE idChambre = $id";

    $requete = mysqli_query($conn, $sql);
    if ($requete) {
	echo "<script>alert('vous etes enregistre')</script>";
    }else{
	echo "<script>alert('il y a un probleme')</script>";
    

  }
?>