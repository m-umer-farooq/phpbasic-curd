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

?>