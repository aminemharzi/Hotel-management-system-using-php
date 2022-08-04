

 <?php 
 include "base de donnée/db_connect.php";
    @$idP = $_GET['idP'];
   // echo "<script>alert('Hello : $idU ...');</script>";

    $sql ="DELETE FROM paiement WHERE idpa = '$idP';";
    $exute = mysqli_query($conn ,$sql);
    if($exute){
        
      header("location: payement.php?$message");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  

?>
