<?php 
    include('database.php')
    class M_data extends database{
        public function getUser(){
            $sql = "SELECT * FROM user";
            $this->setQuery($sql);
            return $this->loadAllRows();
    
        }
    }

?>