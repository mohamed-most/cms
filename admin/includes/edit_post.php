<?php

// Check if post ID is provided via GET parameter
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    
    // Query to select post details based on post_id
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_post_by_id = mysqli_query($connection, $query);

    // Fetch post details
    while ($row = mysqli_fetch_assoc($select_post_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment = $row['post_comment'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }
}

// Handle form submission when 'Edit Post' button is clicked
if (isset($_POST['edit_post'])) {
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_comment = $_POST['post_comment'];
    $post_content = $_POST['post_content'];

    // Update post image if a new file is uploaded
    if ($_FILES['post_image']['name']) {
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        move_uploaded_file($post_image_temp, "../images/$post_image");
    } else {
        $post_image = $post_image; // Use existing image if no new image is uploaded
    }

    // Construct the UPDATE query
    $query = "UPDATE posts SET ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_comment = '{$post_comment}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$the_post_id}";

    $update_post = mysqli_query($connection, $query);

    if (!$update_post) {
        die("QUERY FAILED ." . mysqli_error($connection));
    } else {
        echo "<script>alert('Post updated successfully!')</script>";
        // Optionally redirect to a confirmation page or back to the post list
    }
}

?>

<!-- HTML Form for Editing Post -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_author">Author</label>
        <input type="text" class="form-control" id="post_author" name="post_author" value="<?php echo $post_author; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post_title; ?>" required>
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

                // Set the selected attribute for the current post's category
                if ($cat_id == $post_category_id) {
                    echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
                } else {
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <img src="../images/<?php echo $post_image; ?>" alt="Current Image" style="max-width: 100px; height: auto;">
        <input type="file" class="form-control-file" id="post_image" name="post_image">
    </div>
    
    <div class="form-group">
        <label for="post_content">Content</label>
        <textarea class="form-control" id="post_content" name="post_content" rows="5" required><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" class="form-control" id="post_tags" name="post_tags" value="<?php echo $post_tags; ?>" required>
    </div>
    
    <div class="form-group">
    <label for="post_status">Status</label>
    <select class="form-control" id="post_status" name="post_status" required>
        <option value="draft" <?php if($post_status == 'draft') echo 'selected'; ?>>Draft</option>
        <option value="published" <?php if($post_status == 'published') echo 'selected'; ?>>Published</option>
    </select>
    </div>

    
    <div class="form-group">
        <label for="post_comment">Comments</label>
        <textarea class="form-control" id="post_comment" name="post_comment" rows="3" required><?php echo $post_comment; ?></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary" name="edit_post" value="edit_post">Edit Post</button>
</form>
