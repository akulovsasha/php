<?php
/**
 * Created by PhpStorm.
 * User: a.akulov
 * Date: 14.12.2017
 * Time: 9:13
 */

namespace controllers;

use helpers\Request;
use InvalidArgumentException;
use models\Category;
use components\Controller;
use models\Goods;

/**
 * Class GoodsController
 * @package controllers
 */
class GoodsController extends Controller
{
    public function actionCreate()
    {
        if (Request::getIsPostRequest()) {
            $model = new Goods();
            $model->load(Request::post());

            $model->save();

            $this->redirect('/categories/list');
        }

        return $this->render('categories/create');
    }

    public function actionDelete()
    {

        $id = Request::get('id');
        if (empty($id)) {
            throw new InvalidArgumentException("Required argument is not defined");
        }

        $model = new Goods();
        $model->findOne($id);
        $model->delete();
        $this->redirect('/categories/list');

    }
}