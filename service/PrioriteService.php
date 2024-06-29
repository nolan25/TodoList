<?php
    require_once(ROOT."/utils/AbstractService.php");
    require_once(ROOT."/utils/BaseService.php");
    require_once(ROOT."/dao/PrioriteDao.php");

    class PrioriteService {
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

        public function insert($entity) {
            error_log('Inserting entity: ' . json_encode($entity));
            $insertedLabel = $this->prioriteDao->insert($entity);
            error_log('Inserted label: ' . json_encode($insertedLabel));
            return $insertedLabel;
        }

        public function uptade($entity, $id){
            return $this->prioriteDao->update($entity, $id);
        }

        public function delete($id){
            return $this->prioriteDao->delete($id);
        }
    }
?>