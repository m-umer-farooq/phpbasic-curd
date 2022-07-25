<?php
    $success_message = '';
    $error_message = '';
    
    if(isset($_GET['success_message']) && !empty($_GET['success_message'])){
        $success_message = $_GET['success_message'];
    }

    if(isset($_GET['error_message']) && !empty($_GET['error_message'])){
        $error_message = $_GET['error_message'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" integrity="sha512-XWTTruHZEYJsxV3W/lSXG1n3Q39YIWOstqvmFsdNEEQfHoZ6vm6E9GK2OrF6DSJSpIbRbi+Nn0WDPID9O7xB2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>List User Data</title>
</head>
<body>


<main>
    <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                    <a href="list_users.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <span class="fs-4">User Management System</span>
                    </a>
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Add User</a></li>
                        <li class="nav-item"><a href="list_users.php" class="nav-link active">List Users</a></li>
                    </ul>
                </header>

                <?php if($success_message!=''){ ?>
                <div class="alert alert-success">
                    <?=$success_message?>
                </div>
                <?php }?>

                <?php if($error_message!=''){ ?>
                <div class="alert alert-danger">
                    <?=$error_message?>
                </div>
                <?php }?>

                <h4 class="mb-3">User Listing</h4>
        <div class="col-md-12">
    <?php
    $sql = "SELECT `id`,`first_name`,`last_name`,`email`,`mobile_number` FROM `users` ORDER BY `first_name` ASC LIMIT 10";

    require_once('classes/Database.php');

    $db = new Database();
    $users = $db->fetch_record($sql);
    
    if(!empty($users)){

    echo '<div class="table-responsive"><table class="table table-striped">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Action</th>
        </tr></thead><tbody>';
    
    foreach($users as $user)
    {
        
        echo '<tr>
            <td>'.$user->first_name.'</td>
            <td>'.$user->last_name.'</td>
            <td>'.$user->email.'</td>
            <td>'.$user->mobile_number.'</td>
            <td>
                <a href="edit_user.php?user_id='.$user->id.'">Edit</a>   
                <a href="delete_user.php?user_id='.$user->id.'">Delete</a>
            </td>
        </tr>';
    }  

    echo '</tbody></table></div>';

    //$users->free_result();

}else{
    echo 'No Record Found';
}
?>
</div>
</div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.bundle.min.js" integrity="sha512-9GacT4119eY3AcosfWtHMsT5JyZudrexyEVzTBWV3viP/YfB9e2pEy3N7WXL3SV6ASXpTU0vzzSxsbfsuUH4sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>