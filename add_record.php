<?php

// Get the product data
$user_ID = filter_input(INPUT_POST, 'user_ID', FILTER_VALIDATE_INT);
$subject = filter_input(INPUT_POST, 'subject');
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
$currency = filter_input(INPUT_POST, 'currency');
$time_stamp = filter_input(INPUT_POST, 'time_stamp');

// Validate inputs
if (
    $user_ID == null || $user_ID == false||
    $subject == null || $amount == null || $amount == false ||
    $currency == null || $time_stamp == null ) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
    exit();
} else {


    
    require_once('database.php');

    // Add the product to the database 
    $query = "INSERT INTO TransactionHistory
                 (user_ID, subject, amount, currency, time_stamp)
              VALUES
                 (:user_ID, :subject, :amount, :currency, :time_stamp)";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_ID', $user_ID);
    $statement->bindValue(':subject', $subject);
    $statement->bindValue(':amount', $amount);
    $statement->bindValue(':currency', $currency);
    $statement->bindValue(':time_stamp', $time_stamp);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}