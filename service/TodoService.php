<?php
require_once(ROOT . "/dao/TodoDao.php");

class TodoService extends AbstractService implements BaseService  {
    private $tododao;

    function __construct() {
        $this->tododao = new TodoDao();
    }

    public function fetchAll() {
        return $this->tododao->fetchAll();
    }

    public function fetch($id) {
        return $this->tododao->fetch($id);
    }
    public function insert($entity){
        
    }

    public function update($entity){
        
    }
    
    public function delete($id){
        
    }
}
?>