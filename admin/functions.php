<?php

function escape($string)
{
    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function users_online()
{
    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {
            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 60;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == null) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    }
}

users_online();

function confirm($result)
{
    global $connection;

    if (!$result) {
        die("Query failed!" . mysqli_error($connection));
    }
}

function insert_categories()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field cannot be empty!";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('Query Failed' . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $select_catagories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_catagories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>
                <td>$cat_id</td>
                <td>$cat_title</td>
                <td><a href='categories.php?delete=$cat_id'>Delete</a></td>
                <td>
                    <a href='categories.php?edit=$cat_id'>Edit</a>
                </td>
            </tr>";
    }
}

function delete_category()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $cat_id_delete = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id =  $cat_id_delete ";

        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function delete_post()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $post_id_delete = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = $post_id_delete ";

        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");
    }
}

function recordCount($table)
{
    global $connection;

    $query = "SELECT * FROM " . $table;
    $select_all_post = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_post);

    confirm($result);

    return $result;
}
