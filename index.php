

<!-- 

    define("ROOT", dirname(__FILE__));//Sert de racine pour le chargement des fichiers
    require_once(ROOT . '/utils/functions.php');


    // Extraire le formulaire en fonction de la méthode HTTP
    $FORM = extractForm();
    $ROUTE = extractRoute($FORM); // Obtenez la route

    // Si la demande est pour les statuts, et qu'elle est faite via AJAX
    if ($ROUTE === 'statut') {
        $controller = createController($FORM, $ROUTE);
        $controller->execute();
        exit(); // Arrête l'exécution après la récupération des statuts
    }
    */ -->
    

<?php

/*
// index.php
define("ROOT", dirname(__FILE__));//Sert de racine pour le chargement des fichiers
require_once(ROOT . '/utils/functions.php');
// Inclure les fichiers nécessaires (par exemple, les configurations et les DAO)
require_once('utils/DbSingleton.php');
require_once('utils/AbstractDao.php');
require_once('utils/BaseDao.php');
require_once('model/Task.php');
require_once('model/Status.php');
require_once('controllers/TaskController.php');
require_once('controllers/StatusController.php');

// Définir une fonction de routage simple
function route($method, $route, $callback) {
    if ($_SERVER['REQUEST_METHOD'] === $method && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $route) {
        $callback();
        exit();
    }
}

// Routes
route('GET', '/phptodo/index.php/tasks', function() {
    $controller = new TaskController();
    $controller->getAllTasks();
});

route('POST', '/phptodo/index.php/tasks', function() {
    $controller = new TaskController();
    $controller->createTask();
});

route('GET', '/phptodo/index.php/statuses', function() {
    $controller = new StatusController();
    $controller->getAllStatuses();
});

// Autres routes...

// Si aucune route correspond, retourner une erreur 404
http_response_code(404);
echo json_encode(['error' => 'Route not found']);

*/
// index.php

require_once 'controllers/TodoController.php';

// Route parsing (very basic example)
$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'getTodos':
        $controller = new TodoController();
        $controller->getTodos();
        break;
    case 'addTodo':
        $controller = new TodoController();
        $controller->addTodo();
        break;
    case 'updateTodo':
        $controller = new TodoController();
        $controller->updateTodo();
        break;
    case 'deleteTodo':
        $controller = new TodoController();
        $controller->deleteTodo();
        break;
    default:
        echo "Route not found";
        break;
}

?>