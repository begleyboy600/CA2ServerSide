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
$queryCategory = "SELECT * FROM Users
WHERE user_ID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['user_name'];

// Get all categories
$queryAllCategories = 'SELECT * FROM Users
ORDER BY user_ID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM TransactionHistory
WHERE user_ID = :category_id
ORDER BY transaction_ID";
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
<h2>Categories</h2>
<nav>
<ul>
<?php foreach ($categories as $category) : ?>
<li><a href=".?category_id=<?php echo $category['user_ID']; ?>">
<?php echo $category['user_name']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of records -->
<h2><?php echo $category_name; ?></h2>
<table>
<tr>
<th>Transaction ID</th>
<th>User ID</th>
<th>Subject</th>
<th>Amount</th>
<th>Currency</th>
<th>Time Stamp</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($records as $record) : ?>
<tr>
<td><?php echo $record['transaction_ID']; ?></td>
<td class="right"><?php echo $record['user_ID']; ?></td>
<td class="right"><?php echo $record['subject']; ?></td>
<td class="right"><?php echo $record['amount']; ?></td>
<td class="right"><?php echo $record['currency']; ?></td>
<td class="right"><?php echo $record['time_stamp']; ?></td>
<td><form action="delete_record.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="">
<input type="hidden" name="category_id"
value="">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_record_form.php" method="post"
id="delete_record_form">
<input type="hidden" name="record_id"
value="">
<input type="hidden" name="category_id"
value="">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_record_form.php">Add Record</a></p>
<p><a href="category_list.php">Manage Categories</a></p>
</section>
<?php
include('includes/footer.php');
?>