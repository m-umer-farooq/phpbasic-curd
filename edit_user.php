<?php 
include('includes/functions.php');
require_once('classes/Database.php');

$user_id = $_GET['user_id'];

$db = new Database();


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

   /*  if(isset($password) && empty($password)){
        $errors .= 'Password is required.<br />';
    } */

    if($errors != ''){
        $errors_message =  $errors;
    }else{

        $sql = "UPDATE `users` SET `first_name` = '$first_name',`last_name` = '$last_name', `email` = '$email',`mobile_number` = '$mobile_number'";

        if(isset($password) && !empty($password)){
            $sql .= ", `password` = '$password' ";
        }

        $sql .= "WHERE `id` = '$user_id'";

        $response = $db->execute_query($sql);

        if($response){
            redirect('list_users.php?success_message='.urlencode('Record Updated Successfully'));
          
            
        }else{
            redirect('list_users.php?error_message='.urlencode($db->conn_error));
            
        }
    }
}

$user = $db->get_user_by_id($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit User</title>
</head>
    <body class="bg-light">
        <main>
            <div class="container">
                <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                    <a href="list_users.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <span class="fs-4">User Management System</span>
                    </a>
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
                        <li class="nav-item"><a href="list_users.php" class="nav-link">List Users</a></li>
                    </ul>
                </header>
               
            <?php
                if(!empty($user)){
            ?>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form action="edit_user.php?user_id=<?=$user_id?>" method="POST" id="edit_user" name="edit_user">
                        <h4 class="mb-3">Edit User</h4>
                                            
                            <label class="form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="<?=$user['first_name']?>"><br />
                        
                            <label class="form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="<?=$user['last_name']?>"><br />
                       
                            <label class="form-label">Mobile Number</label>
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control" value="<?=$user['mobile_number']?>"><br />
                        
                            <label class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?=$user['email']?>"><br />
                        
                            <label class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password" value=""><br />
                        
                            <input type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary" value="Update">
                    </form>
                    </div>
                </div>

            <?php 
            }else{

                ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="alert alert-danger">No Record Found</div>
                    </div>
                </div>
                <?php
            }
            ?> 
            </div>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.bundle.min.js" integrity="sha512-9GacT4119eY3AcosfWtHMsT5JyZudrexyEVzTBWV3viP/YfB9e2pEy3N7WXL3SV6ASXpTU0vzzSxsbfsuUH4sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>

