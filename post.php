<?php session_start(); ?>
<?php include "includes/db.php"?>
<?php include "admin/functions.php"?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                    $quary = "SELECT * FROM categories";

                    $result = mysqli_query($conn, $quary);

                    while($row = mysqli_fetch_assoc($result)){
                ?>
                    <li>
                        <a href="#"><?php echo $row['cat_title'] ?></a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="admin">Admin</a>
                    </li>

                    <?php 
                            if(isset($_SESSION['role'])){
                                if(isset($_GET['p_id'])){
                        
                                    echo "<li><a href='./admin/posts.php?source=editposts&p_id={$_GET['p_id']}'>Edit Post</a></li>";
                                }
                            }
                    ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <?php
if (isset($_GET['p_id'])) {

    $p_id = $_GET['p_id'];

    $view_quary = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$p_id}";
    $result_quary = mysqli_query($conn, $view_quary);


    $edit_post_quary = "SELECT * FROM posts WHERE post_id = {$p_id}";

    $edit_post_result = mysqli_query($conn, $edit_post_quary);

    while ($post_row = mysqli_fetch_assoc($edit_post_result)) {

        $post_title = $post_row['post_title'];
        $post_author = $post_row['post_author'];
        $post_date = $post_row['post_date'];
        $post_image = $post_row['post_image'];
        $post_content = $post_row['post_content'];

    }
} else {
    header("location: index.php");
}
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $post_author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content ?></p>

                <hr>

                <?php
if (isset($_POST['create_comment'])) {

    $comment_post_id = $_GET['p_id'];

    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    
    $comment_author = mysqli_real_escape_string($conn, $comment_author);
    $comment_email = mysqli_real_escape_string($conn, $comment_email);
    $comment_email = mysqli_real_escape_string($conn, $comment_email);


    $comment_quary = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
    $comment_quary .= "VALUES ($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

    $comment_result = mysqli_query($conn, $comment_quary);

    confirmquary($comment_result);

}
;
?>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input type="text" class="form-control" name="comment_author" required>
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email" required>
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                    $comment_post_id = $_GET['p_id'];
                    $comment_quary = "SELECT * FROM comments WHERE comment_post_id = {$comment_post_id} ";
                    $comment_quary .= "AND comment_status = 'approved' ";
                    $comment_quary .= "ORDER BY comment_id DESC";

                    $comment_result = mysqli_query($conn, $comment_quary);

                    while ($row = mysqli_fetch_assoc($comment_result)) {
                        $author_comment = $row['comment_author'];
                        $content_comment = $row['comment_content'];
                        $date_comment = $row['comment_date'];
                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $author_comment ?>
                            <small><?php echo $date_comment ?></small>
                        </h4>
                        <?php echo $content_comment ?>
                    </div>
                </div>

                <?php }
?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
