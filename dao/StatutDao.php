<?php

require_once(ROOT . "/utils/AbstractDao.php");
require_once(ROOT . "/utils/BaseDao.php");
require_once(ROOT . "/utils/DbSingleton.php");
require_once(ROOT . "/model/Statut.php");

class StatutDao extends AbstractDao implements BaseDao {
 
    function __construct() {
    }

    function fetchAll(){
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "SELECT * FROM statut;";
        $sth = $pdo->query($sql);
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        $statuts = array();
        foreach($result as $row){
            $statut = new Statut();
            $statut->setId( intval($row->Id_Statut));  // Correction : utilisez setId au lieu de setid
            $statut->setLabel($row->Label);   // Correction : utilisez setLabel au lieu de setlabel
            array_push($statuts, $statut);
        }
        return $statuts;
    }
    
    
    function fetch($id){
        $pdo = DbSingleton::getInstance()->getPdo();
        $sql = "SELECT * FROM statut WHERE Id_Statut = :id;";
        $sth = $pdo->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_OBJ);
        if ($row) {
            $statut = new Statut();
            $statut->setId(intval($row->Id_Statut));
            $statut->setLabel($row->Label);
            return $statut;
        }
        return null;
    }

    function insert($entity){
    }

    function update($entity){
    }

    function delete($id){
    }

    
}



?>

