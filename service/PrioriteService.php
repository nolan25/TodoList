<?php
    require_once(ROOT."/utils/AbstractService.php");
    require_once(ROOT."/utils/BaseService.php");
    require_once(ROOT."/dao/PrioriteDao.php");

    class PrioriteService extends AbstractService implements BaseService{
        private $prioriteDao;
        
        function __construct(){
            // On n'utilise pas les méthodes de l'interface
            $this->prioriteDao = new PrioriteDao();
        }

        function fetchAll(){
            $list = $this->prioriteDao->fetchAll();
            return $list;
        }

        public function fetch($id){
            return $this->prioriteDao->fetch($id);
        }

        public function insert($entity){
            $insertedLabel = $this->prioriteDao->insert($entity);
    
            return $insertedLabel;
        }

        public function update($entity){
            return $this->prioriteDao->update($entity);
        }

        public function delete($id){
            return $this->prioriteDao->delete($id);
        }
    }
?>