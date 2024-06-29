<?php
require(ROOT . "/utils/AbstractController.php");
require(ROOT . "/service/TodoService.php");

class TodoPostController extends AbstractController {
    private $service;

    public function __construct($form) {
        parent::__construct($form, "TodoPostController");
        $this->service = new TodoService();

        // Gestion des données x-www-form-urlencoded
        if (empty($this->form)) {
            $this->form = $_POST;
        }

        error_log("TodoPostController initialized with form: " . print_r($this->form, true));
    }

    protected function checkForm() {
        error_log("Checking form: " . print_r($this->form, true));
        if (!isset($this->form["titre"]) || !isset($this->form["description"]) || !isset($this->form["idPriorite"]) || !isset($this->form["idUsers"])) {
            error_log("Missing required fields");
            $this->responseError("Missing required fields");
        }
    }

    protected function checkCybersec() {
        // Ajoutez vos vérifications de sécurité ici
    }

    protected function checkRights() {
        // Ajoutez vos vérifications de droits d'accès ici
    }

    protected function processRequest() {
        error_log("Processing request with form: " . print_r($this->form, true));

        $titre = isset($this->form['titre']) ? $this->form['titre'] : null;
        $description = isset($this->form['description']) ? $this->form['description'] : null;
        $idPriorite = isset($this->form['idPriorite']) ? $this->form['idPriorite'] : null;
        $idUsers = isset($this->form['idUsers']) ? $this->form['idUsers'] : null;
        $dateEcheance = isset($this->form['dateEcheance']) ? $this->form['dateEcheance'] : null;
        $dateCreation = isset($this->form['dateCreation']) ? $this->form['dateCreation'] : date('Y-m-d H:i:s');

        if ($titre && $description && $idPriorite && $idUsers) {
            $todo = new Todo();
            $todo->setTitre($titre);
            $todo->setDescription($description);
            $todo->setDateCreation($dateCreation);
            $todo->setEcheance($dateEcheance); // Ou la valeur appropriée
            $todo->setIdStatut(1); // Ou le statut par défaut
            $todo->setIdPriorite($idPriorite);
            $todo->setIdUsers($idUsers);

            $this->service->insert($todo);
        } else {
            error_log("Invalid data: " . print_r($this->form, true));
            $this->responseError("Invalid data provided");
        }
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