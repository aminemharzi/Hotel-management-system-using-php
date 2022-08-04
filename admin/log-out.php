<?php
    session_start();
        $_SESSION['emailUs'] = "";
        $_SESSION['nameUs'] = "";
        $_SESSION['iduserUs'] = "";  
        $_SESSION['roleUs'] = "";
    session_unset();
        if(empty($emailUs) && empty($nameUs) && empty($iduser) && empty($roleUs)){
            header("location: index.php");


}





?>