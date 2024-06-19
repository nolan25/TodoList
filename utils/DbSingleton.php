<?php

class DbSingleton {
	private static $_instance = null; //Variable statique qui stocke l'instance unique de DbSingleton.
	private $pdo;//Stocke l'objet PDO pour la connexion à la base de données.

	private function __construct() {
		// Database source name
		$DSN = 'mysql:host=localhost;port=3306;dbname=todo';//contien les informations de la base de données
		try { 
			
			$this->pdo = new PDO($DSN, 'todo', 'todo'); //creation dune  nouvel instance pour la base de données
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//configure PDO pour lancer des exceptions en cas d'erreurs
		} catch (PDOException $e) {
			// Bad credential ? DBMS Driver not found ? Connection fail ?
			die("Error ! : " . $e->getMessage());
		}
	}
    //Retourne l'objet PDO pour effectuer des opérations sur la base de données.
	public function getPdo() {
		return $this->pdo;
	}
   //Cette méthode est utilisée pour obtenir l'instance unique de DbSingleton.
	public static function getInstance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new DbSingleton();
		}
		return self::$_instance;
	}

	function __destruct() {//Utilise unset($this->pdo) pour libérer les ressources lorsque l'objet est détruit.
		unset($this->pdo);
	}
}

?>
