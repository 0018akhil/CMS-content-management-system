<?php include "../admin/functions.php"?>
<?php ob_start();?>
<?php include "../includes/db.php"?>
<?php include "includes/admin_header.php"?>

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
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">

                    <?php if (isset($_POST['submit'])) {
                        submit_data();
                    }?>

                    <?php if (isset($_POST['edit_submit'])) {
                        $edit_title = $_POST['update_cat_title'];
                        $edit_identity = $_GET['editcat'];
                        if ($edit_title == "" || empty($edit_title)) {
                            echo "Need something to update";
                        } else {
                            $edit_quary = "UPDATE categories SET cat_title = '{$edit_title}'";
                            $edit_quary .= " WHERE cat_id = '{$edit_identity}'";

                            $category_insert = mysqli_query($conn, $edit_quary);
                            header("location: categories.php");
                        }
                    }?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Categories</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php

                        if (isset($_GET['editcat'])) {
                            $edit_id = $_GET['editcat'];
                            $edit_quary = "SELECT * FROM categories WHERE cat_id = {$edit_id}";

                            $edit_result = mysqli_query($conn, $edit_quary);

                        while ($edit_row = mysqli_fetch_assoc($edit_result)) {

                        ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="update_cat_title">Update Categories</label>
                                <input type="text" class="form-control" name="update_cat_title" value= <?php echo $edit_row['cat_title']; ?>>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_submit" value="Update Category">
                            </div>
                        </form>
                        <?php }
                            }?>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php //FIND ALL CATEGORIES
                                $quary = "SELECT * FROM categories";

                                $table_category = mysqli_query($conn, $quary);

                                while ($row = mysqli_fetch_assoc($table_category)) {

                            ?>
                                <tr>
                                    <td><?php echo $row['cat_id']; ?></td>
                                    <td><?php echo $row['cat_title']; ?></td>
                                    <td><a href="categories.php?delete=<?php echo $row['cat_id']; ?>">Delete</a></td>
                                    <td><a href="categories.php?editcat=<?php echo $row['cat_id']; ?>">Edit</a></td>
                                </tr>
                            <?php }?>
                            </tbody>

                            <?php delete_categories() ?>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>