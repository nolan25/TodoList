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
    
    function insert($entity) {

        function getSmallestAvailableId($pdo) {
            $sql = "SELECT MIN(t1.Id_Todo + 1) AS smallest_id
                    FROM todo t1
                    LEFT JOIN todo t2 ON t1.Id_Todo + 1 = t2.Id_Todo
                    WHERE t2.Id_Todo IS NULL";
            $sth = $pdo->prepare($sql);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result['smallest_id'] ?? 1; // Si aucun enregistrement, commencer à 1
        }
    
        $pdo = DbSingleton::getInstance()->getPdo();
        try {
            // Trouver le plus petit ID disponible
            $id = getSmallestAvailableId($pdo);
    
            $sql = "INSERT INTO todo (Id_Todo, Titre, Description, Date_Creation, Echeance, Id_Statut, Id_Priorite, Id_Users) 
                    VALUES (:id, :titre, :description, :date_creation, :echeance, :id_statut, :id_priorite, :id_users);";
            $sth = $pdo->prepare($sql);
    
            // Stocker les valeurs des getters dans des variables
            $titre = $entity->getTitre();
            $description = $entity->getDescription();
            $date_creation = $entity->getDateCreation();
            $echeance = $entity->getEcheance();
            $id_statut = $entity->getIdStatut();
            $id_priorite = $entity->getIdPriorite();
            $id_users = $entity->getIdUsers();
    
            // Lier les variables aux paramètres
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
            $sth->bindParam(':titre', $titre, PDO::PARAM_STR);
            $sth->bindParam(':description', $description, PDO::PARAM_STR);
            $sth->bindParam(':date_creation', $date_creation, PDO::PARAM_STR);
            $sth->bindParam(':echeance', $echeance, PDO::PARAM_STR);
            $sth->bindParam(':id_statut', $id_statut, PDO::PARAM_INT);
            $sth->bindParam(':id_priorite', $id_priorite, PDO::PARAM_INT);
            $sth->bindParam(':id_users', $id_users, PDO::PARAM_INT);
    
            // Exécution de l'insertion
            $sth->execute();
    
            // Mettre à jour l'ID de l'entité
            $entity->setId($id);
    
            error_log("Inserted todo: " . print_r($entity, true));
    
            return $entity;
        } catch (PDOException $e) {
            error_log("Error inserting todo: " . $e->getMessage());
            return null;
        }
    }
    
    
    public function update($entity, $id)
    {
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "UPDATE todo SET titre = :titre, description = :description, Date_modif = NOW() WHERE id_todo = :id_todo";
        $sth = $pdo->prepare($sql);
    
        // Liaison des paramètres
        $sth->execute(
            array(
                ':id_todo' => $id,
                ':description' => $entity->getDescription(),
                ':titre' => $entity->getTitre(),
            )
        );
    
        // Vérifiez si la mise à jour a réussi
        if ($sth->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function delete($id) {
        $pdo = DbSingleton::getInstance()->getPdo();
        try {
            $sql = "DELETE FROM todo WHERE Id_Todo = :id;";
            $sth = $pdo->prepare($sql);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e) {
            error_log("Error deleting todo: " . $e->getMessage());
        }
    }
}
?>