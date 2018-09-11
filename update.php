<?php
    $host         = "localhost";
    $username     = "root";
    $password     = "";
    $dbname       = "user";
    $conn = mysqli_connect($host, $username, $password, $dbname);
    

    $user = $_POST['user'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    mysqli_query($conn,"UPDATE user SET user='$user', gmail='$email' where id = '$id'");
    echo $result = 1;
?>