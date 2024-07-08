<?php

if (isset($_GET['p_id'])) {
    global $connection;
    $user_id = $_GET['p_id'];
    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_user_by_id = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_user_by_id)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        $user_randsalt = $row['user_randsalt'];
    }
}
?>

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
            <option value="subscriber" <?php if ($user_role == 'subscriber') echo 'selected'; ?>>subscriber</option>
            <option value="admin" <?php if ($user_role == 'admin') echo 'selected'; ?>>Admin</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="user_email">Email:</label>
        <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="user_randsalt">Randsalt:</label>
        <input type="text" class="form-control" id="user_randsalt" name="user_randsalt" value="<?php echo $user_randsalt; ?>" required>
    </div>
    
    <div class="form-group">
        <label for="user_image">Profile Image:</label>
        <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
        <input type="file" class="form-control-file" id="user_image" name="user_image">
    </div>
    
    <button type="submit" class="btn btn-primary" name="Edit_user">Edit User</button>
</form>

<?php

if (isset($_POST['Edit_user'])) {
    global $connection;
    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
    $user_randsalt = $_POST['user_randsalt'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    // Handling the image upload
    if (!empty($user_image)) {
        move_uploaded_file($user_image_temp, "../images/$user_image");
    } else {
        // If no new image is uploaded, use the existing image
        $query = "SELECT user_image FROM users WHERE user_id = {$user_id}";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    // Update user query
    $query = "UPDATE users SET ";
    $query .= "user_name = '{$user_name}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_randsalt = '{$user_randsalt}', ";
    $query .= "user_image = '{$user_image}' ";
    $query .= "WHERE user_id = {$user_id}";

    $edit_user_query = mysqli_query($connection, $query);

    if (!$edit_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    } else {
        echo "User Updated Successfully!";
    }
}

?>
