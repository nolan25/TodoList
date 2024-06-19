<?php
require_once(ROOT . "/dao/TodoDao.php");

class TodoService  {
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
}
?>