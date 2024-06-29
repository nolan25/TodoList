<?php
    require(ROOT."/utils/AbstractController.php");
    require(ROOT."/service/PrioriteService.php");

    class PrioritePostController extends AbstractController{
        private $service;

        private $priorites;

        public function __construct($form) {
            parent::__construct($form, "PrioritePostController");
            error_log('Form received: ' . json_encode($form));
            $this->service = new PrioriteService();
        }
       

        protected function checkCybersec(){
            if(isset($this->entity)){
                //Est-ce que c'est un nombre entier ?
                if(is_string($this->entity)){
                    error_log(__FUNCTION__." entity est bien un nombre entier");
                }
                else{
                    _400_Bad_Request();
                }
            }
        }

        protected function checkRights(){
            error_log(__FUNCTION__);
        }

        protected function checkForm() {
            if (!isset($this->form["entity"])) {
                error_log(__FUNCTION__ . " listing");
            } else {
                error_log(__FUNCTION__ . " une seule priorite");
                $this->entity = $this->form["entity"];
                error_log('Entity: ' . json_encode($this->entity));
            }
        }
        
        protected function processRequest() {
            if (isset($this->entity)) {
                error_log('Processing entity: ' . json_encode($this->entity));
                $this->priorite = $this->service->insert($this->entity);
                error_log('Result of insert: ' . json_encode($this->priorite));
            }
        }
        
        protected function processResponse() {
            if (isset($this->priorite)) {
                echo json_encode($this->priorite);
            } else {
                echo json_encode($this->priorites);
            }
        }
    }
?>
