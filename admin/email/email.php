<?php
    session_start();
    
$to_email = "amine.mharzi67@gmail.com";
$subject = "Facture";
$body = "Bonjour Monsieur/Madame merci pour votre reservation voila votre facture";
$headers = "From: sender\'s email";

 $mailto = mail($to_email, $subject, $body, $headers,);
if($mailto){
    header("location: ");
}
else{
    echo "<script>Opps il y a un probleme</script>";
}
?>