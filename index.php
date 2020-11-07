<?php
//index.php
include("functions.php");
session_start();
//session_destroy();
//header("location:login.php");

// $servername = "localhost:3306";
// $username = "root";
// $password = "";
// $dbname = "testing";

// $connect = new mysqli($servername, $username, $password, $dbname);

if(!isset($_SESSION["type"]))
{



 header("location:login.php");
}
    //if(((time() - $_SESSION['last_login_timestamp']) >900)) // 900 = 15 * 60
//{
//
//
//
//
// echo '<script type="text/javascript">
//
//
//</script>';
//
//
//}    else
//{
//     $_SESSION['last_login_timestamp'] = time();
//
//}
$status='';


// if ($result->num_rows > 0) {
// while($row =$result->fetch_assoc()){

// }
// }


?>
<!DOCTYPE html>
<html>
 <head>
  <title>How to Disable Enable User Login in PHP using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>







 </head>
 <body>
<!--<script>   window.sock = new WebSocket("ws://localhost:5001");</script>-->
  <br />
  <div class="container">
   <h2 align="center">How to Disable Enable User Login in PHP using Ajax</h2>
   <br />
   <div align="right">

       <button id="logout_button">
           Logout
       </button>
   </div>




   <br />







   <?php

   if($_SESSION["type"] == "user")
   {









    $query = "SELECT * FROM user_details 
    WHERE user_email = :user_email";
    // $result= $connect->query($query);

    $stm = $connect->prepare($query);
   $user_emailS=$_SESSION['user_email'];

    $stm->execute(array(
    ':user_email'=> $user_emailS));
    $users=$stm->fetchAll();

    foreach($users as $user){
        if($user['user_status']== "Inactive") {

            header("Refresh: 0.000000001; url=logout.php");

        }

    }


    echo '<script type="text/javascript">
let user_id_login ="'.$_SESSION["user_id"].'";

 let user_name_login ="'.$_SESSION["user_name"].'";
 


 let session_id_login ="'.session_id().'";
 let ip_login  ="'.file_get_contents("https://api.ipify.org").'";



</script>';









    echo '<script> 
 

 
 
 
 
 
 
 $(document).ready(function(){
      setInterval( function(){



        update_last_activity();

      },5000



      );








      function update_last_activity()
      {

       $.ajax({
        url:"update_last_activity.php",
        method:"POST",
        success:function()
        {

        }
       })
      }
    });</script>
    <div id="user_details"></div>

    ';

    global $connect;

    $query = "Select string FROM strings WHERE id = 1";
    $statement=$connect->prepare($query);
    $statement->execute();
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
        $string = $row['string'];
        echo "<h1>".$string."</h1>";
   }

  }
   else
   {
  //   $username = ( $_SESSION["user_email"]);
  //   $password = ($_SESSION["user_password"]);


       echo '<script type="text/javascript">
let user_id_login ="'.$_SESSION["user_id"].'";

 let user_name_login ="'.$_SESSION["user_name"].'";
 


 let session_id_login ="'.session_id().'";
 let ip_login  ="'.file_get_contents("https://api.ipify.org").'";



</script>';





   ?>
   <br><br>

<form action="#" method="post">
<input type="text" name="to_be_changed">
<input type="submit" name="change_text" value="Change"/>
</form>
<br>

<form action="#" method="post">
  <select id= "selection" name="selection">
    <option value="0">Select Style Sheet:</option>
    <option value="1">1</option>
    <option value="2">2</option>

</select>
<br><br>

<input type="submit" name="submit_changeCSS" value="Submit" />
</form>

<br><br>

   <div class="panel panel-default">
        <div class="panel-heading">User Status Details</div>
        <div class="panel-body">
     <span id="message"></span>
            <div class="table-responsive" id="user_data">

             </div>
             <div id="user_details"></div>
     <script>

      $(document).ready(function(){
        load_user_data();

      function load_user_data()
      {
       var action = 'fetch';
       $.ajax({
        url:'action.php',
        method:'POST',
        data:{action:action},
        success:function(data)
        {
         $('#user_data').html(data);
        }
       });
      }
          $(document).on('click', '.action1', function(){
              var user_id = ""+$(this).data('user_id')+"";
              var user_status =  ""+$(this).data('user_status')+"";
              console.log(user_status);

                if(user_status == "offline"){
                    alert("the user is offline already");
                }
                else{
              if(confirm("Are you Sure you want to change status of this User ?")) {
                  // var action = 'setOnline';

                  // let sock = new WebSocket("ws://localhost:5001");
                  // let user_iD = '.$_POST["user_id"].';


                      sock.send(JSON.stringify({
                          type: "forse_logout",
                          user_ID: user_id,
                          user_name: "user_name",
                          session_ID: "session_id",
                          ip: "0.0.0.0"
                      }));

              }}

          });



      $(document).on('click', '.action', function(){
       var user_id = $(this).data('user_id');

       var user_status = $(this).data('user_status');
       var action = 'change_status';
       $('#message').html('');
       if(confirm("Are you Sure you want to change status of this User?"))
       {
        $.ajax({
         url:'action.php',
         method:'POST',
         data:{user_id:user_id, user_status:user_status, action:action},
         success:function(data)
         {
          if(data != '')
          {

           load_user_data();
           $('#message').html(data);
          }
         }
        });
       }
       else
       {
        return false;
       }
      });

fetch_user();

setInterval(function(){

 fetch_user();
 update_last_activity();
}, 5000);

function fetch_user()
{

 $.ajax({
  url:"fetch_user.php",
  method:"POST",
  success:function(data){
   $('#user_details').html(data);
  }
 })


}

function update_last_activity()
{
 $.ajax({
  url:"update_last_activity.php",
  method:"POST",
  success:function()
  {
    console.log("IMAP functions are not availabsadasdle.155sdada seif index<br />\n");
  }
 })
}







});




     </script>
    </div>
   </div>



   <?php
   }
   ?>
  </div>
  <script type="text/javascript">  document.getElementById('logout_button').onclick = function() {
      console.log("outtttttttttt");
      console.log(sock);
          window.logout_boolen = true;


          let user_name_logout ="<?php echo $_SESSION["user_name"];?>";
          let user_id_logout ="<?php echo $_SESSION["user_id"];?>";
         let session_id_logout= "<?php echo session_id();?>";
         let ip_logout  = "<?php echo file_get_contents('https://api.ipify.org'); ?>";





                 sock.send(JSON.stringify({
                     type: "logout",
                     user_name: user_name_logout,
                     user_ID: user_id_logout,
                     session_ID: session_id_logout,
                     Login_date: "",
                     Login_time: "",
                     user_IP: ip_logout
                 }));
           sock.close();
          // sock.onopen = function() {
          //     sock.send(JSON.stringify({
          //         type:"logout",
          //         user_name: user_name_logout,
          //         user_ID:user_id_logout,
          //         session_ID: session_id_logout,
          //         Login_date: "12366",
          //         Login_time: "yes",
          //         user_IP: ip_logout
          //     }));
          //
          // };



          // sock.onclose= function clear() {
          //     console.log("closed from client");
          //     sock.send(JSON.stringify({
          //         user_name: user_name_logout,
          //         user_ID:user_id_logout,
          //         session_ID: session_id_logout,
          //         Login_date: "123",
          //         Login_time: "yes",
          //         user_IP: ip_logout
          //     }));
          // };
          // sock.close();
          window.location.assign("logout.php");
      }</script>;
 <script type="text/javascript" src="client.js"></script>

 <script type="text/javascript">

let idleTime =0;
     $(document).ready(function () {
         //Increment the idle time counter every minute.
         var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

         //Zero the idle timer on mouse movement.
         $(this).mousemove(function (e) {
             idleTime = 0;
         });
         $(this).keypress(function (e) {
             idleTime = 0;
         });


     function timerIncrement() {
         idleTime = idleTime + 1;
         if (idleTime >19) { // 20 minutes
             let user_name ="<?php echo $_SESSION["user_name"]?>";
             let user_id = "<?php echo $_SESSION["user_id"]?>";
             let session_id ="<?php echo  session_id()?>";
             let ip  ="<?php echo file_get_contents("https://api.ipify.org")?>";


             // console.log(user_name + "       "+user_id +"       "+ session_id  +"       "+ ip);
             // session_timeout( user_name ,user_id,session_id,ip);
             sock.send(JSON.stringify({
                 type:"session_timeout",
                 user_name: user_name,
                 user_ID: user_id,
                 session_ID: session_id,
                 Login_date: "123",
                 Login_time: "yes",
                 user_IP: ip
             }));

       alert("your session is timed out.");

       window.location.assign("logout.php");
         }
     }});

 </script>

 </body>
</html>
