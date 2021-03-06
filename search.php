<?php
    include "includes/header.php";
?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    $search = $_POST['search'];

                    $search = mysqli_real_escape_string($conn, trim($search));

                    $search_quary = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";

                    $search_posts = mysqli_query($conn, $search_quary);

                    $count = mysqli_num_rows($search_posts);

                    if($count == 0){

                        echo "<h1>No Posts</h1>";
                    } else {

                    while($row = mysqli_fetch_assoc($search_posts)){
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $row['post_title'] ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['post_author'] ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['post_date'] ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row['post_image'] ?>.jpg" alt="">
                <hr>
                <p><?php echo $row['post_content'] ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php } 
                    }
                ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/Sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php
    include "includes/footer.php";
?>