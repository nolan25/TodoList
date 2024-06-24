<?php
    require_once(ROOT . "/dao/TodoDao.php");
    require_once(ROOT."/utils/AbstractService.php");
    require_once(ROOT."/utils/BaseService.php");

    class TodoService extends AbstractService implements BaseService  {
        private $tododao;

        function __construct() {
            $this->tododao = new TodoDao();
        }

        public function fetchAll() {
            $list = $this->tododao->fetchAll();
                return $list;
        }

        public function fetch($id) {
            return $this->tododao->fetch($id);
        }
        public function insert($todo){
            return $this->tododao->insert($todo);
        }

        public function update($entity){
            return;
            
        }
        
        public function delete($id){
            return;
        }
    }
?>