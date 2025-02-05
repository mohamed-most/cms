<?php include "includes/admin_header.php"; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to <?php echo $_SESSION['user_firstname']." ".$_SESSION['user_lastname']; ?>
                            <small>Author</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php

                                        $query = "SELECT * FROM posts";
                                        $select_all_posts = mysqli_query($connection, $query);
                                        $post_count = mysqli_num_rows($select_all_posts);
                                        ?>
                                        <div class='huge'><?php echo $post_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM comments";
                                        $select_all_comments = mysqli_query($connection, $query);
                                        $comment_count = mysqli_num_rows($select_all_comments);
                                        ?>
                                        <div class='huge'><?php echo $comment_count ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM users";
                                        $select_all_users = mysqli_query($connection, $query);
                                        $user_count = mysqli_num_rows($select_all_users);
                                        ?>
                                        <div class='huge'><?php echo $user_count ?></div>
                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories = mysqli_query($connection, $query);
                                        $category_count = mysqli_num_rows($select_all_categories);
                                        ?>
                                        <div class='huge'><?php echo $category_count ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                


                <?php

                    $query_all_poats = "SELECT * FROM posts ";
                    $select_all_posts = mysqli_query($connection, $query_all_poats);
                    $post_all_count = mysqli_num_rows($select_all_posts);

                    $query_draft = "SELECT * FROM posts WHERE post_status = 'draft' ";
                    $select_all_draft_posts = mysqli_query($connection, $query_draft);
                    $draft_post_count = mysqli_num_rows($select_all_draft_posts);

                    
                    $query_Published = "SELECT * FROM posts WHERE post_status = 'published' ";
                    $select_all_published_posts = mysqli_query($connection, $query_Published);
                    $post_published_count = mysqli_num_rows($select_all_published_posts);

                    $query_comment_approved = "SELECT * FROM comments WHERE comment_status = 'approved' ";
                    $select_all_approved_comments = mysqli_query($connection, $query_comment_approved);
                    $approved_comment_count = mysqli_num_rows($select_all_approved_comments);

                    $query_comment_unapproved = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                    $select_all_unapproved_comments = mysqli_query($connection, $query_comment_unapproved);
                    $unapproved_comment_count = mysqli_num_rows($select_all_unapproved_comments);

                    $query_user = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                    $select_all_subscribers = mysqli_query($connection, $query_user);
                    $user_role_count = mysqli_num_rows($select_all_subscribers);

                    $query_user_admin = "SELECT * FROM users WHERE user_role = 'admin' ";
                    $select_all_admins = mysqli_query($connection, $query_user_admin);
                    $user_admin_count = mysqli_num_rows($select_all_admins);


                ?>
                <div class="row">
                    
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data','count'],
          <?php
            $elements_text = ['All Posts','Published Posts' ,'Draft Posts', 'Comments' , 'Approved Comments' ,'pending Comments' , 'Users' ,'Admins','Subscribers' ,'Categories' ];
            $elements_count = [$post_all_count ,$post_published_count ,$draft_post_count , $comment_count , $approved_comment_count , $unapproved_comment_count  ,$user_count ,$user_admin_count ,$user_role_count ,$category_count];
            for($i = 0 ; $i < count($elements_text); $i++){
                echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
            }

            ?>
        ]);

        var options = {
          chart: {
            title: 'Website Stats',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
                  <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
                    
                    
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include('includes/admin_footer.php'); ?>

    </div>
    <!-- /#wrapper -->

</body>

</html>
