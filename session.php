<?php

// Starting a session and initializing session variables
session_start();

if(!isset($_SESSION['username'])){
    $_SESSION['username'] = '';
}

$_SESSION['error_msg'] = '';

?>