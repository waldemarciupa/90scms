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
            $post_content = $row['post_content'];
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
                                        <td>$post_content</td>
                                        <td>$post_date</td>
                                        <td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>
                                        <td><a href='posts.php?delete=$post_id'>Delete</a></td>
                                    </tr>";
        }

        ?>

    </tbody>
</table>


<?php delete_post(); ?>