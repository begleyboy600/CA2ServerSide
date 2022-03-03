<?php
// Get ID
$user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

// Validate inputs
if ($user_id == null || $user_id == false) {
    $error = "Invalid category ID.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'DELETE FROM Users 
              WHERE user_ID = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();

    // Display the Category List page
    include('user_list.php');
}
?>
