<?php
require(ROOT . "/utils/AbstractController.php");
require(ROOT . "/service/TodoService.php");

class TodoGetController extends AbstractController {
    private $service;
    private $todos;
    private $todo;

    public function __construct($form) {
        parent::__construct($form, "TodoGetController");
        $this->service = new TodoService();
    }

    protected function checkForm() {
        if (!isset($this->form["id"])) {
            error_log(__FUNCTION__ . " listing");
        } else {
            error_log(__FUNCTION__ . " un seul todo");
            $this->id = $this->form["id"];
        }
    }

    protected function checkCybersec() {
        if (isset($this->id)) {
            if (ctype_digit($this->id)) {
                error_log(__FUNCTION__ . " id est bien un nombre entier");
            } else {
                _400_Bad_Request();
            }
        }
    }

    protected function checkRights() {
        error_log(__FUNCTION__);
    }

    protected function processRequest() {
        if (isset($this->id)) {
            $this->todo = $this->service->fetch($this->id);
        } else {
            $this->todos = $this->service->fetchAll();
        }
    }

    protected function processResponse() {
        if (isset($this->id)) {
            echo json_encode($this->todo);
        } else {
            echo json_encode($this->todos);
        }
    }
}
?>