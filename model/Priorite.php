<?php

	class Priorite {

		public int $id_priorites;
		public string $libelle;

		function __construct() {
		}

		public function getId() : int {
			return $this->id_priorites;
		}
		
		public function getLabel() : string {
			return $this->libelle;
		}

		public function setId(int $id_priorites) {
            $this->id_priorites = $id_priorites;
        }
        public function setLabel(string $_libelle) {
            $this->libelle = $_libelle;
        }

	}

?>