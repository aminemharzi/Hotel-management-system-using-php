

 <?php 
 include "../base de donnée/db_connect.php";
    @$id = $_GET['id'];
    echo "<script>alert('Hello : $id ...');</script>";

    $sql ="DELETE FROM client WHERE idClient  = '$id';";
    $exute = $conn -> query($sql);
    if($exute){
        $message = "Votre utilisateu".$id;
      echo"<script>alert('Votre suppression est bien enregitré ..');</script>";
      header("location: ../client.php?$message");
    }else{
      echo"<script>alert('Opps il y un probleme!!..');</script>";

    }

 
  

?>
