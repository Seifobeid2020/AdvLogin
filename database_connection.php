<?php
//database_connection.php
$connect = new PDO('mysql:host=localhost:3306;dbname=testing', 'root', '');
date_default_timezone_set('Asia/Hebron');



function fetch_user_last_activity($user_id, $connect)
{
	
 $query = "
 SELECT * FROM user_details 
 WHERE user_id = '$user_id' 
 ORDER BY last_activity DESC 
 LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_activity'];
 }

}


?>