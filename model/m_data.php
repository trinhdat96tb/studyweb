<?php 
    include('database.php');
    class M_data extends database{
        public function getUser(){
            $sql = "SELECT * FROM user";
            $this->setQuery($sql);
            return $this->loadAllRows();
    
        }

        public function insertUser(){
            $user = $_POST['user'];
            $email = $_POST['email'];
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
        }

        public function deleteUser(){
            $id = $_POST['id'];
            mysqli_query($conn,"DELETE FROM user Where id = '$id'");
            echo $result=1;
        }

        public function updateUser(){
            $user = $_POST['user'];
            $email = $_POST['email'];
            $id = $_POST['id'];
            mysqli_query($conn,"UPDATE user SET user='$user', gmail='$email' where id = '$id'");
            echo $result = 1;
        }
    }

?>