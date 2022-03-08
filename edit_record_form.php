<?php
require('database.php');

$record_id = filter_input(INPUT_POST, 'transaction_ID', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM TransactionHistory
          WHERE transaction_ID = :transaction_ID';
$statement = $db->prepare($query);
$statement->bindValue(':transaction_ID', $record_id);
$statement->execute();
$records = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Product</h1>
        <form action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
            <input type="hidden" name="transaction_ID"
                   >

            <label>User ID:</label>
            <input type="category_id" name="user_ID"
                   >
            <br>

            <label>Subject:</label>
            <input type="input" name="subject"
                  >
            <br>

            <label>Amount:</label>
            <input type="input" name="amount"
                   >
            <br>

            <label>Currency:</label>
            <input type="input" name="currency" 
                     >
            <br>      
            
            <label>Time Stamp:</label>
            <input type="input" name="time_stamp"
                     >
            <br>
            
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>