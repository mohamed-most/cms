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




        if (isset($_POST['submit'])) {

            $search = $_POST['search'];

            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            $search_query = mysqli_query($connection, $query);
            if (!$search_query) {
                die("query failed". mysqli_error($connection));
            }
            else{
                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    echo "<h1>no result</h1>";
                }
                else{
                    
                    while ($row = mysqli_fetch_assoc( $search_query )) {
                        $title = $row["post_title"];
                        $author = $row["post_author"];
                        $date = $row["post_date"];
                        $image = $row["post_image"];
                        $content = $row["post_content"];
                        $post_id = $row["post_id"];
                        
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
                        by <a href="index.php"><?php echo $author?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                    <hr>
                    <p><?php echo $content; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
    
                    <hr>
                    <?php } ?>
               <?php }
            }
        }
        ?>









               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php";  ?>
