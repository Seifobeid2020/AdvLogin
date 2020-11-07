<?php     
$to_email = 'seifobeid11@gmail.com';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: seifobeid22@gmail.com';
mail($to_email,$subject,$message,$headers);
?>