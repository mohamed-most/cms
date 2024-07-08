<?php
function viewAllComments()
{
    global $connection;

    // Fetch all comments
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

    echo '<table class="table table-bordered table-hover">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Author</th>';
    echo '<th>Email</th>';
    echo '<th>Status</th>';
    echo '<th>In Response To</th>';
    echo '<th>Content</th>';
    echo '<th>Date</th>';
    echo '<th>Approve</th>';
    echo '<th>Unapprove</th>';
    echo '<th>Delete</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo '<tr>';
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";

        // Lookup the post title
        $post_query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post = mysqli_query($connection, $post_query);
        $post_title = '';
        if ($post_row = mysqli_fetch_assoc($select_post)) {
            $post_title = $post_row['post_title'];
            $post_id = $post_row['post_id'];
            echo "<td><a href='../post.php?id=$post_id'>$post_title </a></td>";
        }

        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td><a href='comments.php?approve={$comment_id}' class='btn btn-primary'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}' class='btn btn-danger'>Unapprove</a></td>";
        echo "<td><a href='comments.php?del={$comment_id}' class='btn btn-danger'>Delete</a></td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

// delete comment function
if (isset($_GET['del'])) {
    global $connection;
    $the_comment_id = $_GET['del'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}


if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}