<?php

    $host = 'localhost';
    $db_name = 'login_system';
    $username = 'root';
    $password = '*B75r28*';
    $conn;
        
    $conn = null;
    try{
        $conn = new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }catch(PDOException $exception){
        echo 'Connection error: ' . $exception->getMessage();
    }

?>