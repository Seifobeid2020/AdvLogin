<?php
include('database_connection.php');


$errors   = array();


if (isset($_POST['create_user_btn'])) {
    register();
// if(isAdmin){
//     header('location: home.php');
// }else{
//     header('location: login.php');
// }
}

// REGISTER USER
function register()
{
    // call these variables with the global keyword to make them available in function
    global $connect, $errors, $registered_username, $registered_email;
    
    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $registered_username   = e($_POST['username']);
    $registered_email      = e($_POST['email']);
    $registered_password_1 = e($_POST['password_1']);
    $registered_password_2 = e($_POST['password_2']);
    
    // form validation: ensure that the form is correctly filled
    if (empty($registered_username)) {
        array_push($errors, "Username is required");
    }
    else if (empty($registered_email)) {
        array_push($errors, "Email is required");
    }
    else if  (empty($registered_password_1)) {
        array_push($errors, "Password is required");
	}
	else if  (empty($registered_password_2)) {
        array_push($errors, "Password is required");
    }
    else if  (strlen($registered_password_1) < 8) {
        array_push($errors, "Password is too short");
    }
    else if  (strpos($registered_username, '@') !== false || strpos($registered_username, '#') !== false || strpos($registered_username, '$') !== false || strpos($registered_username, '%') !== false || strpos($registered_username, '^') !== false || strpos($registered_username, '&') !== false || strpos($registered_username, '*') !== false || strpos($registered_username, '!') !== false || strpos($registered_username, ',') !== false || strpos($registered_username, ';') !== false || strpos($registered_username, '.') !== false) {
        array_push($errors, "User Name contains invalid charachters (!@#$%^&*;,.)");
    }
    else if  (strpos($registered_password_1, '@') !== false || strpos($registered_password_1, '#') !== false || strpos($registered_password_1, '$') !== false || strpos($registered_password_1, '%') !== false || strpos($registered_password_1, '^') !== false || strpos($registered_password_1, '&') !== false || strpos($registered_password_1, '*') !== false || strpos($registered_password_1, '!') !== false || strpos($registered_password_1, ',') !== false || strpos($registered_password_1, ';') !== false || strpos($registered_password_1, '.') !== false) {
        array_push($errors, "Password contains invalid charachters (!@#$%^&*;,.)");
    }
    else if  (strpos($registered_email, '#') !== false || strpos($registered_email, '$') !== false || strpos($registered_email, '%') !== false || strpos($registered_email, '^') !== false || strpos($registered_email, '&') !== false || strpos($registered_email, '*') !== false || strpos($registered_email, '!') !== false || strpos($registered_email, ',') !== false || strpos($registered_email, ';') !== false) {
        array_push($errors, "Email contains invalid charachters (!#$%^&*;,)");
    }
    else if  ($registered_password_1 != $registered_password_2) {
        array_push($errors, "The two passwords do not match");
    }
    else if  (isexistname($registered_username)) {
        array_push($errors, "Username already exist! try another one");
    }
    else if (isexistemail($registered_email)) {
        array_push($errors, "Email already exist! try another one");
    }else{
    
    
    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $encrypted_password = md5($registered_password_1); //encrypt the password before saving in the database
        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            $query = "INSERT INTO user_details (user_name, user_email, user_password) 
            VALUES('".$registered_username."','".$registered_email."','".$encrypted_password."')";

$statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();




            if ($result) {
                $_SESSION['success'] = "New user successfully created!";
            } else {
                array_push($errors, "query went wrong");
			}
			// //???????????????????????????????????
            //  // get id of the created user
            // $logged_in_user_id = mysqli_insert_id($connect, $r);
            // $_SESSION['user']    = getUserById($logged_in_user_id); // put logged in user in session
            // $_SESSION['success'] = "You are now logged in";
            header('location: login.php');
        }
    }
}
    
}


//check exist username
function isexistname($name){
    $query = "select * from user_details WHERE user_name='".$name."'"; 
global $connect;
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
   
    if($result){
        return true;
    }else{
        return false;
    }
}


//check exist email
function isexistemail($email){
    global $connect;
    $query = "select * from user_details WHERE user_email='".$email."'";


    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
   





    if($result){
        return true;
    }else{
        return false;
    }
}

function e($val)
{
        return str_replace(' ', '', $val);;
}



function display_error()
{
    global $errors;
    
    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}

// change css thems
if(isset($_POST['submit_changeCSS'])){
    global $connect;
 
    $selected_val = $_POST['selection'];  // Storing Selected Value In Variable
    echo $selected_val;
    $query = "UPDATE login_style SET style_status = '0'";
  
    $statement = $connect->prepare($query);

$statement->execute();
    $query = "UPDATE login_style SET style_status = '1' WHERE style_number = '".$selected_val."'";
    $statement = $connect->prepare($query);
    $statement->execute();

    if ($statement) {
        $_SESSION['success'] = "style successfully updated!!";
    } else {
        array_push($errors, "query went wrong");
        
    }
}


//send verification email
if(isset($_POST['reset_password'])){
     send_email();
}
    
function  send_email(){
        global $errors, $connect;

        $verification_email = $_POST['verification_email'];
       
        if (empty($email)) {
           
            array_push($errors, "email is required");
        }
        else if (strpos($verification_email, '#') !== false || strpos($verification_email, '$') !== false || strpos($verification_email, '%') !== false || strpos($verification_email, '^') !== false || strpos($verification_email, '&') !== false || strpos($verification_email, '*') !== false || strpos($verification_email, '!') !== false || strpos($verification_email, ',') !== false || strpos($verification_email, ';') !== false) {
           
            array_push($errors, "Email contains invalid charachters (!#$%^&*;,)");
        }
         if (isexistemail($verification_email)) {    
          
            $to_email = $verification_email;
         
            $subject = 'Your password';
    
    
            $new_password = password_generate();
    
            $query= "UPDATE user_details SET user_password='".$new_password."' WHERE user_email='".$verification_email."'";
            $statement = $connect->prepare($query);
            $statement->execute();
           
    
            echo " we did it ";
            $headers = 'From: seifobeid22@gmail.com';
            mail($to_email,$subject,$new_password,$headers);  
            
            header("Location: login.php");  
    
        }else{

            header("Location: login.php");  

        }
        
        
        
    }



        function password_generate()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0,9);
    }
    if(isset($_POST['change_text'])){
        change_header();
    }
    
    function change_header(){    
        global $connect;

        $entered_value = $_POST['to_be_changed'];
        $query = "UPDATE strings SET string='".$entered_value."' WHERE id = 1";
        $statement = $connect->prepare($query);
        if ($statement->execute()) {
            $_SESSION['success'] = "text successfully updated!!";
        } else {
            array_push($errors, "query went wrong");
            
        }   
    }



?>