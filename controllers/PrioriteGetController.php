<?php
require(ROOT . "/utils/AbstractController.php");
require(ROOT . "/service/PrioriteService.php");

class PrioriteGetController extends AbstractController {
    private $service;
    private $priorite;

    public function __construct($form) {
        parent::__construct($form, 'PrioriteGetController');
        $this->service = new PrioriteService();
    }

    protected function checkForm() {
        error_log(__FUNCTION__);
    }

    protected function checkCybersec() {
        error_log(__FUNCTION__);
    }

    protected function checkRights() {
        error_log(__FUNCTION__);
    }

    protected function processRequest() {
        $this->priorite = $this->service->fetchAll();
    }

    protected function processResponse() {
        echo json_encode($this->priorite);
    }
}
?>