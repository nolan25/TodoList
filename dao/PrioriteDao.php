<?php
    require_once(ROOT."/utils/AbstractDao.php");
    require_once(ROOT."/utils/BaseDao.php");
    require_once(ROOT."/utils/DbSingleton.php");
    require_once(ROOT."/model/Priorite.php");

    class PrioriteDao extends AbstractDao implements BaseDao{
        // private $PrioriteDao; // Pas utile
        
        function __construct(){
        }

        function fetchAll(){
            $pdo = DbSingleton::getInstance()->getPdo();
            $sql = "SELECT * FROM priorite;";
            $sth = $pdo->query($sql);
            $result = $sth->fetchAll(PDO::FETCH_OBJ);
            $priorites = array();
            foreach($result as $row){
                $priorite = new Priorite();
                $priorite->setId(intval($row->Id_Priorite));
                $priorite->setLabel($row->label);
                array_push($priorites, $priorite);
            }
            return $priorites;
        }

        function fetch($id){
            $pdo = DbSingleton::getInstance()->getPdo();
            // TODO faire un prepared statement
            $sql = "SELECT * FROM priorite AS p WHERE p.Id_Priorite=".$id.";";
            $sth = $pdo->query($sql);
            $result = $sth->fetch(PDO::FETCH_OBJ);
            //Si result est false, ça n'existe pas, donc 404
            if(!$result){
                _404_Not_Found();
            }
            $priorite = new Priorite();
            $priorite->setId(intval($result->Id_Priorite));
            $priorite->setLabel($result->label);
            return $priorite;
        }

        function insert($entity){
            $pdo = DbSingleton::getInstance()->getPdo();
            $sql = "INSERT INTO priorite (libelle) VALUES (:libelle)";
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':libelle', $entity, PDO::PARAM_STR);
            $sth->execute();
            return $entity; 
        }

        function update($entity){
           return;
        }

        function delete($id){
            $pdo = DbSingleton::getInstance()->getPdo();
            $sql = "DELETE FROM priorite WHERE Id_Priorite = :id";
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->execute();            
        }
    }
?>