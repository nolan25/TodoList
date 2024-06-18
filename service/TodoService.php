<?php
require_once(ROOT . "/dao/TodoDao.php");

class TodoService {
    private $dao;

    function __construct() {
        $this->dao = new TodoDao();
    }

    public function fetchAll() {
        return $this->dao->fetchAll();
    }

    public function fetch($id) {
        return $this->dao->fetch($id);
    }
}
?>