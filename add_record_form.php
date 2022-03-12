<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
<div class="form-style">
        <h1>Add Record</h1>
        <form class="form" action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">
       
              <label class="label">Category:</label>
            <select class="category-id-input-2" name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label class="label">Subject:</label>
            <input class="subject-input" type="input" name="subject" required>
            <br>

            <label class="label">Amount:</label>
            <input class="amount-input" type="input" name="amount" required pattern="[0-9]{1-3}.[0-9]{0-2}">
            <br>        
            
            <label class="label">Currency:</label>
            <input class="currency-input" type="input" name="currency" required>
            <br>

            <label class="label">Time Stamp:</label>
            <input class="time-stamp-input" type="input" name="time_stamp" required>
            <br>
            
            <label>&nbsp;</label>
            <input class="submit-button" type="submit" value="Add Record">
            <br>
        </form>
            </div>
        <p><a class="homepage-button" href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>