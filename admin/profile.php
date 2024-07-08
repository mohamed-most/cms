<?php include "includes/admin_header.php"; ?>

<?php
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    $query = "SELECT * FROM users WHERE user_name = '{$user_name}' ";
    $select_user_profile = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_profile)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
    }
}

if (isset($_POST['update_profile'])) {
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];


    $query = "UPDATE users SET ";
    $query .= "user_name = '{$user_name}', ";
    $query .= "user_password = '{$user_password}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_email = '{$user_email}' ";
    $query .= "WHERE user_id = {$user_id}";

    $update_user = mysqli_query($connection, $query);
    if (!$update_user) {
        die("QUERY FAILED" . mysqli_error($connection));
    } else {
        echo "Profile Updated";
    }
    // if($user_role !== 'admin'){
    //     header("Location: ../index.php");
    // }
}
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
                            Welcome to <?php echo $_SESSION['user_firstname'] . " " . $_SESSION['user_lastname']; ?>
                            <small>author</small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_name">Username:</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $user_name; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="user_firstname">First Name:</label>
                                <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo $user_firstname; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="user_lastname">Last Name:</label>
                                <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo $user_lastname; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password:</label>
                                <input type="password" class="form-control" id="user_password" name="user_password" value="<?php echo $user_password; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="user_role">Role:</label>
                                <select class="form-control" id="user_role" name="user_role" required>
                                    <option value="subscriber" <?php if ($user_role == 'subscriber') echo 'selected'; ?>>Subscriber</option>
                                    <option value="admin" <?php if ($user_role == 'admin') echo 'selected'; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email:</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="update_profile">Update Profile</button>
                        </form>
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
