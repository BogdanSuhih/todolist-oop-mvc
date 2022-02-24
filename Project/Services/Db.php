<?php

namespace Project\Services;

use Project\Exceptions\DbException;

class Db
{
    private $pdo;
    private static $connect;

    public function __construct()
    {
        $dbOptions = (require __DIR__ . '/../settings.php')['db'];
        try {
            $this->pdo = new \PDO(
                'mysql:dbname='.$dbOptions['dbname'].';host='.$dbOptions['host'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES utf8');
        } catch (\PDOException $ex) {
            throw new DbException('Ощибка подключения к базе данных: ' . $ex->getMessage());
        }
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $result = $sth->execute($params);
        } catch (\PDOException $ex) {
            throw new DbException('Ощибка выполнения запроса:' . $ex->getMessage());
        }

        if (false == $result) {
            return null;
        }

        $resultArray = $sth->fetchAll(\PDO::FETCH_CLASS, $className);
        
        return $resultArray;
    }

    public static function getInstanse(): Db
    {
        if (self::$connect == false) {
            self::$connect = new self;
        }

        return self::$connect;
    }
}
