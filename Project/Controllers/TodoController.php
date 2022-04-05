<?php

namespace Project\Controllers;

use Project\Models\Todos\Todo;
use Project\Controllers\AbstractController;
use Project\Exceptions\RouteException;

class TodoController extends AbstractController
{
    public function addTodo()
    {
        if (!$this->user) {
            throw new RouteException('Такого адреса не существует');
        } if ((int)$_POST['user_id'] === $this->user->getId()) {
            Todo::createTodo($_POST);
            header('Location: index.php', true, 302);
            exit();
        }
    }

    public function deleteTodo()
    {
        if (is_object($this->user) && is_array($this->userTodos) && isset($_GET['id'])) {
            foreach ($this->userTodos as $todo) {
                $match = (int)$_GET['id'] === $todo->getId();
                if ($match) {
                    Todo::deleteById((int)$_GET['id']);
                    header('Location: index.php', true, 302);
                    exit();
                }
            }
        }
        throw new RouteException('Такого адреса не существует');
    }

    public function editTodo()
    {
        if (is_object($this->user) && is_array($this->userTodos) && isset($_GET['id'])) {
            foreach ($this->userTodos as $todo) {
                $match = (int)$_GET['id'] === $todo->getId();
                if ($match) {
                    $this->view->renderTemplate(
                        'main/main.php',
                        ['title'=>'TODO',
                        'todos' => $this->userTodos,
                        'user' => $this->user,
                        'currentTodo' => $todo
                        ]
                    );
                    exit();
                }
            }
        }
        throw new RouteException('Такого адреса не существует');
    }
    
    public function updateTodo()
    {
        if (is_object($this->user) && is_array($this->userTodos) && isset($_POST['todo_id'])) {
            foreach ($this->userTodos as $todo) {
                $match = (int)$_POST['todo_id'] === $todo->getId();
                if ($match) {
                    Todo::updateTodoById($_POST);
                    header('Location: index.php', true, 302);
                    exit();
                }
            }
        }
        throw new RouteException('Такого адреса не существует');
    }
}
