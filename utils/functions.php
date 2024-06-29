<?php 

    //Cette fonction traite la méthode HTTP utilisée pour la requête et retourne les données du formulaire en fonction de cette méthode.  
    function extractForm(){
        
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET': return $_GET;                                       //pour recuper des donnes (READ)
            case 'POST': return $_POST;                                     // pour cree un nouvel enregistrement (CREATE)
            case 'PUT': return extractRawForm();                                   //pour mettre a jour (UPDATE)
            case 'DELETE': return extractRawForm();                                //pour supprimer (DELETE)
            default : _405_Method_Not_Allowed();
        }
    }

    //Cette fonction extrait et valide la route à partir du formulaire reçu.
    function extractRoute($form) {
        if (!isset($form['route'])) {
            return 'Home'; // Route par défaut
        }
        $ROUTE = $form['route'];
        
       
        if (preg_match('/^[A-Za-z]+$/', $ROUTE)) {
      
            return $ROUTE;
        }
        _400_Bad_Request();
    }

    function createController($FORM, $ROUTE){
        // Convertir la route en CamelCase
        $METHOD = strtolower($_SERVER['REQUEST_METHOD']);
        $METHOD = ucfirst($METHOD);
        $ROUTE = ucfirst(strtolower($ROUTE));
         // Convertir la première lettre en majuscule pour correspondre au nom de la classe
        require(ROOT . '/controllers/' . $ROUTE . $METHOD . 'Controller.php');  
        
    
        $className = $ROUTE . $METHOD . 'Controller';
        if (class_exists($className)) {
            $controller = new $className($FORM);
            return $controller;
        } else { 
            _404_Not_Found();
        }
    }

    //Cette fonction extrait les données brutes du corps de la requête HTTP.
    function extractRawForm() {
        $raw = file_get_contents('php://input');
        $form = [];
        parse_str($raw, $form);
       var_dump($form);
        return $form;
    }

    function _405_Method_Not_Allowed(){
        headerAndDie('HTTP/1.1 405 Method Not Allowed');
    }
    function _400_Bad_Request(){
        headerAndDie('HTTP/1.1 400 Bad Request');
    }

    function _404_Not_Found(){
        headerAndDie('HTTP/1.1 404 Not Found');
    }

    function headerAndDie($header){
        header($header);
        die();
    }

?>