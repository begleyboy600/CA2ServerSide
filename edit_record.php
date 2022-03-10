<?php

// Get the record data
$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$subject = filter_input(INPUT_POST, 'subject');
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
$currency = filter_input(INPUT_POST, 'currency');
$time_stamp = filter_input(INPUT_POST, 'time_stamp');

// Validate inputs
if ($record_id == NULL || $record_id == FALSE || $category_id == NULL ||
$category_id == FALSE || empty($subject)) {
$error = "Invalid record data. Check all fields and try again.";
include('error.php');
} else {


// If valid, update the record in the database
require_once('database.php');

$query = 'UPDATE records
SET categoryID = :category_id,
subject = :subject,
amount = :amount,
currency = :currency,
time_stamp = :time_stamp
WHERE recordID = :record_id';

$statement = $db->prepare($query);
$statement->bindValue(':category_id', $category_id);
$statement->bindValue(':subject', $subject);
$statement->bindValue(':amount', $amount);
$statement->bindValue(':currency', $currency);
$statement->bindValue(':time_stamp', $time_stamp);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$statement->closeCursor();

// Display the Product List page
include('index.php');
}
?>