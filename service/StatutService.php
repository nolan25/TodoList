<?php

require_once(ROOT . '/utils/AbstractService.php');
require_once(ROOT . '/utils/BaseService.php');
require_once(ROOT . '/dao/StatutDao.php');

class StatutService extends AbstractService implements BaseService{
    private $statutDao;

    function __construct(){
        $this->statutDao = new StatutDao();
    }

    function fetchAll(){
        $list = $this->statutDao->fetchAll();
        return $list;
    }

    public function fetch($id){
        return $this->statutDao->fetch($id);
    }

    public function insert($entity){
        
    }

    public function update($entity){
        
    }
    
    public function delete($id){
        
    }


}

?>