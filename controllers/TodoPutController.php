<?php
// Inclure les fichiers nécessaires
require(ROOT . '/utils/AbstractController.php'); // Inclusion de la classe parente AbstractController
require(ROOT . '/service/TodoService.php'); // Inclusion du service qui gère les to-do

// Définition de la classe du contrôleur
class TodoPutController extends AbstractController
{
    private $service; // Instance du service de gestion des to-do
    private $todo; // Variable pour stocker la to-do insérée
    private $entity; // Variable pour stocker les données à insérer
    private $id; //Variable pour stocker l'ID 

    // Constructeur
    // Constructeur
    public function __construct($form)
    {
        parent::__construct($form, 'TodoPutController'); // Appel du constructeur de la classe parente
        $this->service = new ToDoService(); // Initialisation du service de gestion des to-do
        $this->id = $this->form["id_todo"]; // Assurez-vous que cette clé est correctement définie dans $this->form
    }

    // Vérification du formulaire (méthode abstraite dans la classe parente)
    protected function checkForm()
    {
        error_log(__FUNCTION__); // Enregistrement d'un message dans les logs
    }

    // Vérification de la sécurité informatique (méthode abstraite dans la classe parente)
    protected function checkCybersec()
    {
        error_log(__FUNCTION__); // Enregistrement d'un message dans les logs
    }

    // Vérification des droits d'accès (méthode abstraite dans la classe parente)
    protected function checkRights()
    {
        error_log(__FUNCTION__); // Enregistrement d'un message dans les logs
    }

    // Traitement de la requête (méthode abstraite dans la classe parente)
    protected function processRequest()
    {
        // Créer un tableau associatif contenant les données à mettre à jour
        $this->entity = Todo::create($this->form);
        
        // Validation : Assurez-vous que la description n'est pas vide
        if (empty($this->entity->getDescription())) {
            throw new Exception("La description ne peut pas être vide.");
        }
    
        // Mettre à jour la to-do en utilisant le service correspondant
        $this->todo = $this->service->update($this->entity, $this->id);
    }
    

    // Traitement de la réponse (méthode abstraite dans la classe parente)
    protected function processResponse()
    {
        // Retourner la to-do insérée au format JSON
        echo json_encode($this->todo);
    }
}
?>