<?php

// Connect to 'todo' database and catch errors if exist
// Make sure that you imported database.sql file first
try {
    $db = new PDO('mysql:host=localhost;dbname=todo;charset=utf8', 'root', '');
}
catch(Exception $e) {
   echo("<script> alert('Database Connection error');</script>");
   die();
}

?>