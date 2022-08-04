

 <?php 
 include "../base de donnée/db_connect.php";
    @$id = $_GET['id'];
    echo "<script>alert('Hello : $id ...');</script>";

    $sql ="DELETE FROM service WHERE idService = '$id';";
    $exute = $conn -> query($sql);
    if($exute){
        $message = "Votre utilisateu".$id;
      echo"<script>alert('Votre suppression est bien enregitré ..');</script>";
      header("location: ../company.php?$message");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  

?>
