<html> 
	<head>
		<style></style>
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#btn_insert").click(function(){
                    var input_user = $("#input_user").val();
                    var input_email = $("#input_email").val();
                    if(input_user == "" || input_email== ""){
                        alert("User or Email is empty");
                    }else{
                        $('#myTable').append('<tr><td>'+input_user+'</td><td>'+input_email+'</td><td>'+0+'</td>');
                        alert("Insert success");
                    }

                         
                        // $user = $_POST["user"];
                        // $email = $_POST["email1"];
                        // if($user == "" && $email == ""){
                        //     alert("User and email are empty");
                        // }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        //         alert("Invalid email format"); 
                        // }else{
                        //     $sql = "INSERT INTO user (user, gmail, action1)
                        //     VALUES ('$user', '$email', 0)";
                        //     if ($conn->query($sql) === TRUE) {
                        //     }else{
                        //         echo "Error: " . $sql . "<br>" . $conn->error;
                        //     }
                        // }
                         
                });
            });
        </script>
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
                    <div>
                        <div>
                            <div class="form-group">
                                <label for="user">User:</label>
                                <input type="text" name = "user" class = "form-control" id="input_user">
                            </div> 
                            <div class="form-group">
                                <label for="pwd">Email:</label>
                                <input type="text" name = "email1" class="form-control" id="input_email">
                            </div>
                        </div>
                        <div>
                            <button type="button" id ="btn_insert" class="btn btn-success" value ="click">Insert</button>
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
                <table class="table table-bordered" id ="myTable">
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
                            <td style=width:150px> <?php echo $row["action1"]; ?> </td>
                        </tr>
                    </tbody>
                    <?php       
                            }
                        }
                    ?>
                </table>
            <?php $conn->close(); ?>
        </div>
	</body>
</html>