<html> 
	<head>
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function(){
                // insert database
                $("#btn_insert").on('click', function(){ 
                    var input_user = $("#input_user").val();
                    var input_email = $("#input_email").val();
                    
                    $.ajax({ 
                        method: "POST",
                        url: "insert_data.php",
                        data: {"user": input_user, "email": input_email, "action1":''},
                    }).done(function( data ) { 
                        var result = $.parseJSON(data);
                        var str = '';
                        if(result == 1) {
                            $('#myTable').append('<tr><td>'+input_user+'</td><td>'+input_email+'</td><td><table><tr>'
                                            +'<td style=width:100px><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button></td>'
                                            +'<td style=width:100px><button type="button" class="btn btn-danger"><i class="fa fa-close"></i></button</td>'
                                            +'</tr></table></td></tr>');
                            alert("User record insert successfully.");
                        }else if( result == 2) {
                            alert("All fields are required.");
                        } else{
                            alert("User data could not be saved. Please try again.");
                            document.getElementById("input_email").value = "";
                        }
                    });
                });
            }); 

            // delete database

            $(document).ready(function(){
                $(document).on('click', 'a[data_role=delete]', function(){
                    if(confirm("Do you want to delete?")==true){
                        var id = $(this).data('id');
                        $.ajax({
                            method : 'POST',
                            url : 'delete.php',
                            data: {"id": id}
                        }).done(function(data){
                            var result = $.parseJSON(data);
                            if(result == 1){
                                alert("delete success");
                            }
                            window.location.replace("insert.php");
                        });
                        
                    }   
                });
            });
                
            // edit database
            $(document).ready(function(){
                $(document).on('click', 'a[data_role=update]', function(){
                    var id = $(this).data('id');
                    var user = $('#'+id).children('td[data-target=user]').text();
                    var email = $('#'+id).children('td[data-target=gmail]').text();
                    $('#modal_user').val(user);
                    $('#modal_email').val(email);
                    $('#userId').val(id);
                    $('#modal_update').modal('toggle');
                });
                $('#update').click(function(){
                    var id = $('#userId').val();
                    var user = $('#modal_user').val();
                    var email = $('#modal_email').val();
                    $.ajax({
                        method : 'POST',
                        url : 'update.php',
                        data: {"id": id, "user": user, "email": email},
                    }).done(function( data ) { 
                        var result = $.parseJSON(data);
                        if(result == 1){
                            $('#'+id).children('td[data-target=user]').text(user);
                            $('#'+id).children('td[data-target=gmail]').text(email);
                            alert("update success");
                        }
                    });

                })
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
                                <input type="text" name = "user" class = "form-control" id="input_user" placeholder="Input user" required >
                            </div> 
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name = "email1" class="form-control" id="input_email" placeholder="Input email" required >
                            </div>
                        </div>
                        <div>
                            <button type="button" id ="btn_insert" class="btn btn-success" value ="click">Insert</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
                $sql2 = "SELECT id, user, gmail, action1 FROM user";
                $result = $conn->query($sql2);
                    // echo "<pre>";
                    // print_r($result->fetch_assoc());
                    // echo "</pre>";
            ?>
                <table class="table table-bordered" id ="myTable">
                    <thead>
                        <tr>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <?php
                        if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                //echo "<br> : ". $row["user"]. " - Email: ". $row["gmail"]. " " . $row["action1"] . "<br>";
                    ?>
                    <tbody>
                        <tr id="<?php echo $row['id']?>">
                            <td style=width:33% data-target="user"> <?php echo $row["user"]; ?> </td>
                            <td style=width:33% data-target="gmail"> <?php echo $row["gmail"]; ?> </td>
                            <td style=width:33%>
                                <table>
                                    <tr>
                                        <td style=width:100px>
                                            <a href="#" data-id="<?php echo $row['id'] ?>" data_role="update" type="button" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <!--Modal-->
                                            <div class = "modal fade" id = "modal_update" role = "dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Update database</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="user">User:</label>
                                                                <input type="text" class = "form-control" id="modal_user">
                                                            </div> 
                                                            <div class="form-group">
                                                                <label for="email">Email:</label>
                                                                <input type="text" class="form-control" id="modal_email">
                                                            </div>
                                                                <input type="hidden" id="userId" class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <a href="#" id="update" type="button" class="btn btn-primary" data-dismiss="modal">Submit</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style=width:100px>
                                            <a href="#" data-id="<?php echo $row['id'] ?>" type="button" class="btn btn-danger" data_role="delete"><i class="fa fa-close"></i></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
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