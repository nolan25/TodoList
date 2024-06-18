<?php

define("ROOT", dirname(__FILE__));//Sert de racine pour le chargement des fichiers
require_once(ROOT . '/utils/functions.php');


// Extraire le formulaire en fonction de la méthode HTTP
$FORM = extractForm();
$ROUTE = extractRoute($FORM); // Obtenez la route

// Si la demande est pour les statuts, et qu'elle est faite via AJAX

    $controller = createController($FORM, $ROUTE);
    $controller->execute();

?>