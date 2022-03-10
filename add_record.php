<?php

// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$subject = filter_input(INPUT_POST, 'subject');
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
$currency = filter_input(INPUT_POST, 'currency');
$time_stamp = filter_input(INPUT_POST, 'time_stamp');

// Validate inputs
if (
    $category_id == null || $category_id == false ) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
    exit();
} else {


    
    require_once('database.php');

    // Add the product to the database 
    $query = "INSERT INTO records
                 (categoryID, subject, amount, currency, time_stamp)
              VALUES
                 (:category_id, :subject, :amount, :currency, :time_stamp)";
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':subject', $subject);
    $statement->bindValue(':amount', $amount);
    $statement->bindValue(':currency', $currency);
    $statement->bindValue(':time_stamp', $time_stamp);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}