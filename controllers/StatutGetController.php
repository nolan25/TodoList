
<?php
require(ROOT . "/utils/AbstractController.php");
require(ROOT . "/service/StatutService.php");


class StatusGetController extends AbstractController {

    private $service;
    private $statuts;

    public function __construct($form) {
        parent::__construct($form, "StatutGetController");
        $this->service = new StatutService();
        
    }

    protected function checkForm() {
        // Vérifie si un ID est présent dans le formulaire
        if (!isset($this->form["id"])) {
            // Aucun ID, donc c'est pour un listing
            error_log(__FUNCTION__ . " listing");
        } else {
            error_log(__FUNCTION__ . " un seul status");
            $this->id = $this->form["id"];
        }
    }

    protected function checkCybersec() {
        if (isset($this->id)) {
            // Vérifie si c'est un nombre entier
            if (ctype_digit($this->id)) {
                error_log(__FUNCTION__ . " id est bien un nombre entier");
            } else {
                _400_Bad_Request();
            }
        }
    }

    protected function checkRights() {
        error_log(__FUNCTION__);
    }

    protected function processRequest() {
        if (isset($this->id)) {
            $this->statut = $this->service->fetch($this->id);
        } else {
            $this->statuts = $this->service->fetchAll();
        }
    }

    protected function processResponse() {
        if (isset($this->id)) {
            echo json_encode($this->statut);
        } else {
            echo json_encode($this->statuts);
        }
    }
}
?>