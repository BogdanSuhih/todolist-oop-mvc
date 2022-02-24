<?php

namespace Project\Controllers;

use Project\Models\Todos\Todo;
use Project\Models\Users\WorkCookies;
use Project\Views\View;

class AbstractController
{
    public $user;
    public $userTodos;
    public $view;

    public function __construct()
    {
        $this->user = WorkCookies::checkUserCookie();
        if (is_object($this->user)) {
            $this->userTodos = Todo::getAllByAuthor($this->user->getId());
        } else {
            $this->userTodos = null;
        }
        $this->view = new View(__DIR__ . '/../../templates/');
    }
}
