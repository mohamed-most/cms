<?php include "includes/admin_header.php"; ?>

<?php
insertCategory();
?>

<?php 
deleteCategory();
?>

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
                            Welcome to admin 
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                                </div>
                            </form>
                            <?php
                            if (isset($_GET["edit"])) {
                                include "includes/edit_categories.php";
                            }
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    findAllCategories();
                                    ?>
                                </tbody>
                            </table>
                        </div>                        
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
   <?php include 'includes/admin_footer.php'; ?>
</body>
