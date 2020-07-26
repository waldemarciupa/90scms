<?php

if (isset($_POST['create_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES('{$user_firstname}', '{$user_lastname}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}' ) ";

    $create_user_query = mysqli_query($connection, $query);

    confirm($create_user_query);
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_author">Firtstname</label>
        <input type="text" class="form-control" name="user_firstname" />
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" />
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select option</option>
            <option value="admin">Admin</option>
            <option value="subsriber">Subscriber</option>
        </select>
    </div>

    <!-- 
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image" />
    </div> -->

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username" />
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email" />
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password" />
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>

</form>