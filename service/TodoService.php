<?php
require_once(ROOT . "/dao/TodoDao.php");
require_once(ROOT . "/utils/AbstractService.php");
require_once(ROOT . "/utils/BaseService.php");

class ToDoService extends AbstractService implements BaseService
{
    private $todoDao;

    function __construct()
    {
        //on n'utilise que les méthodes de l'interface
        $this->todoDao = new ToDoDao();

    }

    function fetchAll()
    {
        $list = $this->todoDao->fetchAll();
        return $list;

    }
    public function fetch($id)
    {
        return $this->todoDao->fetch($id);
    }

    public function insert($entity)
    {
        return $this->todoDao->insert($entity);
    }

    public function update($entity, $id)
    {
        return $this->todoDao->update($entity, $id);
    }

    public function delete($id)
    {
        return $this->todoDao->delete($id);
    }
}

?>