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
                        Welcome to Admin
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <div class='huge'><?php echo $posts_counts = recordCount('posts'); ?></div>

                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="./posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <div class='huge'><?php echo $comments_counts = recordCount('comments'); ?></div>

                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="./comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <div class='huge'><?php echo $users_counts = recordCount('users'); ?></div>

                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="./users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                <div class='huge'><?php echo $categories_counts = recordCount('categories'); ?></div>

                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="./categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <?php

        $query = "SELECT * FROM posts WHERE post_status = 'published'";
        $select_all_published_post = mysqli_query($connection, $query);
        $posts_published_count = mysqli_num_rows($select_all_published_post);

        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
        $select_all_draft_post = mysqli_query($connection, $query);
        $posts_draft_count = mysqli_num_rows($select_all_draft_post);

        $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
        $unapproved_comments_query = mysqli_query($connection, $query);
        $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);

        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
        $select_all_subscribers = mysqli_query($connection, $query);
        $subscriber_count = mysqli_num_rows($select_all_subscribers);

        ?>

        <div style="display: flex; justify-content: center; align-items: center;" class="row">
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Date', 'Count'],

                        <?php

                        $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                        $element_count = [$posts_counts, $posts_published_count, $posts_draft_count, $comments_counts, $unapproved_comment_count, $users_counts, $subscriber_count, $categories_counts];

                        for ($i = 0; $i < 7; $i++) {
                            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                        }

                        ?>

                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>

            <div id="columnchart_material" style="width: 90%;  height: 300px;"></div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>