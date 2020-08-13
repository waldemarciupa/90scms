<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Comments
                        <small>Author</small>
                    </h1>

                    <?php

                    if (isset($_POST['checkBoxArray'])) {

                        foreach ($_POST['checkBoxArray'] as $post_id) {
                            $bulk_options = $_POST['bulk_options'];

                            switch ($bulk_options) {
                                case 'published':
                                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $post_id ";
                                    $update_to_publish_status = mysqli_query($connection, $query);
                                    confirm($update_to_publish_status);
                                    break;
                                case 'draft':
                                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $post_id ";
                                    $update_to_draft_status = mysqli_query($connection, $query);
                                    confirm($update_to_draft_status);
                                    break;
                                case 'delete':
                                    $query = "DELETE FROM posts WHERE post_id = $post_id ";
                                    $update_to_delete_status = mysqli_query($connection, $query);
                                    confirm($update_to_delete_status);
                                    break;

                                case 'clone':
                                    $query = "SELECT * FROM posts WHERE post_id = '{$post_id}' ";
                                    $select_post_query = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_array($select_post_query)) {
                                        $post_title = $row['post_title'];
                                        $post_category_id = $row['post_category_id'];
                                        $post_date = $row['post_date'];
                                        $post_author = $row['post_author'];
                                        $post_status = $row['post_status'];
                                        $post_image = $row['post_image'];
                                        $post_tags = $row['post_tags'];
                                        $post_content = $row['post_content'];
                                        $post_comment_count = $row['post_comment_count'];
                                    }

                                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_content, post_tags, post_status, post_comment_count) ";
                                    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                                    $copy_query = mysqli_query($connection, $query);
                                    confirm($copy_query);
                                    break;
                            }
                        }
                    }

                    ?>


                    <form action="" method="post">

                        <table class="table table-hover">

                            <div id="bulkOptionsContainer" class="col-xs-4">
                                <select class="form-control" name="bulk_options" id="">
                                    <option value="">Select Options</option>
                                    <option value="published">Publish</option>
                                    <option value="draft">Draft</option>
                                    <option value="delete">Delete</option>
                                    <option value="clone">Clone</option>
                                </select>
                            </div>

                            <div class="col-xs-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                <a class="btn btn-primary" href="posts.php?source=add_post">Add new</a>
                            </div>

                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>View Post</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . "";
                                $select_posts = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($select_posts)) {
                                    $post_id = $row['post_id'];
                                    $post_author = $row['post_author'];
                                    $post_title = $row['post_title'];
                                    $post_category_id = $row['post_category_id'];
                                    $post_status = $row['post_status'];
                                    $post_image = $row['post_image'];
                                    $post_tags = $row['post_tags'];
                                    $post_comment_count = $row['post_comment_count'];
                                    $post_content = $row['post_content'];
                                    $post_date = $row['post_date'];

                                    echo "<tr>";
                                ?>
                                    <th><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></th>
                                <?php
                                    echo "<td>$post_id</td>";
                                    echo "<td>$post_author</td>";
                                    echo "<td>$post_title</td>";

                                    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                                    $select_catagories_to_edit = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_assoc($select_catagories_to_edit)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];

                                        echo "<td>{$cat_title}</td>";
                                    }

                                    echo "<td>$post_status</td>";
                                    echo "<td><img width='150' src='../images/{$post_image}'/></td>";
                                    echo "<td>$post_tags</td>";

                                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                                    $send_comment_query = mysqli_query($connection, $query);

                                    $row = mysqli_fetch_array($send_comment_query);
                                    $comment_id = $row['comment_id'];
                                    $count_comments = mysqli_num_rows($send_comment_query);


                                    echo "<td><a href='comment.php?id=$comment_id'>$count_comments</a></td>";

                                    echo "<td>$post_date</td>";
                                    echo "<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";
                                    echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
                                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete=$post_id'>Delete</a></td>";
                                    echo "</tr>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </form>

                    <?php delete_post(); ?>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>