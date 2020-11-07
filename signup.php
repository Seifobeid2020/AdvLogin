<?php

include('functions.php');
?>
<!DOCTYPE html>
<html>
 <head>
  <title>How to Disable Enable User Login in PHP using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">Register</h2>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">Sign Up</div>
    <div class="panel-body">
     <form method="post">
      <span class="text-danger"><?php echo display_error(); ?></span>
      <div class="form-group">
       <label>User Name</label>
       <input type="text" name="username" id="username" class="form-control" />
      </div>
      <div class="form-group">
       <label>User Email</label>
       <input type="text" name="email" id="email" class="form-control" />
      </div>
      <div class="form-group">
       <label>Password</label>
       <input type="password" name="password_1" id="password_1" class="form-control" />
      </div>
      <div class="form-group">
       <label>Retype Password</label>
       <input type="password" name="password_2" id="password_2" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" name="create_user_btn" id="create_user_btn" class="btn btn-info" value="Register" />
      </div>
      <p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
     </form>
    </div>
   </div>
  </div>
 </body>
</html>
