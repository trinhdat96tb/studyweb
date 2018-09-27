<?php 

    require_once('model/m_data.php');

    class C_data{
        public function index(){
            $m_data = new M_data();
            $user = $m_data->getUser();
            return $user;
        }

        public function insertUser(){
            $m_data = new M_data();
            $result = $m_data->insertUser();
            return $result;
        }

        public function deleteUser(){
            $m_data = new M_data();
            $result = $m_data->deleteUser();
            return $result;
        }

        public function updateUser(){
            $m_data = new M_data();
            $result = $m_data->updateUser();
            return $result;
        }

    }

?>