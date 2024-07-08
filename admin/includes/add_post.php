<?php

if (isset($_POST['create_post'])) {
    global $connection;

    $post_author = mysqli_real_escape_string($connection, $_POST['post_author']);
    $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
    $post_category_id = mysqli_real_escape_string($connection, $_POST['post_category_id']);
    $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    $post_date = date('d-m-y'); 

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts (post_author, post_title, post_category_id, post_status, post_image, post_tags, post_content, post_date, post_comment) ";
    $query .= "VALUES ('$post_author', '$post_title', '$post_category_id', '$post_status', '$post_image', '$post_tags', '$post_content', now(), '$post_comment')";
    
    $addpost = mysqli_query($connection, $query);

    confirmQuery($addpost);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_author">Author</label>
        <input type="text" class="form-control" id="post_author" name="post_author" required>
    </div>
    
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title" required>
    </div>
    
    <div class="form-group">
        <label for="post_category_id">Choose Category</label>
        <select class="form-control" id="post_category_id" name="post_category_id" required>
            <?php
            // Query to fetch all categories
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            // Display options for categories
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_status">Status</label>
        <select name="post_status" id="post_status" class="form-control">
            <option value="draft" <?php if (isset($post_status) && $post_status == 'draft') echo 'selected'; ?>>Draft</option>
            <option value="published" <?php if (isset($post_status) && $post_status == 'published') echo 'selected'; ?>>Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" class="form-control-file" id="post_image" name="post_image" required>
    </div>
    
    <div class="form-group">
        <label for="summernote">Content</label>
        <textarea class="form-control" id="summernote" name="post_content" rows="3" required></textarea>
    </div>
    
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" class="form-control" id="post_tags" name="post_tags" required>
    </div>
    
  
    
    <button type="submit" class="btn btn-primary" name="create_post">Add Post</button>
</form>
