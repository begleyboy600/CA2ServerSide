<?php
    $dsn = 'mysql:host=localhost;dbname=D00237052';
    $username = 'D00237052';
    $password = 'jTnPbX6S';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>