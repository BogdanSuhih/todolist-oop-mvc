<?php

namespace Project\Controllers;

use Project\Controllers\AbstractController;
use Project\Services\Db;

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
    public function install()
    {
        $db = Db::getInstanse();
        $dbOptions = (require __DIR__ . '/../settings.php')['db'];

        $usersTable = "CREATE TABLE `".$dbOptions['dbname']."`.`users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT ,
            `nickname` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `is_confirmed` TINYINT NOT NULL DEFAULT '0' ,
            `role` ENUM('admin','user') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user',
            `password_hash` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `auth_token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        PRIMARY KEY  (`id`),
        UNIQUE  `nickname` (`nickname`),
        UNIQUE  `email` (`email`))
        ENGINE = InnoDB DEFAULT CHARSET=utf8;";

        $todosTable = "CREATE TABLE `".$dbOptions['dbname']."`.`todos` (
            `id` INT(11) NOT NULL AUTO_INCREMENT ,
            `author_id` int(11) NOT NULL ,
            `title` VARCHAR(255) NOT NULL ,
            `text` TEXT NOT NULL ,
            `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `is_done` TINYINT NOT NULL DEFAULT '0' ,
        PRIMARY KEY  (`id`))
        ENGINE = InnoDB DEFAULT CHARSET=utf8;";

        $db->query($usersTable);
        $db->query($todosTable);
        header('Location: index.php', true, 302);
        exit();
    }
}
