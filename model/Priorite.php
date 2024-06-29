<?php

	class Priorite {

		public int $id_priorites;
		public string $label;

		function __construct() {
		}

		public function getId() : int {
			return $this->id_priorites;
		}
		
		public function getLabel() : string {
			return $this->label;
		}

		public function setId(int $id_priorites) {
            $this->id_priorites = $id_priorites;
        }
        public function setLabel(string $label) {
            $this->label = $label;
        }

	}

?>