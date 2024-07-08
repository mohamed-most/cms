<?php
function viewAllUsers()
{
    global $connection;

    // Fetch all users
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    echo '<table class="table table-bordered table-hover">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Username</th>';
    echo '<th>Email</th>';
    echo '<th>First Name</th>';
    echo '<th>Last Name</th>';
    echo '<th>Password</th>';
    echo '<th>Role</th>';
    echo '<th>Randsalt</th>';
    echo '<th>Image</th>';
    echo '<th>Edit</th>';
    echo '<th>Delete</th>';
    echo '<th>change role</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
        $user_randsalt = $row['user_randsalt'];
        
        echo '<tr>';
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_password}</td>";
        echo "<td>{$user_role}</td>";
        echo "<td>{$user_randsalt}</td>";
        if($user_image == "") {
            echo "<td></td>";
        } else {
            echo "<td><img src='../images/{$user_image}' class='img-fluid img-thumbnail' style='max-width: 100px; height: auto;'></td>";
        }
        echo "<td><a href='users.php?source=edit_user&p_id={$user_id}' class='btn btn-primary'>Edit</a></td>";
        echo "<td><a href='users.php?del={$user_id}' class='btn btn-danger'>Delete</a></td>";
        echo "<td><a href='users.php?change={$user_id}' class='btn btn-primary'>change role </a></td>";
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
}

// delete comment function
if (isset($_GET['del'])) {
    global $connection;
    $the_user_id = $_GET['del'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
}
// Change user role function
if (isset($_GET['change'])) {
    global $connection;
    $the_user_id = $_GET['change'];

    // Fetch the current role of the user
    $query = "SELECT user_role FROM users WHERE user_id = $the_user_id";
    $select_user_role = mysqli_query($connection, $query);
    if (!$select_user_role) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($select_user_role);
    $current_role = strtolower($row['user_role']);

    // Determine the new role
    $new_role = '';
    if ($current_role === "admin") {
        $new_role = "subscriber";
    } else {
        $new_role = "admin";
    }

    // Update the user role in the database
    $query = "UPDATE users SET user_role = '{$new_role}' WHERE user_id = {$the_user_id}";
    $change_role = mysqli_query($connection, $query);
    if (!$change_role) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    header("Location: users.php");
}
