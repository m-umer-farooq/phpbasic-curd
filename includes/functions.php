<?php

function redirect($url){
header('Location:'.$url);
exit;
}

function clean($data)
{
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    return $data;
}
function is_user_login(){
    if(!isset($_SESSION['username']) && empty($_SESSION['username'])){
        redirect('login.php?error_message='.urlencode('Session Expired'));
    }
}

?>