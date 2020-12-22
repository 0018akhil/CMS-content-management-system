<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <div class="input-group">
    <form action="search.php" method="post">
        <input type="text" class="form-control" name="search">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </form>
    </div>
    <!-- /.input-group -->
</div>

<!-- Login form -->
<div class="well">
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password">
        </div>
        <div class="form-group">
            <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
            </span>
        </div>
    </form>
</div>



<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <!-- /.col-lg-6 -->
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php
                $quary = "SELECT * FROM categories";

                $sidebar_category = mysqli_query($conn, $quary);

                while($row = mysqli_fetch_assoc($sidebar_category)){

            ?>
                <li><a href="category.php?category=<?php echo $row['cat_id'] ?>"><?php echo $row['cat_title'] ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "includes/widget.php" ?>

</div>
