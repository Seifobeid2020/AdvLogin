
<?php

//update_last_activity.php

include('database_connection.php');

session_start();

$query = "
UPDATE user_details
SET last_activity = now() 
WHERE user_id = '".$_SESSION["user_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();

echo "IMAP functions are not availabsadasd1231le. data base</br>\n";
?>
