<?php
// Définit la constante ROOT pour inclure les fichiers
define('ROOT', __DIR__);

// Inclut la classe StatutDao et toutes ses dépendances
require_once(ROOT . '/utils/DbSingleton.php');
require_once(ROOT . '/model/Statut.php');
require_once(ROOT . '/utils/AbstractDao.php');
require_once(ROOT . '/utils/BaseDao.php');
require_once(ROOT . '/dao/StatutDao.php');

header('Content-Type: application/json');

try {
    // Crée une instance de StatutDao
    $statutDao = new StatutDao();
    
    // Utilise la méthode fetchAll pour récupérer tous les statuts
    $statuts = $statutDao->fetchAll();

    // Transforme les objets Statut en tableau associatif
    $statutsArray = array();
    foreach ($statuts as $statut) {
        $statutsArray[] = array(
            'id' => $statut->getId(),
            'label' => $statut->getLabel()
        );
    }

    // Renvoie les statuts sous forme de JSON
    echo json_encode($statutsArray);
} catch (PDOException $e) {
    // Gestion des erreurs
    echo json_encode(array('error' => $e->getMessage()));
} catch (Exception $e) {
    // Gestion des erreurs générales
    echo json_encode(array('error' => $e->getMessage()));
}
?>