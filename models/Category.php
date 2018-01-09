<?php

namespace models;

use components\ActiveRecord;

/**
 * Class Category
 * @package models
 *
 * @property integer $id
 * @property string $title
 * @property string $created_at
 */
class Category extends ActiveRecord
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'categories';
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return self::findAll();
    }

    /**
     * @return integer $count
     */
    public function getCount()
    {
        return self::getCount();
    }

    /**
     * @return string
     */
    public function getPreparedDate()
    {
        return (new \DateTime($this->created_at))->format('d M Y');
    }
}