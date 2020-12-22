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

                    $per_page = 2;

                    if(isset($_GET['count'])){
                        $pages = $_GET['count'];
                    } else {
                        $pages = '';
                    }

                    if($pages == '' || $pages == 1){
                        
                        $page_1 = 0;
                    } else {
                        $page_1 = ($pages * $per_page) - $per_page;
                    }

                    $quary_count = "SELECT * FROM posts WHERE post_status = 'publish'";
                    $result_post_count = mysqli_query($conn, $quary_count);
                    $count_posts = mysqli_num_rows($result_post_count);
                    $count_posts = ceil($count_posts/$per_page);

                    $quary = "SELECT * FROM posts WHERE post_status = 'publish' LIMIT {$page_1}, {$per_page}";
                    $result_posts = mysqli_query($conn, $quary);

                    while($row = mysqli_fetch_assoc($result_posts)){
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $row['post_id'] ?>"><?php echo $row['post_title'] ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $row['post_author'] ?>&p_id=<?php echo $row['post_id'] ?>"><?php echo $row['post_author'] ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['post_date'] ?></p>
                <hr>
                
                <a href="post.php?p_id=<?php echo $row['post_id'] ?>">
                    <img class="img-responsive" src="images/<?php echo $row['post_image'] ?>" alt="">
                </a>
                <hr>
                <p><?php echo $row['post_content'] ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['post_id'] ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php }?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/Sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pagination">
        <?php 
            for($i=1; $i<= $count_posts; $i++){

                if($i == $pages){
                    echo "<li class='page-item'><a class='activePage' href='index.php?count={$i}'>{$i}</a></li>";
                } else {

                    echo "<li class='page-item'><a href='index.php?count={$i}'>{$i}</a></li>";
            }
            }
        ?>
        </ul>               
        

<?php
    include "includes/footer.php";
?>