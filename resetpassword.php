
<?php
include('functions.php');
$message="";



?>
<!DOCTYPE html>
<html>

<head>
    <title>Log in</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <br />
    <div class="container">
        <h2 align="center">User Login</h2>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">Reset your Password</div>
                <div class="panel-body">
                <form action="functions.php" method="post">
                    <span class="text-danger"><?php echo $message; ?></span>
                    <div class="form-group">
                        <label>User Email</label>
                        <input type="text" name="verification_email" id="verification_email" class="form-control" />
                            <div class="form-group">
                              <input type="submit" name="reset_password" id="reset_password" class="btn btn-info" value="Send to your Email." />
                            </div>
                    </div>

            </div>

            </form>
        </div>
    </div>
    <br />

    </div>
</body>

</html>