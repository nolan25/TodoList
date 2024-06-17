<?php

require_once(ROOT . '/dao/TodoDao.php');

class TodoController {
    
    private $todoDao;

    public function __construct() {
        $this->todoDao = new TodoDao();
    }

    public function getTodos() {
        header('Content-Type: application/json');
        try {
            $todos = $this->todoDao->fetchAll();
            echo json_encode($todos);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function addTodo() {
        header('Content-Type: application/json');
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $todo = new Todo();
            $todo->setTitle($data['title']);
            $todo->setDescription($data['description']);
            $this->todoDao->insert($todo);
            echo json_encode(['success' => 'Todo added']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function updateTodo() {
        header('Content-Type: application/json');
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $todo = new Todo();
            $todo->setId($data['id']);
            $todo->setTitle($data['title']);
            $todo->setDescription($data['description']);
            $this->todoDao->update($todo);
            echo json_encode(['success' => 'Todo updated']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function deleteTodo() {
        header('Content-Type: application/json');
        try {
            $id = $_GET['id'];
            $this->todoDao->delete($id);
            echo json_encode(['success' => 'Todo deleted']);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
?>
