<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
    FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
    $category_id = 1;
    }
    }

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'] ?? '';

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>
<div class="container">
<?php
include('includes/header.php');
?>
<h1>Record List</h1>

<aside>
<!-- display a list of categories -->
<h2 className="category-header">Categories</h2>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
    <div class="category">
<li><a class="category-list" href=".?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
</div>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of records -->
<h2 class="category-name"><?php echo $category_name; ?></h2>
<table cellpadding="0" cellspacing="0" border="0">
<tr class="tbl-header">
<th>Subject</th>
<th>Amount</th>
<th>Currency</th>
<th>Time Stamp</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr class="tbl-content">
<td><?php echo $record['subject']; ?></td>
<td><?php echo $record['amount']; ?></td>
<td><?php echo $record['currency']; ?></td>
<td><?php echo $record['time_stamp']; ?></td>

<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" class="delete-button" value="Delete">
</form></td>

<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="<?php echo $record['recordID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $record['categoryID']; ?>">
<input type="submit" class="edit-button" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<div className="add-container">
<a class="button" href="add_record_form.php">Add Record</a></p>
</div>
<div className="manage-categories-container">
<p><a class="button" href="category_list.php">Manage Categories</a></p>
</div>
</section>
<?php
include('includes/footer.php');
?>