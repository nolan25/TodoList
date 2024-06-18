<?php

class Todo {
    private $id;
    private $titre;
    private $description;
    private $dateCreation;
    private $dateModif;
    private $resModifi;
    private $echeance;
    private $idStatut;
    private $idPriorite;
    private $idUsers;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDateCreation() {
        return $this->dateCreation;
    }

    public function getDateModif() {
        return $this->dateModif;
    }

    public function getResModifi() {
        return $this->resModifi;
    }

    public function getEcheance() {
        return $this->echeance;
    }

    public function getIdStatut() {
        return $this->idStatut;
    }

    public function getIdPriorite() {
        return $this->idPriorite;
    }

    public function getIdUsers() {
        return $this->idUsers;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    public function setDateModif($dateModif) {
        $this->dateModif = $dateModif;
    }

    public function setResModifi($resModifi) {
        $this->resModifi = $resModifi;
    }

    public function setEcheance($echeance) {
        $this->echeance = $echeance;
    }

    public function setIdStatut($idStatut) {
        $this->idStatut = $idStatut;
    }

    public function setIdPriorite($idPriorite) {
        $this->idPriorite = $idPriorite;
    }

    public function setIdUsers($idUsers) {
        $this->idUsers = $idUsers;
    }
}
?>
