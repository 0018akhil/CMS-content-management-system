<table class= "table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Admin</th>
                                <th>Subscriber</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $comment_quary = "SELECT * FROM users";
                            $comment_results = mysqli_query($conn, $comment_quary);

                            while($row = mysqli_fetch_assoc($comment_results)){

                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_role = $row['user_role'];
                                $user_image = $row['user_image'];
                            ?>
                        
                            <tr>
                                <td><?php echo $user_id  ?></td>
                                <td><?php echo $username ?></td>
                                <td><?php echo $user_firstname ?></td>
                                <td><?php echo $user_lastname ?></td>
                                <td><img width=50 src="../imagesUser/<?php echo $user_image ?>" alt="<?php echo $username ?>"></td>
                                <td><?php echo $user_email ?></td>
                                <td><?php echo $user_role ?></td>
                                <td><a href="users.php?change_to_admin=<?php echo $user_id ?>">Admin</a></td>
                                <td><a href="users.php?change_to_sub=<?php echo $user_id ?>">Subscriber</a></td>
                                <td><a href="users.php?source=edituser&u_id=<?php echo $user_id ?>">Edit</a></td>
                                <td><a onClick="javascript: return confirm('Are you sure, do you want to delete?');" href="users.php?delete_user=<?php echo $user_id ?>">Delete</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php 

                                if(isset($_GET['delete_user'])){
                                    $delete = $_GET['delete_user'];
                                    $user_quary_delete = "DELETE FROM users WHERE user_id = {$delete}";
                                    
                                    $delete_quary = mysqli_query($conn, $user_quary_delete);

                                    header("location: users.php");
                                }

                                if(isset($_GET['change_to_sub'])){

                                    $update = $_GET['change_to_sub'];
                                    $user_quary_update = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$update}";
                                    
                                    $update_result = mysqli_query($conn, $user_quary_update);

                                    header("location: users.php");
                                }

                                if(isset($_GET['change_to_admin'])){

                                    $update = $_GET['change_to_admin'];
                                    $user_quary_update = "UPDATE users SET user_role = 'admin' WHERE user_id = {$update}";
                                    
                                    $update_result = mysqli_query($conn, $user_quary_update);

                                    header("location: users.php");
                                }
                    ?>