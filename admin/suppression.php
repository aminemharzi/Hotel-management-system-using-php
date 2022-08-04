

 <?php 
 include "base de donnée/db_connect.php";
    @$idU = $_GET['idU'];
   // echo "<script>alert('Hello : $idU ...');</script>";

    $sql ="DELETE FROM user WHERE iduser = '$idU';";
    $exute =mysqli_query($conn ,$sql);
    if($exute){
        $message = "Votre utilisateu".$idU;
      echo"<script>alert('Votre suppression est bien enregitré ..');</script>";
      header("location: user.php?$message");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  

?>
