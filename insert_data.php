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

    /* Get data from Client side using $_POST array */

    $user = $_POST['user'];
    $email = $_POST['email'];

    /* validate whether user has entered all values. */

    if(!$user || !$email){
        $result = 2;
    }elseif (!strpos($email, "@") || !strpos($email, ".")) {
        $result = 3;
    }else {
        $sql = "INSERT INTO user (user, gmail, action1) VALUES ('$user', '$email', '')";
            if ($conn->query($sql) === TRUE) {
                $result = 1; 
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
    echo $result;

    // $sql_delete = "DELETE FROM user Where user = '$user'";
    $conn->close();
?>