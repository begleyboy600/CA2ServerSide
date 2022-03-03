<?php
require('database.php');
$query = 'SELECT *
          FROM Users
          ORDER BY user_ID';
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
        <h1>Add Record</h1>
        <form action="add_record.php" method="post" enctype="multipart/form-data"
              id="add_record_form">

            <label>Transaction_ID:</label>
            <input type="input" name="name">
            <br>
            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['user_ID']; ?>">
                    <?php echo $category['user_name']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Subject:</label>
            <input type="input" name="subject">
            <br>

            <label>Amount:</label>
            <input type="input" name="amount">
            <br>        
            
            <label>Currency:</label>
            <input type="input" name="currency">
            <br>

            <label>Time Stamp:</label>
            <input type="input" name="time_stamp">
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add Record">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>