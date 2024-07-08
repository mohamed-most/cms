<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/nav.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            // Check if post_id is set in the URL
            if (isset($_GET["id"])) {
                $post_id = $_GET["id"];
            } else {
                // Redirect or handle the case where id is not provided
                header("Location: index.php");
                exit();
            }

            // Retrieve the post details based on post_id
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $title = $row["post_title"];
                $author = $row["post_author"];
                $date = $row["post_date"];
                $image = $row["post_image"];
                $content = $row["post_content"];
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                <hr>
                <img class="img-responsive blog-image" src="images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content; ?></p>
                <hr>
            <?php } ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST["create_comment"])) {
                $comment_author = $_POST["comment_author"];
                $comment_email = $_POST["comment_email"];
                $comment_text = $_POST["comment_text"];

                // Check if fields are not empty
                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_text)) {
                    // Insert new comment into database
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ($post_id, '{$comment_author}', '{$comment_email}', '{$comment_text}', 'unapproved', now())";
                    $create_comment_query = mysqli_query($connection, $query);
                    if (!$create_comment_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                    // Update comment count in posts table
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                    $update_count_query  = mysqli_query($connection, $query);
                    if (!$update_count_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                }
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <input class="form-control" name="comment_author" type="text" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="comment_email" type="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="comment_text" rows="3" placeholder="Your Comment" required></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <hr>

            <!-- Posted Comments -->
            <?php
            // Retrieve approved comments for the current post
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved' ORDER BY comment_id DESC LIMIT 5";
            $select_comment_query = mysqli_query($connection, $query);

            // Check if query executed successfully
            if (!$select_comment_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

            // Loop through and display approved comments
            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row["comment_date"];
                $comment_author = $row["comment_author"];
                $comment_text = $row["comment_content"];
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_text; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php include "includes/sidebar.php"; ?>
    </div>
    <hr>
    <?php include "includes/footer.php"; ?>
</div>
<!-- /.row -->

<style>
    .blog-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
