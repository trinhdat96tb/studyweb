<html> 
	<head>
		<style></style>
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
        <div class ="container">
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbName = "user";

                // Create connection
                $conn = mysqli_connect($servername, $username, $password,$dbName);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            ?>
            <div>
                <br>
                <form method="post" action = "insert.php">
                    <div class = "row">
                        <div class="col-sm-4">
                            <label>User :</label>
                            <input type = "text" name = "user" style="margin-left:9px">
                            <span class="error"> 
                                <?php 
                                    if (empty($_POST["user"])) {
                                        $userErr = "User is required";
                                        echo $userErr;
                                    } else {
                                        $user = $_POST["user"];
                                    }
                                ?>
                            </span>
                            <br><br>
                            <label>Email :</label>
                            <input type = "text" name = "email1">
                            <span class="error"> 
                                <?php 
                                    if (empty($_POST["email1"])) {
                                        $emailErr = "Email is required";
                                        echo $emailErr;
                                    } else {
                                        $email = $_POST["email1"];
                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            $emailErr = "Invalid email format"; 
                                        }else{
                                            $sql = "INSERT INTO user (user, gmail, action1)
                                            VALUES ('$user', '$email', '0')";
                
                                            if ($conn->query($sql) === TRUE) {
                                                header("Refresh:0");
                                            } else {
                                                echo "Error: " . $sql . "<br>" . $conn->error;
                                            }
                                        }
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="col-sm-8">
                            <input type= "submit" name="submit" value="Submit">
                            <br><br>
                        </div>
                    </div>
                
                </form>
            </div>
            <?php
                $sql2 = "SELECT user, gmail, action1 FROM user";
                $result = $conn->query($sql2);
                    // echo "<pre>";
                    // print_r($result->fetch_assoc());
                    // echo "</pre>";
            ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style=width:150px> Name </th>
                            <th style=width:150px> Email </th>
                            <th style=width:150px> Action </th>
                        </tr>
                    </thead>
                    <?php
                        if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                //echo "<br> : ". $row["user"]. " - Email: ". $row["gmail"]. " " . $row["action1"] . "<br>";
                    ?>
                    <tbody>
                        <tr>
                            <td style=width:150px> <?php echo $row["user"]; ?> </td>
                            <td style=width:150px> <?php echo $row["gmail"]; ?> </td>
                            <td style=width:150px> 
                                <?php echo $row["user"]; ?> 
                                <a class="close">&times;
                                    
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    <?php       
                            }
                        }
                    ?>
                </table>
                <br><br>
            <?php $conn->close(); ?>
        
        </div>
	</body>
</html>