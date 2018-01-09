<?php
/**
 * Created by PhpStorm.
 * User: a.akulov
 * Date: 13.12.2017
 * Time: 14:23
 */

namespace models;

use components\ActiveRecord;

class Goods extends ActiveRecord
{
    /**
     * @return string
     */
    public function tableName()
    {
        return 'goods';
    }

    public function getCategories()
    {
        return self::findAll();
    }
    public function getCount()
    {
        var_dump($this->getCountCategory(2));
        return self::getCountCategory(2);
    }

}