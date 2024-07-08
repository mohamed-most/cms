<?php

if (isset($_POST['create_user'])) {
    global $connection;

    $user_name = mysqli_real_escape_string($connection, $_POST['user_name']);
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    $user_email = mysqli_real_escape_string($connection, $_POST['user_email']);
    $user_randsalt = mysqli_real_escape_string($connection, $_POST['user_randsalt']);

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    // Assuming you have a 'users' table in your database
    $query = "INSERT INTO users (user_name, user_firstname, user_lastname, user_password, user_role, user_email, user_randsalt, user_image) ";
    $query .= "VALUES ('$user_name', '$user_firstname', '$user_lastname', '$user_password', '$user_role', '$user_email', '$user_randsalt', '$user_image')";
    
    $add_user = mysqli_query($connection, $query);

    confirmQuery($add_user);

    if (!$add_user) {
        die("QUERY FAILED" . mysqli_error($connection));
    } 
    else {
        echo "<script>alert('User Created Successfully!')</script>";
    }
    header("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_name">Username:</label>
        <input type="text" class="form-control" id="user_name" name="user_name" required>
    </div>
    
    <div class="form-group">
        <label for="user_firstname">First Name:</label>
        <input type="text" class="form-control" id="user_firstname" name="user_firstname" required>
    </div>
    
    <div class="form-group">
        <label for="user_lastname">Last Name:</label>
        <input type="text" class="form-control" id="user_lastname" name="user_lastname" required>
    </div>
    
    <div class="form-group">
        <label for="user_password">Password:</label>
        <input type="password" class="form-control" id="user_password" name="user_password" required>
    </div>
    
    <div class="form-group">
        <label for="user_role">Role:</label>
        <select class="form-control" id="user_role" name="user_role" required>
            <option value="subscriber">subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="user_email">Email:</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required>
    </div>
    
    <div class="form-group">
        <label for="user_randsalt">Randsalt:</label>
        <input type="text" class="form-control" id="user_randsalt" name="user_randsalt" required>
    </div>
    
    <div class="form-group">
        <label for="user_image">Profile Image:</label>
        <input type="file" class="form-control-file" id="user_image" name="user_image" required>
    </div>
    
    <button type="submit" class="btn btn-primary" name="create_user">Add User</button>
</form>
