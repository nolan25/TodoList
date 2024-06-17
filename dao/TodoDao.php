<?php

require_once(ROOT . '/utils/AbstractDao.php');
require_once(ROOT . '/utils/BaseDao.php');
require_once(ROOT . '/utils/DbSingleton.php');
require_once(ROOT . '/model/Todo.php');

class TodoDao extends AbstractDao implements BaseDao {

    private $todoDao;

    function __construct() {
    }

    function fetchAll(){
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "SELECT * FROM todos;";
        $sth = $pdo->query($sql);
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        $todos = array();
        foreach($result as $row){
            $todo = new Todo();
            $todo->setId(intval($row->id));
            $todo->setTitle($row->title);
            $todo->setDescription($row->description);
            array_push($todos, $todo);
        }
        return $todos;
    }

    function fetch($id){
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "SELECT * FROM todos WHERE id = :id";
        $sth = $pdo->prepare($sql);
        $sth->execute([':id' => $id]);
        $row = $sth->fetch(PDO::FETCH_OBJ);
        if ($row) {
            $todo = new Todo();
            $todo->setId(intval($row->id));
            $todo->setTitle($row->title);
            $todo->setDescription($row->description);
            return $todo;
        }
        return null;
    }

    function insert($entity){
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "INSERT INTO todos (title, description) VALUES (:title, :description)";
        $sth = $pdo->prepare($sql);
        $sth->execute([
            ':title' => $entity->getTitle(),
            ':description' => $entity->getDescription()
        ]);
    }

    function update($entity){
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "UPDATE todos SET title = :title, description = :description WHERE id = :id";
        $sth = $pdo->prepare($sql);
        $sth->execute([
            ':id' => $entity->getId(),
            ':title' => $entity->getTitle(),
            ':description' => $entity->getDescription()
        ]);
    }

    function delete($id){
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "DELETE FROM todos WHERE id = :id";
        $sth = $pdo->prepare($sql);
        $sth->execute([':id' => $id]);
    }
}

?>
