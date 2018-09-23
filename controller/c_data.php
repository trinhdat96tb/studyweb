<?php 

    include('model/m_data.php');
    class C_data{
        public function index(){
            $m_data = new M_data();
            $user = $m_data->getUser();
            return array('user'=>$user);
        }

    }

?>