<?php
include "includes/db.php";
session_start();

if (isset($_POST["login"])) {
    $user_name_login = mysqli_real_escape_string($connection, $_POST["username"]);
    $user_password_login = mysqli_real_escape_string($connection, $_POST["password"]);

    $query = "SELECT * FROM users WHERE user_name = '{$user_name_login}'";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    if (mysqli_num_rows($select_user_query) == 1) {
        $row = mysqli_fetch_array($select_user_query);
        $db_user_password = $row['user_password'];

        // Verify password using password_verify()
        if (password_verify($user_password_login, $db_user_password)) {
            $db_user_id = $row['user_id'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
            $db_user_email = $row['user_email'];
            $db_user_randsalt = $row['user_randsalt'];

            $_SESSION['user_name'] = $db_user_name;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['user_email'] = $db_user_email;
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['user_randsalt'] = $db_user_randsalt;

            if ($db_user_role == 'admin') {
                header("Location: ../admin/index.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            header("Location: ../index.php");
            exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
