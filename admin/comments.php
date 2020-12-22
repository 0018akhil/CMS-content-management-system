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

                <?php

                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch($source){

                        case 'addposts';
                        include "includes/add_posts.php";
                        break;

                        case 'editposts';
                        include "includes/edit_posts.php";
                        break;

                        default:
                        include "includes/view_all_comments.php";
                        break;
                    }

                ?>

                </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"?>