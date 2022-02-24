<?php

namespace Project\Controllers;

use Project\Controllers\AbstractController;

class MainController extends AbstractController
{
    public function main()
    {
        if (!$this->user) {
            $this->view->renderTemplate('main/main.php', ['title'=>'TODO']);
            return;
        }

        $this->view->renderTemplate(
            'main/main.php',
            ['title'=>'TODO', 'todos' => $this->userTodos, 'user' => $this->user]
        );
    }
}
