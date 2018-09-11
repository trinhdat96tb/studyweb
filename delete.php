<?php
    $host         = "localhost";
    $username     = "root";
    $password     = "";
    $dbname       = "user";

    /* Create connection */
    $conn = mysqli_connect($host, $username, $password, $dbname);


    /* Check connection */
    if ($conn->connect_error) {
        die("Connection to database failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    mysqli_query($conn,"DELETE FROM user Where id = '$id'");
    echo $result=1;
?>