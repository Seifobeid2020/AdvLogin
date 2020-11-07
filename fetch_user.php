<?php

//fetch_user.php

include('database_connection.php');

session_start();


//if (isset($_POST['action'])&&$_POST['action'] == 'setOnline'){
// echo $_POST["user_id"];
// echo '<script> x
//    };
//      console.log("hi from into ws");
//</script>';
// echo " finish";
//
// sleep(1);
//}else {

 $query = "
SELECT * FROM user_details 
WHERE user_id != '" . $_SESSION["user_id"] . "' 
";


 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $output = '
<table class="table table-bordered table-striped">
 <tr>
  <td>Username</td>
  <td>Status</td>
  <td>Forse logout</td>
 </tr>
';

 foreach ($result as $row) {
  $status = '';
  $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
  $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
  $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);

  if ($user_last_activity > $current_timestamp) {
   $status = '<span class="label label-success">Online</span>';
   $status_for_button = "online";
  } else {
   $status = '<span class="label label-danger">Offline</span>';
   $status_for_button = "offline";
  }
  $output .= '
 <tr>
  <td>' . $row['user_name'] . '</td>
  <td>' . $status . '</td>
   <td>
   <button type="button" name="action1" class="btn btn-info btn-xs action1" id="action1" 
   data-user_id="'.$row["user_id"].'"      data-user_status="'.$status_for_button.'"    >  ON\OFF </button></td>
 </tr>
 ';
 }

 $output .= '</table>';

 echo $output;


//}



?>
