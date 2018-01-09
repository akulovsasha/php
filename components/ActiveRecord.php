<?php

namespace components;

use exceptions\DbException;
use helpers\Arrays;
use InvalidArgumentException;
use PDO;

/**
 * Class ActiveRecord
 * @package components
 */
abstract class ActiveRecord extends Model
{
    /**
     * @var string
     */
    private $primaryKey;

    /**
     * @var array
     */
    private $schema = [];

    /**
     * @var array
     */
    private $attributes = [];

    public function __construct()
    {
        $this->primaryKey = $this->primaryKey();
        $this->schema = $this->schema();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->attributes)) {
            throw new InvalidArgumentException("Argument '{$name}' not exists");
        }

        return $this->attributes[$name];
    }

    /**
     * @param array $data
     * @return bool
     */
    public function load(array $data)
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->schema)) {
                throw new InvalidArgumentException("Column '{$key}' is not allowed");
            }

            $this->attributes[$key] = $value;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->getIsNewRecord() ? $this->insert() : $this->update();
    }

    /**
     * @return bool
     */
    public function insert()
    {
        $columns = [];
        $aliases = [];
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $columns[] = $key;

            $alias = ":{$key}";
            $aliases[] = $alias;
            $attributes[$alias] = $value;
        }

        $columns = implode(',', $columns);
        $aliases = implode(',', $aliases);
        $sql = "INSERT INTO {$this->tableName()} ({$columns}) VALUES ({$aliases})";

        $statement = $this->getDb()->prepare($sql);
        foreach ($attributes as $key => $value) {
            $statement->bindParam($key, $value);
        }

        return $statement->execute();
    }

    /**
     * @return bool
     */
    public function update()
    {
        $columns = [];
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $alias = ":{$key}";
            $attributes[$alias] = $value;

            if ($key == $this->primaryKey) {
                continue;
            }

            $columns[] = "{$key} = {$alias}";
        }

        $columns = implode(', ', $columns);
        $sql = "UPDATE {$this->tableName()} SET {$columns} WHERE {$this->primaryKey} = :{$this->primaryKey}";

        $statement = $this->getDb()->prepare($sql);

        foreach ($attributes as $key => $value) {
            $statement->bindValue($key, $value);
        }

        return $statement->execute();
    }

    /**
     * @return bool
     * @throws DbException
     */
    public function delete()
    {
        if ($this->getIsNewRecord()) {
            throw new DbException("Record for delete is not found");
        }

        $sql = "DELETE FROM {$this->tableName()} WHERE {$this->primaryKey} = :{$this->primaryKey} LIMIT 1";
        $statement = $this->getDb()->prepare($sql);
        $statement->bindValue(":{$this->primaryKey}", $this->{$this->primaryKey});

        return $statement->execute();
    }

    /**
     * @return bool
     */
    public function getIsNewRecord()
    {
        return !array_key_exists($this->primaryKey, $this->attributes);
    }

    /**
     * @return array|mixed|null
     * @throws DbException
     */
    protected function primaryKey()
    {
        $sql = "SHOW KEYS FROM {$this->tableName()} WHERE Key_name = 'PRIMARY'";
        $statement = $this->getDb()->prepare($sql);
        $statement->execute();

        $primaryKey = Arrays::getValue('Column_name', $statement->fetch(PDO::FETCH_ASSOC));

        if (empty($primaryKey)) {
            throw new DbException("Table '{$this->tableName()}' must have primary key");
        }

        return $primaryKey;
    }

    /**
     * @return array
     */
    protected function schema()
    {
        $sql = "SHOW COLUMNS FROM {$this->tableName()}";
        $statement = $this->getDb()->prepare($sql);
        $statement->execute();

        $schema = [];
        foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $column) {
            $schema[] = $column['Field'];
        }

        return $schema;
    }

    /**
     * @param int $id
     * @return static
     */
    public function findOne($id)
    {
        $table = $this->tableName();
        $primary = $this->primaryKey();

        $sql = "SELECT * FROM {$table} WHERE {$primary} = :{$primary} LIMIT 1";

        $statement = $this->getDb()->prepare($sql);
        $statement->bindValue(":{$primary}", $id);
        $statement->execute();

        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        $data = $statement->fetch();

        $this->load($data);
        return $this;
    }

}

