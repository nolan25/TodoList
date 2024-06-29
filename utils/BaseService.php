<?php

    interface  BaseService{
    
        function fetchAll();

        public function fetch($id);
    
        public function insert($entity);     
    
        public function update($entity, $id);
            
        public function delete($id);     

    }

?>