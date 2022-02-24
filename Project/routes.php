<?php
use Project\Controllers\MainController;
use Project\Controllers\UserController;
use Project\Controllers\TodoController;

return [
    "~^$~" => [MainController::class, 'main'],
    "~^login(.*)$~" => [UserController::class, 'login'],
    "~^logout(.*)$~" => [UserController::class, 'logout'],
    "~^register(.*)$~" => [UserController::class, 'register'],
    "~^addtodo(.*)$~" => [TodoController::class, 'addTodo'],
    "~^delete(.*)$~" => [TodoController::class, 'deleteTodo'],
];
