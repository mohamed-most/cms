<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {

        $bulk_options = $_POST['bulk_options'];
        if ($bulk_options == 'publish') {
            $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $checkBoxValue";
            $update_to_published_status = mysqli_query($connection, $query);
        } elseif ($bulk_options == 'draft') {
            $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $checkBoxValue";
            $update_to_draft_status = mysqli_query($connection, $query);
        } elseif ($bulk_options == 'delete') {
            $query = "DELETE FROM posts WHERE post_id = $checkBoxValue";
            $delete_posts = mysqli_query($connection, $query);
        }
    }
}
?>

<?php
function viewAllPosts() {
    global $connection;

    // Fetch all categories once
    $categories = [];
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($cat_row = mysqli_fetch_assoc($select_categories)) {
        $categories[$cat_row['cat_id']] = $cat_row['cat_title'];
    }
    ?>
    <form action="" method="post">
        <table class="table table-bordered table-hover">
            <div id="bulkOptionsContainer" class="col-xs-4" style="padding-bottom: 10px; padding-left: 0">
                <select class="form-control" name="bulk_options">
                    <option value="">Select Options</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
            </div>
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Comment Counts</th>
                    <th>Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>View post</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM posts";
                $select_posts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_comment = $row['post_comment'];
                    $post_comment_count = $row['post_comment_count'];

                    // Lookup the category title
                    $cat_title = isset($categories[$post_category_id]) ? $categories[$post_category_id] : 'Unknown';
                    ?>
                    <tr>
                        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                        <td><?php echo $post_id; ?></td>
                        <td><?php echo $post_author; ?></td>
                        <td><?php echo $post_title; ?></td>
                        <td><?php echo $cat_title; ?></td>
                        <td><?php echo $post_status; ?></td>
                        <td><img src="../images/<?php echo $post_image; ?>" class="img-fluid img-thumbnail" style="max-width: 100px; height: auto;" alt=""></td>
                        <td><?php echo $post_tags; ?></td>
                        <td><?php echo $post_comment; ?></td>
                        <td><?php echo $post_comment_count; ?></td>
                        <td><?php echo $post_date; ?></td>
                        <td><a href="posts.php?source=edit_post&p_id=<?php echo $post_id; ?>" class="btn btn-primary">edit</a></td>
                        <td><a href="posts.php?del=<?php echo $post_id; ?>" class="btn btn-danger">delete</a></td>
                        <td><a href="../post.php?id=<?php echo $post_id; ?>" class="btn btn-primary">View post</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </form>
    <?php
}
?>

<?php
// Delete post function
if (isset($_GET['del'])) {
    global $connection;
    $the_post_id = $_GET['del'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}
?>
