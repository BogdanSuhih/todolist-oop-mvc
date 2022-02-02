<?php
namespace Classes;

class DbShell
{
    private $conn;
    
    public function __construct($host, $user, $password, $database)
    {
        $this->conn = mysqli_connect($host, $user, $password, $database) or die(mysqli_error($this->conn));
        $this->runQuery("SET NAMES 'utf8'");
    }
    
    public function runQuery($query)
    {
        return mysqli_query($this->conn, $query);
    }
}
