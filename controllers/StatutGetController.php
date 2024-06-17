
<?php

require(ROOT . '/utils/AbstractController.php'); 
require(ROOT . '/service/statutService.php');
//require(ROOT . '/view/StatutView.php'); // Ajout de la vue

class StatutGetController extends AbstractController {
    private $service;
    private $statuts;
    //private $view; // Ajout de la vue

    // Constructeur prenant un formulaire en paramètre
    public function __construct($form){
        parent::__construct($form, 'StatutGetController' );
        $this->service = new StatutService();
        //$this->view = new StatutView(); // Initialisation de la vue
    }

    // Méthode pour vérifier le formulaire
    protected function checkForm()
    {
        error_log(__FUNCTION__);
    }

    // Méthode pour vérifier la sécurité
    protected function checkCybersec()
    {
        error_log(__FUNCTION__);
    }

    // Méthode pour vérifier les droits d'accès
    protected function checkRights()    
    {
        error_log(__FUNCTION__);
    }

    // Méthode pour traiter la requête
    protected function processRequest()
    {
        $this->statuts = $this->service->fetchAll();
    }

    // Méthode pour traiter la réponse
    protected function processResponse()
    {
        // Indique que le contenu de la réponse est JSON
        header('Content-Type: application/json');
    
        // Convertit les données en JSON et les renvoie
        echo json_encode($this->statuts, JSON_UNESCAPED_UNICODE);

    }

}
?>