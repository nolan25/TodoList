<?php
require_once(ROOT . "/utils/AbstractDao.php");
require_once(ROOT . "/utils/BaseDao.php");
require_once(ROOT . "/utils/DbSingleton.php");
require_once(ROOT . "/model/Todo.php");

class TodoDao extends AbstractDao implements BaseDao {
    function __construct() {}

    function fetchAll() {
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "SELECT * FROM Todo;";
        $sth = $pdo->query($sql);
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        $todos = array();
        foreach($result as $row) {
            $todo = new Todo();
            $todo->setId($row->Id_Todo);
            $todo->setTitre($row->Titre);
            $todo->setDescription($row->Description);
            $todo->setDateCreation($row->Date_Creation);
            $todo->setDateModif($row->Date_modif);
            $todo->setResModifi($row->ResModifi);
            $todo->setEcheance($row->Echeance);
            $todo->setIdStatut($row->Id_Statut);
            $todo->setIdPriorite($row->Id_Priorite);
            $todo->setIdUsers($row->Id_Users);
            array_push($todos, $todo);
        }
        return $todos;
    }

    function fetch($id) {
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "SELECT * FROM Todo WHERE Id_Todo = ?;";
        $sth = $pdo->prepare($sql);
        $sth->execute([$id]);
        $row = $sth->fetch(PDO::FETCH_OBJ);
        if ($row) {
            $todo = new Todo();
            $todo->setId($row->Id_Todo);
            $todo->setTitre($row->Titre);
            $todo->setDescription($row->Description);
            $todo->setDateCreation($row->Date_Creation);
            $todo->setDateModif($row->Date_modif);
            $todo->setResModifi($row->ResModifi);
            $todo->setEcheance($row->Echeance);
            $todo->setIdStatut($row->Id_Statut);
            $todo->setIdPriorite($row->Id_Priorite);
            $todo->setIdUsers($row->Id_Users);
            return $todo;
        } else {
            return null;
        }
    }

    function insert($entity) {
        // Code pour insérer un nouveau Todo
    }

    function update($entity) {
        // Code pour mettre à jour un Todo existant
    }

    function delete($id) {
        // Code pour supprimer un Todo
    }
}
?>
