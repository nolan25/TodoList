<?php   
    function extractForm(){
        // echo $_SERVER['REQUEST_METHOD'];
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET': return $_GET;                                       //pour recuper des donnes (READ)
            case 'POST': return $_POST;                                     // pour cree un nouvel enregistrement (CREATE)
            case 'PUT': return extractRawForm();                                   //pour mettre a jour (UPDATE)
            case 'DELETE': return extractRawForm();                                //pour supprimer (DELETE)
            default : _405_Method_Not_Allowed();
        }
    }
   function extractRoute($form) {
    if (!isset($form['route'])) {
        return 'home'; // Route par défaut
    }
    $ROUTE = $form['route'];
    if (preg_match('/^[A-Za-z]+$/', $ROUTE)) {
        return $ROUTE;
    }
    _400_Bad_Request();
}
    function createController($FORM, $ROUTE){
        //si mon controlleur  sappelle statutget
        $METHOD = strtolower($_SERVER['REQUEST_METHOD']);
        $METHOD = ucfirst($METHOD);
        require(ROOT . '/controllers/' . $ROUTE . $METHOD . 'Controller.php');  
            //la classe dans ce fichier sappelera StatutGetController 
            $className = $ROUTE . $METHOD . 'Controller';
            $controller = new $className($FORM);
            return $controller;
    }

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