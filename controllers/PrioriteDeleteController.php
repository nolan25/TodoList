<?php
    require(ROOT."/utils/AbstractController.php");
    require(ROOT."/service/PrioriteService.php");
    
    class PrioriteDeleteController extends AbstractController{
        
        private $service;
        private $priorites;
        

        public function __construct($form){
            parent::__construct($form, "PrioriteGetController");
            $this->service = new PrioriteService();
        }

        protected function checkForm(){
            //Je vais controller si j'ai un id et je vais le stocker
            if(!isset($this->form["id"])){
                //Ici je n'ai pas d'id, donc c'est pour un listing
                error_log(__FUNCTION__." listing");
            }
            else{
                error_log(__FUNCTION__." une seule priorite");
                $this->id = $this->form["id"];
            }
        }

        protected function checkCybersec(){
            if(isset($this->id)){
                //Est-ce que c'est un nombre entier ?
                if(ctype_digit($this->id)){
                    error_log(__FUNCTION__." id est bien un nombre entier");
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
            if(isset($this->id)){
                $this->priorites = $this->service->delete($this->id);
            }
        }
        
        protected function processResponse(){
            if(isset($this->id)){
                echo json_encode($this->priorite);
            }
            else{
                echo json_encode($this->priorites);
            }            
        }
    }
?>