<?php
require_once('includes/session.php');
include('includes/functions.php');
require_once('classes/Database.php');

    $errors_message = '';
    $success_message = '';

    if(isset($_GET['success_message']) && !empty($_GET['success_message'])){
        $success_message = $_GET['success_message'];
    }

    if(isset($_GET['error_message']) && !empty($_GET['error_message'])){
        $errors_message = $_GET['error_message'];
    }

    if($_POST){
        
        $errors = '';

        $user_name = $_POST['user_name'];
        $password = $_POST['password'];


        if(isset($user_name) && empty($user_name)){
            $errors .= 'Username is required.<br />';
        }

        if(isset($password) && empty($password)){
            $errors .= 'Password is required.<br />';
        }

        if($errors == ''){

            $db = new Database();
            $user = $db->login_user_check($user_name,$password);

            if(!empty($user)){

                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;
    
                redirect('list_users.php');
            }else{
                $errors_message = 'Invalid Login Details.';
            }
        }
        else{
            $errors_message = $errors;
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
    <title>USer Login</title>
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
                    <h4 class="mb-3">User Login</h4>
                    <form action="login.php" method="POST">
                        
                        <label class="form-label">User Name</label>
                        <input type="text" id="user_name" name="user_name" class="form-control" value=""><br />
                       
                        <label class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" value=""><br />
                    
                        <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="Login">
                    </form>
                </div>
            </div>
       
    </div>
    </main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.bundle.min.js" integrity="sha512-9GacT4119eY3AcosfWtHMsT5JyZudrexyEVzTBWV3viP/YfB9e2pEy3N7WXL3SV6ASXpTU0vzzSxsbfsuUH4sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
