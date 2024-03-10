<?php
/*
// Le fichier StatutView.php définit une classe de vue pour afficher les statuts.

class StatutView {

    // Méthode pour afficher la liste des statuts
    public function showStatuts($statuts) {
        echo "<h1>Liste des Statuts</h1>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Label</th></tr>";

        foreach ($statuts as $statut) {
            echo "<tr>";
            echo "<td>" . $statut->getId() . "</td>";
            echo "<td>" . $statut->getLabel() . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
*/

class StatutView {
    // ... (autres méthodes inchangées)

    public function showStatuts($statuts) {
        // ... (affichage HTML inchangé)

        // Ajoutez un script JavaScript pour stocker les données des statuts
        echo "<script>";
        echo "var statutsData = " . json_encode($this->convertStatutsToAssociativeArray($statuts)) . ";";
        echo "</script>";

        // Incluez directement le script JavaScript dans la page
        echo "<script src='todojs.js'></script>";
    }

    // Méthode pour convertir les objets Statut en tableau associatif pour JSON
    private function convertStatutsToAssociativeArray($statuts) {
        $result = array();
        foreach ($statuts as $statut) {
            $result[] = array(
                'id' => $statut->getId(),
                'label' => $statut->getLabel()
            );
        }
        return $result;  // return array
    }
}




?>