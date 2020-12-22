<?php include "../admin/functions.php"?>
<?php ob_start();?>
<?php include "../includes/db.php"?>
<?php include "includes/admin_header.php"?>

<?php

if(isset($_SESSION['role'])){

    if($_SESSION['role'] != 'admin'){
        header("location: ../index.php");
    }

} else {
    header("location: ../index.php");
}



?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>
                </div>
            <!-- /.row -->

            <?php

            $quary = "SELECT * FROM posts WHERE post_status = 'publish'";
            $select_all_publish_posts = mysqli_query($conn, $quary);

            $posts_publish_count = mysqli_num_rows($select_all_publish_posts);

            $quary = "SELECT * FROM posts WHERE post_status = 'draft'";
            $select_all_draft_posts = mysqli_query($conn, $quary);

            $posts_draft_count = mysqli_num_rows($select_all_draft_posts);
            
            $quary = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
            $select_all_uapproved_comments = mysqli_query($conn, $quary);

            $uapproved_comments_count = mysqli_num_rows($select_all_uapproved_comments);
            
            $quary = "SELECT * FROM users WHERE user_role = 'Subscriber'";
            $select_all_subscribers = mysqli_query($conn, $quary);

            $subscriber_count = mysqli_num_rows($select_all_subscribers);
            
            ?>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                <?php 
                                $quary = "SELECT * FROM posts";
                                
                                $select_all_posts = mysqli_query($conn, $quary);

                                $posts_count = mysqli_num_rows($select_all_posts);

                                echo "<div class='huge'>{$posts_count}</div>";

                                ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
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

                                <?php 
                                $quary = "SELECT * FROM comments";
                                
                                $select_all_posts = mysqli_query($conn, $quary);

                                $comments_count = mysqli_num_rows($select_all_posts);

                                echo "<div class='huge'>{$comments_count}</div>";

                                ?>

                                <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
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

                                <?php 
                                $quary = "SELECT * FROM users";
                                
                                $select_all_posts = mysqli_query($conn, $quary);

                                $users_count = mysqli_num_rows($select_all_posts);

                                echo "<div class='huge'>{$users_count}</div>";

                                ?>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
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

                                <?php 
                                $quary = "SELECT * FROM categories";
                                
                                $select_all_posts = mysqli_query($conn, $quary);

                                $categories_count = mysqli_num_rows($select_all_posts);

                                echo "<div class='huge'>{$categories_count}</div>";

                                ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            </div>

            <div class="row">
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],
                
                
                    <?php 
                        $element_text = ['All Posts', 'Published Posts', 'Draft Posts', 'Commets', 'Unapproved comments', 'Users', 'subscribers', 'Categories'];
                        $element_count = [$posts_count, $posts_publish_count, $posts_draft_count, $comments_count, $uapproved_comments_count, $users_count, $subscriber_count, $categories_count];

                        for($i = 0; $i < 8; $i++){
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

            <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>
