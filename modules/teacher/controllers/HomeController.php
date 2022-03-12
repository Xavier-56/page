<?php
/**
 * Created by PhpStorm.
 * User: Xavier
 * Date: 2022/2/14
 * Time: 9:07
 */
namespace app\modules\teacher\controllers;

use yii\web\Controller;

class HomeController extends Controller{
    public function actionIndex(){
        $this->layout='layout1';
        return $this->render('index');
    }
}