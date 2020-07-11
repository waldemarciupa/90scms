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
                        Posts
                        <small>Author</small>
                    </h1>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $query = "SELECT * FROM posts";
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
                                $post_date = $row['post_date'];

                                echo "<tr>
                                        <td>$post_id</td>
                                        <td>$post_author</td>
                                        <td>$post_title</td>
                                        <td>$post_category_id</td>
                                        <td>$post_status</td>
                                        <td><img width='150' src='../images/{$post_image}'/></td>
                                        <td>$post_tags</td>
                                        <td>$post_comment_count</td>
                                        <td>$post_date</td>
                                    </tr>";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>