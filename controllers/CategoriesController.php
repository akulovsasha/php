<?php

namespace controllers;

use helpers\Request;
use InvalidArgumentException;
use models\Category;
use components\Controller;
use models\Goods;

/**
 * Class CategoriesController
 * @package controllers
 */
class CategoriesController extends Controller
{
    public function actionList()
    {
        $categories = new Category();
        $goods = new Goods();
        return $this->render('categories/list', [
            'categories' => $categories->getCategories(),
            'goods' => $goods->getCategories()
        ]);
    }

    /**
     * @return string
     */
    public function actionCreate()
    {
        if (Request::getIsPostRequest()) {
            $model = new Category();
           // $goods = new Goods();
            $model->load(Request::post());
           // $goods->load(Request::post());
            $model->save();

            $this->redirect('/categories/list');
        }

        return $this->render('categories/create');
    }

    public function actionUpdate()
    {
        $id = Request::get('id');
        if (empty($id)) {
            throw new InvalidArgumentException("Required argument is not defined");
        }

        $model = new Category();
        $model->findOne($id);

        if (Request::getIsPostRequest()) {
            $model->load(Request::post());
            $model->save();

            $this->redirect('/categories/list');
        }

        return $this->render('categories/update', ['category' => $model]);
    }

    public function actionDelete()
    {
        $id = Request::get('id');
        if (empty($id)) {
            throw new InvalidArgumentException("Required argument is not defined");
        }

        $model = new Category();
        $model->findOne($id);
        $model->delete();

        $this->redirect('/categories/list');
    }
    public function actionCancel()
    {
        $this->redirect('/categories/list');
    }
}
