<?php 
require_once('includes/session.php');
include('includes/functions.php');

is_user_login();

if($_POST){
    
    $errors = '';

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $password = $_POST['password'];

    if(isset($first_name) && empty($first_name)){
        $errors .= 'First name is required.<br />';
    }

    if(isset($last_name) && empty($last_name)){
        $errors .= 'Last name is required.<br />';
    }
    if(isset($mobile_number) && empty($mobile_number)){
        $errors .= 'Mobile number is required.<br />';
    }

    if(isset($email) && empty($email)){
        $errors .= 'Email is required.<br />';
    }

    if(isset($password) && empty($password)){
        $errors .= 'Password is required.<br />';
    }

    if($errors != ''){
        $errors_message =  $errors;
    }else{

        require_once('classes/Database.php');
        $db = new Database();

        $sql = "INSERT INTO `users` SET `first_name` = '$first_name',`last_name` = '$last_name', `email` = '$email',`mobile_number` = '$mobile_number', `password` = '$password' ";
        $response = $db->execute_query($sql);

        if($response){
            redirect('list_users.php?success_message='.urlencode('Record Added Successfully'));         
        }else{
            redirect('list_users.php?error_message='.urlencode($db->conn_error));   
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Add User</title>
</head>
<body>
<main>
    <div class="container">
        
    <?php include('includes/header.php');?>
    
            <?php if($errors_message!=''){ ?>
                <div class="alert alert-danger"><?=$errors_message?></div>

            <?php }?>
            <?php if($success_message!=''){ ?>
                <div class="alert alert-success"><?=$success_message?></div>

            <?php }?>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <h4 class="mb-3">Add User</h4>
                    <form action="index.php" method="POST">
                        
                        <label class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?=@$_POST['first_name']?>"><br />
                    
                        <label class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?=@$_POST['last_name']?>"><br />
                    
                        <label class="form-label">Mobile Number</label>
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control" value="<?=@$_POST['mobile_number']?>"><br />
                    
                        <label class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?=@$_POST['email']?>"><br />
                    
                        <label class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" value=""><br />
                    
                        <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div>
       
    </div>
    </main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.bundle.min.js" integrity="sha512-9GacT4119eY3AcosfWtHMsT5JyZudrexyEVzTBWV3viP/YfB9e2pEy3N7WXL3SV6ASXpTU0vzzSxsbfsuUH4sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>


