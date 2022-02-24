<?php

namespace Project\Models\Todos;

use Project\Models\AbstractActiveRecord;

class Todo extends AbstractActiveRecord
{
    protected $authorId;
    protected $title;
    protected $text;
    protected $createdAt;
    protected $isDone;
    protected $camelCaseName;
    
    public function getAuthorId(): int
    {
        return (int) $this->authorId;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function getIsDone(): int
    {
        return (int) $this->isDone;
    }

    public static function createTodo(array $data): bool
    {
        $columns = '`author_id`, `text`';
        $values = ':authorId, :text';
        $params = [':authorId' =>  $data['user_id'], ':text' => $data['todo']];
        return self::createRecord($columns, $values, $params);
    }

    public static function getAllByAuthor(int $authorId): ?Array
    {
        $columnsName = '*';
        $whereClause = 'WHERE `author_id` = :authorId';
        $params = [':authorId' => $authorId];
        $entities = self::readRecord($columnsName, $whereClause, $params, static::class);
        
        return $entities;
    }

    /*  public static function updateTodoById(array $data): bool
    {
        $columnsName = '`id`, `text`, `is_done`';
        $values = ':authorId, :text';
        $whereClause = '';
        $params = [':authorId' =>  $data['user_id'], ':text' => $data['todo']];
        // 'UPDATE`'.static::getTableName().'` SET `'.$columnName . '` = '."'".$value."' ".$whereClause.';',

        return self::updateRecord($columnsName, $values, $whereClause, $params);
    } */

    public static function deleteById(int $id): bool
    {
        $whereClause = 'WHERE `id` = :id';
        $params = [':id' => $id];
        return self::deleteRecord($whereClause, $params);
    }

    protected static function getTableName(): string
    {
        return 'todos';
    }
}
