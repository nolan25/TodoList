<?php
    require(ROOT."/utils/AbstractController.php");
    require(ROOT."/service/PrioriteService.php");

    class PrioritePutController extends AbstractController{
        private $service;

        private $priorites;

        public function __construct($form){
            parent::__construct($form, "PrioritePutController");
            $this->service = new PrioriteService();
        }

        protected function checkForm(){
            //Je vais controller si j'ai un entity et je vais le stocker
            if(!isset($this->form["entity"]) && !isset($this->form["modif"])){
                //Ici je n'ai pas d'entity, donc c'est pour un listing
                error_log(__FUNCTION__." listing");
            }
            else{
                error_log(__FUNCTION__." une seule priorite");
                $this->entity = $this->form["entity"];
                $this->modif = $this->form["modif"];
            }
        }

        protected function checkCybersec(){
            if(isset($this->entity)){
                //Est-ce que c'est un nombre entier ?
                if(is_string($this->entity) && is_string($this->modif)){
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

        protected function processRequest(){
            if(isset($this->entity) && isset($this->modif)){
                $this->priorite = $this->service->update($this->entity, $this->modif);
            }
        }
        
        protected function processResponse(){
            if(isset($this->priorite)){
                echo json_encode($this->priorite);
            }
            else{
                echo json_encode($this->priorite);
            }  
        }
    }
?>
