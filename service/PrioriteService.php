<?php

require_once(ROOT . '/utils/AbstractService.php');
require_once(ROOT . '/utils/BaseService.php');
require_once(ROOT . '/dao/PrioriteDao.php');

class PrioriteService extends AbstractService implements BaseService{
    private $prioriteDao;

    function __construct(){
        $this->prioriteDao = new StatutDao();
    }

    function fetchAll(){
        $list = $this->prioriteDao->fetchAll();
        return $list;
    }

    public function fetch($id){

    }

    public function insert($entity){
        
    }

    public function update($entity){
        
    }
    
    public function delete($id){
        
    }

}

?>