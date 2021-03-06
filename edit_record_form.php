<?php
require('database.php');

$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$records = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>

<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
<div class="form-style">
        <h1>Edit Product</h1>
        <form class="form" action="edit_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
              <input type="hidden" name="record_id"
                   value="<?php echo $records['recordID']; ?>">
                   

              <label class="label">Category ID:</label>
              <input class="category-id-input" type="category_id" name="category_id"
                   value="<?php echo $records['categoryID']; ?>">
              <br>

            <label class="label">Subject:</label>
            <input class="subject-input" type="input" name="subject"
                   value="<?php echo $records['subject']; ?>" required>
            <br>

            <label class="label">Amount:</label>
            <input class="amount-input" type="input" name="amount"
                     value="<?php echo $records['amount']; ?>" required pattern="[0-9]{1-3}.[0-9]{0-2}">
            <br>

            <label class="label">Currency:</label>
            <input class="currency-input" type="input" name="currency" 
                   value="<?php echo $records['currency']; ?>" required>
            <br>     
            
            <label class="label">Time Stamp:</label>
            <input class="time-stamp-input" type="input" name="time_stamp" 
                   value="<?php echo $records['time_stamp']; ?>" required>
            <br>
            
            
            <label>&nbsp;</label>
            <input class="submit-button" type="submit" value="Save Changes">
            <br>
        </form>
</div>
        <p><a class="homepage-button" href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>