<?php
include('includes/functions.php');
require_once('classes/Database.php');


if(isset($_GET['user_id']) && !empty($_GET['user_id'])){

    $user_id = $_GET['user_id'];

    $sql = "DELETE FROM `users` WHERE `id` = $user_id";
    $db = new Database();

    $response = $db->execute_query($sql);

    if($response){
        redirect('list_users.php?success_message='.urlencode('Record Deleted Successfully'));
    }else{
        redirect('list_users.php?error_message='.urlencode($db->conn_error));   
    }

}else{

    redirect('list_users.php?error_message='.urlencode('user_id not in parameter'));
}

?>