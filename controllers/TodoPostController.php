<?php
require(ROOT . "/utils/AbstractController.php");
require(ROOT . "/service/TodoService.php");

class TodoPostController extends AbstractController {

    private $service;

    public function __construct($form) {
        parent::__construct($form, "TodoPostController");
        $this->service = new TodoService();
    }

    protected function checkForm() {
        // Vérifiez que toutes les données nécessaires sont présentes dans le formulaire
        if (!isset($this->form["title"]) || !isset($this->form["description"])) {
            _400_Bad_Request();
        }
    }

    protected function checkCybersec() {
        // Ici, vous pouvez effectuer des vérifications de sécurité si nécessaire
    }

    protected function checkRights() {
        // Vérifiez les droits d'accès si nécessaire
    }

    protected function processRequest() {
        // Créer un nouvel objet todo à partir des données du formulaire
        $todo = new Todo();
        $todo->setTitle($this->form["title"]);
        $todo->setDescription($this->form["description"]);

        // Appel au service pour créer la todo
        $this->service->insert($todo);

        // Vous pouvez envoyer une réponse JSON avec l'ID de la nouvelle todo créée
        $this->response = ["message" => "Todo created successfully", "id" => $todo->getId()];
    }

    protected function processResponse() {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['status' => 'success', 'message' => 'Todo created successfully']);
    }
      private function responseError($message) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => $message]);
        exit;
    }
}
?>