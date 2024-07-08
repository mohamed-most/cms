<?php 

function confirmQuery($result) {
    global $connection;
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));  
    }
}

function insertCategory(){
    if (isset($_POST['submit'])) {
        global $connection; 
        if (isset($_POST['cat_title']) && !empty($_POST['cat_title'])) {
            $category_title = mysqli_real_escape_string($connection, $_POST['cat_title']);
            $query = "INSERT INTO categories(cat_title) VALUES('$category_title')";
            $add_category = mysqli_query($connection, $query);
    
            if (!$add_category) {
                die('Query Failed: ' . mysqli_error($connection));
            } else {
                echo 'Category added successfully.';
            }
        } else {
            echo 'Category title cannot be empty.';
        }
    }

}




function deleteCategory() {
    
if (isset($_GET['delete'])) {
    global $connection; 
    $category_id = mysqli_real_escape_string($connection, $_GET['delete']);

    if (!empty($category_id)) {
        $query = "DELETE FROM categories WHERE cat_id = $category_id";
        $delete_category = mysqli_query($connection, $query);

        if (!$delete_category) {
            die('Query Failed: ' . mysqli_error($connection));
        } else {
            header("Location: categories.php");
            exit;
        }
        } else {
            echo 'Category ID cannot be empty.';
        }
    }
}


function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}


function updateCategory(){
    if (isset($_POST['update'])) {
        global $connection;
        $category_id = $_POST['cat_id']; // Ensure the category ID is passed as a hidden input
        $category_title = mysqli_real_escape_string($connection, $_POST['cat_title']);
        
        if (!empty($category_title)) {
            $query = "UPDATE categories SET cat_title = '$category_title' WHERE cat_id = $category_id";
            $update_category = mysqli_query($connection, $query);
    
            if (!$update_category) {
                die('Query Failed: ' . mysqli_error($connection));
            } else {
                echo 'Category updated successfully.';
                header("Location: categories.php"); // Redirect to categories page after updating
                exit;
            }
        } else {
            echo 'Category title cannot be empty.';
        }
    }
}

function editCategory () {
    if (isset($_GET['edit'])) {
        global $connection;
        // Check if the category ID is set and not empty
        $category_id = $_GET['edit'];
        if (!empty($category_id)) {
            $query = "SELECT * FROM categories WHERE cat_id = $category_id";
            $edit_category = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($edit_category)) {
                $category_id = $row['cat_id'];
                $category_name = $row['cat_title'];
                ?>
                <input type="hidden" name="cat_id" value="<?php echo $category_id; ?>">
                <input class="form-control" type="text" name="cat_title" value="<?php if(isset($category_name)) { echo $category_name; } ?>">
                <?php
            }
        }
    }


}

