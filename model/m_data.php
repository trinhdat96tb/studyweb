<?php 
    require_once('database.php');
    class M_data extends database{

        public function getUser(){
            $conn = $this->connect();
            $sql = "SELECT * FROM user";
            $result= $conn->query($sql);
            $users = array();
            if($result->num_rows >0){
                while($user = mysqli_fetch_assoc($result)){
                    $users[] = $user;
                }
            }
            return $users;
        }

        public function insertUser($add){
            $conn = $this->connect();
            $user = $add['user'];
            $email = $add['gmail'];
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
            return $result;
        }

        public function deleteUser(){
            $conn = $this->connect();
            $id = $_POST['id'];
            mysqli_query($conn,"DELETE FROM user Where id = '$id'");
            return $result=1;
        }

        public function updateUser(){
            $user = $_POST['user'];
            $email = $_POST['email'];
            $id = $_POST['id'];
            if(!$user || !$email ||!$id){
                $result = 2;
            }elseif (!strpos($email, "@") || !strpos($email, ".")) {
                $result = 3;
            }else {
                $sql = "UPDATE user SET user='$user', gmail='$email' where id = '$id'";
                    if ($conn->query($sql) === TRUE) {
                        $result = 1; 
                    }else{
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }
            return $result;
        }

    }

?>