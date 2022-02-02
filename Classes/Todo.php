<?php
namespace Classes;

class Todo
{
    private $table = "`todo`";
    private $db;

    public function __construct(DbShell $db)
    {
        $this->db = $db;
        $db->runQuery(
            "CREATE TABLE IF NOT EXISTS $this->table (
            `id` int(11) NOT NULL AUTO_INCREMENT, 
            `todo` varchar(200) NOT NULL, 
            `done` int(11) NOT NULL, 
            PRIMARY KEY (`id`))"
        );
    }

    public function addTask($task)
    {
        $query = "INSERT INTO todo (todo, done) VALUES ('$task', '0')";
        $this->db->runQuery($query);
    }

    public function delTask($id)
    {
        $query = "DELETE FROM todo WHERE todo.id='$id'";
        $this->db->runQuery($query);
    }
}
