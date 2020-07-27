<?php include "db.php"; ?>

<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("Query failed" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
    }

    if ($username !== $db_username && $password !== $db_user_password) {
        header("Location: ../index.php");
    } elseif ($username == $db_username && $password == $db_user_password) {
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}

?>
