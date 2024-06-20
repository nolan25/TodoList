<?php

	class Statut {

		public int $id_statuts;
		public string $label;

		function __construct() {
		}

		public function getId() : int {
			return $this->id_statuts;
		}
		public function getLabel() : string {
			return $this->label;
		}

		public function setId(int $_id) {
            $this->id_statuts = $_id;
        }

        public function setLabel(string $_label) {
            $this->label = $_label;
        }

	}

?>
