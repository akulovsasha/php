<?php

namespace components;

/**
 * Class Model
 * @package components
 */
abstract class Model
{
    /**
     * @return string
     */
    public abstract function tableName();

    /**
     * @param array $condition
     * @return array
     */
    public function findAll(array $condition = [])
    {
        $table = $this->tableName();
        $sql = "SELECT * FROM {$table}";
        $params = [];

        if ($condition) {
            $conditions = [];
            foreach ($condition as $key => $value) {
                $conditions[] = "{$key} = :{$key}";
                $params[":{$key}"] = $value;
            }
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $statement = $this->getDb()->prepare($sql);
        foreach ($params as $key => $value) {
            $statement->bindValue($key, $value);
        }

        $statement->execute();

        $statement->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $statement->fetchAll();
    }

    public function getCountCategory($id = null)
    {


        $sql = "SELECT count(1) FROM goods WHERE cats_id={$id}";
        $statement = $this->getDb()->prepare($sql);
        return var_dump($statement);
    }

    /**
     * @return \PDO
     */
    protected function getDb()
    {
        return Registry::get('db')->getConnection();
    }
}
