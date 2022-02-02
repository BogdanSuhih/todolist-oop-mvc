<?php

const HOST = "localhost";
const USER = "root";
const PASSWORD = "";
const DATABASE = "todo_db";

$db = new Classes\DbShell(HOST, USER, PASSWORD, DATABASE);
$todo = new Classes\Todo($db);
