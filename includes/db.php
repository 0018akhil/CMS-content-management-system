<?php

define("db_name", "localhost");
define("db_user", "root");
define("db_password", "");
define("db_base", "cms");

$conn = mysqli_connect(db_name, db_user, db_password, db_base);

if(!$conn){
    die("No connection to db" . mysqli_error($conn));
}

?>