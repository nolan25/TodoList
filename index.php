<?php   
    define("ROOT", dirname(__FILE__));//Sert de racine pour le chargement des fichier
    require_once(ROOT . '/utils/functions.php');
    $FORM = extractForm(); //extract le formulaire en fonciton de la methode HTTP
    $ROUTE = extractRoute($FORM); // jai mon formulaire je peux extraire la route
    echo $ROUTE;

    //'Jai ma route donc je peux charger mon controleur
    $controller = createController($FORM, $ROUTE);
    $controller->execute();
    // j'exécute mon controlleur





?>