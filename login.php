<?php
include('database_connection.php');

session_start();
$message = '';
if(isset($_SESSION["type"])){

    header("location:index.php");
}
if(isset($_POST["login"]))
{
 if(empty($_POST["user_email"]) && empty($_POST["user_password"]))
 {
  $message = "<div class='alert alert-danger'>Both Fields are required</div>";
 }
else if (empty($_POST["user_email"])){

  $message = "<div class='alert alert-danger'>Email Field is required</div>";


}
 else
 {
  $query = "
  SELECT * FROM user_details 
  WHERE user_email = :user_email
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    'user_email' => $_POST["user_email"]
   )
  );
  $count = $statement->rowCount();


  if($count > 0)
  {
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      if($row["user_status"] == 'Active')
      {

          echo  $row["user_password"];echo "\n";
          $leen = md5($_POST["user_password"]);




          if(password_verification($leen))
        {

            $_SESSION["user_name"]= $row["user_name"];
          $_SESSION["user_email"]= $row["user_email"];
          $_SESSION["user_password"]= $row["user_password"];
          $_SESSION["user_id"]=$row['user_id'];
          $_SESSION["type"] = $row["user_type"];
          $_SESSION['last_login_timestamp'] = time();

             $username = ( $_SESSION["user_email"]);

    $password = ($_SESSION["user_password"]);





   if (!empty($_POST["remember"])) {
     $time = time() + (10 * 365 * 24 * 60 * 60); //store cookie for one yearsetcookie("member_login", $username, $time);

      setcookie("member_password",$_POST["user_password"], $time);
       setcookie("member_login",$row['user_email'], $time);
//     $_SESSION["admin_name"] = $name;
  } else {
      if (isset($_COOKIE["member_login"])) {
          setcookie("member_login", "");
      }
      if (isset($_COOKIE["member_password"])) {
          setcookie("member_password", "");
      }
  }

            header("location:index.php");

        }
        else
        {
          $message = '<div class="alert alert-danger">Wrong Password</div>';
        }
      }
      else
      {
        $message = '<div class="alert alert-danger">Your Account has been disabled, please contact admin</div>';
      }
    }
  }
  else
  {
    $message = "<div class='alert alert-danger'>Wrong Email Address</div>";
  }
}
}

$cookie_name  = "users";
$cookie_value = "";
setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day

function password_verification($pass){
  global $connect;
  $email = $_POST["user_email"];
  $query = " SELECT user_password FROM user_details WHERE user_email ='".$email."'  and user_password ='".$pass."' ";
  $statement=$connect->prepare($query);
  $statement->execute();
  $count = $statement->rowCount();
  if($count > 0){
    return true;
}else {
   return false;

}
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Log in</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

  <link type="text/css" rel="stylesheet" media="all" href="style1.css" id="theme_css" />

  <?php
global $connect;

$query = "Select style_number FROM login_style WHERE style_status = '1'";


$statement = $connect->prepare($query);

$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row) {
    $style_number = $row['style_number'];
    echo $style_number;
    echo '<script> document.getElementById("theme_css").href = "style'.$style_number.'.css";</script>';
    }
    // else {
    //     array_push($errors, "query went wrong");

    // }

?>


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">User Login</h2>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">Login</div>
    <div class="panel-body">
     <form  method="post">
      <span class="text-danger"><?php echo $message; ?></span>
      <div class="form-group">
       <label>User Email</label>
       <input type="text" name="user_email" id="user_email" class="form-control" value="<?php
if (isset($_COOKIE["member_login"])) {
    echo $_COOKIE["member_login"];
}
?>" />
      </div>
      <div class="form-group">
       <label>Password</label>
       <input type="password" name="user_password" id="user_password" class="form-control" value="<?php
if (isset($_COOKIE["member_password"])) {
    echo $_COOKIE["member_password"];
}
?>"/>
      </div>
      <div class="form-group">
       <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
      </div>
      <div class="form-group">
     <input type="checkbox" name="remember" <?php
if (isset($_COOKIE["member_login"])) {
?> checked <?php
}
?> />
     <label for="remember-me">Remember me</label>
    </div>
      <p>
                Not yet a member? <a href="signup.php">Sign up</a>
            </p>
            <p>
                Forget your password? <a href="resetpassword.php">Forget Password</a>
            </p>
     </form>
    </div>
   </div>
   <br />
   <p>Admin email - john_smith@gmail.com</p>
   <p>Admin Password - password</p>
   <p>All user password is 'password'</p>
  </div>
 </body>
</html>


<!-- logout.php -->
