<?php
// Définit la constante ROOT pour inclure les fichiers
define('ROOT', __DIR__);

// Inclut la classe StatutDao et toutes ses dépendances
require_once(ROOT . '/utils/DbSingleton.php');
require_once(ROOT . '/model/Statut.php');
require_once(ROOT . '/utils/AbstractDao.php');
require_once(ROOT . '/utils/BaseDao.php');
require_once(ROOT . '/dao/StatutDao.php');

try {
    // Crée une instance de StatutDao
    $statutDao = new StatutDao();
    
    // Utilise la méthode fetchAll pour récupérer tous les statuts
    $statuts = $statutDao->fetchAll();

    // Affiche les résultats
    echo "<pre>";
    print_r($statuts);
    echo "</pre>";
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    // Gestion des erreurs générales
    echo "Error: " . $e->getMessage();
}
?>