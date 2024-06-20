<?php
require_once(ROOT . "/utils/AbstractDao.php");
require_once(ROOT . "/utils/BaseDao.php");
require_once(ROOT . "/utils/DbSingleton.php");
require_once(ROOT . "/model/Todo.php");

class TodoDao extends AbstractDao implements BaseDao {
    function __construct() {}
    function fetchAll() {
        $pdo = DbSingleton::getInstance()->getPdo();
        try {
            $sql = "SELECT * FROM todo;";
            $sth = $pdo->prepare($sql);
            $sth->execute();
            $results = $sth->fetchAll(PDO::FETCH_OBJ);

            $todos = [];
            foreach ($results as $row) {
                $todo = new stdClass();
                $todo->id = intval($row->Id_Todo);
                $todo->titre = $row->Titre;
                $todo->description = $row->Description;
                $todo->date_creation = $row->Date_Creation;
                $todo->date_modif = $row->Date_modif;
                $todo->res_modifi = $row->ResModifi;
                $todo->echeance = $row->Echeance;
                $todo->id_statut = intval($row->Id_Statut);
                $todo->id_priorite = intval($row->Id_Priorite);
                $todo->id_users = intval($row->Id_Users);
                $todos[] = $todo;
            }
            
            error_log("Fetched todos: " . print_r($todos, true));
            
            return $todos;
        } catch (PDOException $e) {
            error_log("Error fetching all todos: " . $e->getMessage());
            return [];
        }
    }

    function fetch($id) {
        $pdo = DbSingleton::getInstance()->getPdo();
        try {
            $sql = "SELECT * FROM todo WHERE Id_Todo = :id;";
            $sth = $pdo->prepare($sql);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            $row = $sth->fetch(PDO::FETCH_OBJ);

            if ($row) {
                $todo = new stdClass();
                $todo->id = intval($row->Id_Todo);
                $todo->titre = $row->Titre;
                $todo->description = $row->Description;
                $todo->date_creation = $row->Date_Creation;
                $todo->date_modif = $row->Date_modif;
                $todo->res_modifi = $row->ResModifi;
                $todo->echeance = $row->Echeance;
                $todo->id_statut = intval($row->Id_Statut);
                $todo->id_priorite = intval($row->Id_Priorite);
                $todo->id_users = intval($row->Id_Users);
                
                error_log("Fetched todo: " . print_r($todo, true));
                
                return $todo;
            } else {
                error_log("No todo found with Id_Todo = " . $id);
            }
        } catch (PDOException $e) {
            error_log("Error fetching todo: " . $e->getMessage());
        }
        return null;
    }


    /* seulement pour afficher id titre descrioption
    function fetchAll() {
        $pdo = DbSingleton::getInstance()->getPdo();
        try {
            $sql = "SELECT Id_Todo, Titre, Description FROM todo;";
            $sth = $pdo->prepare($sql);
            $sth->execute();
            $results = $sth->fetchAll(PDO::FETCH_OBJ);

            $todos = [];
            foreach ($results as $row) {
                $todo = new stdClass(); // Use stdClass for simplicity
                $todo->id = intval($row->Id_Todo);
                $todo->titre = $row->Titre;
                $todo->description = $row->Description;
                $todos[] = $todo;
            }
            
            error_log("Fetched todos: " . print_r($todos, true));
            
            return $todos;
        } catch (PDOException $e) {
            error_log("Error fetching all todos: " . $e->getMessage());
            return [];
        }
    }

    function fetch($id) {
        $pdo = DbSingleton::getInstance()->getPdo();
        try {
            $sql = "SELECT Id_Todo, Titre, Description FROM todo WHERE Id_Todo = :id;";
            $sth = $pdo->prepare($sql);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
            $sth->execute();
            $row = $sth->fetch(PDO::FETCH_OBJ);

            if ($row) {
                $todo = new stdClass();
                $todo->id = intval($row->Id_Todo);
                $todo->titre = $row->Titre;
                $todo->description = $row->Description;
                
                error_log("Fetched todo: " . print_r($todo, true));
                
                return $todo;
            } else {
                error_log("No todo found with Id_Todo = " . $id);
            }
        } catch (PDOException $e) {
            error_log("Error fetching todo: " . $e->getMessage());
        }
        return null;
    }
    */

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
