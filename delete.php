<?php
    $host         = "localhost";
    $username     = "root";
    $password     = "";
    $dbname       = "user";
    $result = 0;

    /* Create connection */
    $conn = mysqli_connect($host, $username, $password, $dbname);


    /* Check connection */
    if ($conn->connect_error) {
        die("Connection to database failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql_delete = "DELETE FROM user Where id = '".$id."'";
    $result = $mysqli->query($sql_delete);
    echo json_encode([$id]);
?>