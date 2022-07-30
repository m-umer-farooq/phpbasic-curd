<?php
require_once('includes/session.php');
include('includes/functions.php');

unset($_SESSION['username']);
unset($_SESSION['role']);

if(!isset($_SESSION['username']) && empty($_SESSION['username'])){
    redirect('login.php?success_message='.urlencode('Logout Successfully.'));
}

?>