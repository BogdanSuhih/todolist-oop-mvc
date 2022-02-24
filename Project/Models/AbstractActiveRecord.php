<?php

namespace Project\Models;

use Project\Services\Db;

abstract class AbstractActiveRecord
{
    protected $id;

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    protected function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    public static function findAll(): array
    {
        $db = Db::getInstanse();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '`;',
            [],
            static::class
        );
    }

    protected static function getById(int $id, $className = 'stdClass'): ?Object
    {
        $db = Db::getInstanse();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            $className
        );
        return $entities ? $entities[0] : null;
    }

    protected static function updateById(int $id, string $columnName, string $value): bool
    {
        return static::updateRecord(
            $columnName,
            $value,
            'WHERE id = :id',
            [':id' => $id]
        );
    }

    protected static function createRecord(
        string $columns,
        string $values,
        array $params = []
    ): bool {
        $db = Db::getInstanse();
        $result = $db->query(
            'INSERT INTO `' . static::getTableName() . '` ('. $columns .') VALUES ('. $values .');',
            $params
        );
        return is_array($result);
    }
   
    protected static function readRecord(
        string $columnsName,
        string $whereClause = '',
        array $params = [],
        string $className = 'stdClass'
    ): ?array {
        $db = Db::getInstanse();
        $entities = $db->query(
            'SELECT '.$columnsName.' FROM '.static::getTableName().' '.$whereClause.';',
            $params,
            $className
        );
        return $entities;
    }

    protected static function updateRecord(
        string $columnName,
        string $value,
        string $whereClause = '',
        array $params = []
    ): bool {
        $db = Db::getInstanse();
        $result = $db->query(
            'UPDATE`'.static::getTableName().'` SET `'.$columnName . '` = '."'".$value."' ".$whereClause.';',
            $params
        );
        return is_array($result);
    }

    protected static function deleteRecord(
        string $whereClause = '',
        array $params = []
    ): bool {
        $db = Db::getInstanse();
        $result = $db->query(
            'DELETE FROM`'.static::getTableName().'` '.$whereClause.';',
            $params
        );
        return is_array($result);
    }

    abstract protected static function getTableName(): string;
}
