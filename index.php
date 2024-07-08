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
                $query = "SELECT * FROM posts";
                $select_all_posts_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    
                    $title = $row["post_title"];
                    $author = $row["post_author"];
                    $date = $row["post_date"];
                    $image = $row["post_image"];
                    $content = substr($row["post_content"] ,  0 , 50);
                    $post_id = $row["post_id"];
                    
                ?>
                 <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?id=<?php echo $post_id; ?>"><?php echo $title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                <hr>
                <a href="post.php?id=<?php echo $post_id; ?>">
                    <img class="img-responsive blog-image" src="images/<?php echo $image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $content; ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php } ?>
               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

            <hr>
            <?php include "includes/footer.php";  ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<style>
    .blog-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
