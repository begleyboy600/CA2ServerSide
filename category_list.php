<?php
    require_once('database.php');

    // Get all categories
    $query = 'SELECT * FROM categories
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
    <h1>Category List</h1>
    <table>
        <tr class="tbl-header">
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($categories as $category) : ?>
        <tr class="tbl-content">
            <td><?php echo $category['categoryName']; ?></td>
            <td>
                <form action="delete_category.php" method="post"
                      id="delete_product_form">
                    <input type="hidden" name="category_id"
                           value="<?php echo $category['categoryID']; ?>">
                    <input class="delete-button" type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>

    <div class="form-style">
    <h1>Add Category</h2>
    <form class="form" action="add_category.php" method="post"
          id="add_category_form">

        <label class="label">Name:</label>
        <input class="name-input" type="input" name="name">
        <input class="add-category-button" type="submit" value="Add">
    </form>
        </div>
    <br>
    <p><a class="homepage-button" href="index.php" class="btn btn-primary">Homepage</a></p>

    <?php
include('includes/footer.php');
?>
