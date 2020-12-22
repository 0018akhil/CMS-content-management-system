<?php include "./db.php";
session_start();

?>
<?php
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $quary = "SELECT * from users WHERE username = '{$username}' ";

    $select_user_quary = mysqli_query($conn, $quary);

    if (!$select_user_quary) {
        die("quary failed" . mysqli_error($select_user_quary));
    }
    ;

    while ($row = mysqli_fetch_assoc($select_user_quary)) {

        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];

        $verify = password_verify($password, $db_password);

        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

    if ($username !== $db_username) {

        header("location: ../index.php");
    } else{

        if($verify){

            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['role'] = $db_user_role;
            
            header("location: ../admin");


        } else {
            header("location: ../index.php");
        }

    }
}
?>