<table class= "table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(isset($_GET['post_id'])){
                                $specific_comment_id = $_GET['post_id'];
                                $comment_quary = "SELECT * FROM comments WHERE comment_post_id = {$specific_comment_id}";
                            } else {
                                $comment_quary = "SELECT * FROM comments";
                            }
                            
                            $comment_results = mysqli_query($conn, $comment_quary);

                            while($row = mysqli_fetch_assoc($comment_results)){

                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_author = $row['comment_author'];
                                $comment_email = $row['comment_email'];
                                $comment_content = $row['comment_content'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];
                            ?>
                        
                            <tr>
                                <td><?php echo $comment_id ?></td>
                                <td><?php echo $comment_author ?></td>
                                <td><?php echo $comment_content ?></td>
                                <td><?php echo $comment_email ?></td>
                                <td><?php echo $comment_status ?></td>

                                <?php
                                    $comment_quary = "SELECT * FROM posts WHERE post_id = $comment_post_id";

                                    $select_comment = mysqli_query($conn, $comment_quary);

                                    while($row = mysqli_fetch_assoc($select_comment)){
                                        $fetched_comment_id = $row['post_id'];
                                        $fetched_comment_title = $row['post_title'];

                                        echo "<td><a href='../post.php?p_id=$fetched_comment_id'>$fetched_comment_title</a></td>";
                                    }
                                ?>


                                <td><?php echo $comment_date ?></td>
                                <td><a href="comments.php?approve=<?php echo $comment_id ?>"">Approve</a></td>
                                <td><a href="comments.php?unapprove=<?php echo $comment_id ?>">Unapprove</a></td>
                                <td><a href="comments.php?delete=<?php echo $comment_id ?>">Delete</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php 

                                if(isset($_GET['delete'])){
                                    $delete = $_GET['delete'];
                                    $post_quary_delete = "DELETE FROM comments WHERE comment_id = {$delete}";
                                    
                                    $delete_quary = mysqli_query($conn, $post_quary_delete);

                                    header("location: comments.php");
                                }

                                if(isset($_GET['unapprove'])){

                                    $update = $_GET['unapprove'];
                                    $post_quary_update = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$update}";
                                    
                                    $delete_quary = mysqli_query($conn, $post_quary_update);

                                    header("location: comments.php");
                                }

                                if(isset($_GET['approve'])){

                                    $update = $_GET['approve'];
                                    $post_quary_update = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$update}";
                                    
                                    $delete_quary = mysqli_query($conn, $post_quary_update);

                                    header("location: comments.php");
                                }
                    ?>