<?php

namespace controllers;

use components\Controller;

/**
 * Class IndexController
 * @package controllers
 */
class IndexController extends Controller
{
    function actionIndex()
    {
        return $this->render('index/index', [
            'qwerty' => 'Some text there',
            'name' => 'Akulov Sasha'
        ]);
    }

    function actionList()
    {
        return renderTemplate('index/list');
    }
}
