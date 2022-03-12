<?php
/**
 * Created by PhpStorm.
 * User: Xavier
 * Date: 2022/2/13
 * Time: 15:46
 */
namespace app\modules\admin\controllers;

use app\models\Admin;
use yii\web\Controller;
use Yii;
class IndexController extends Controller{
    //关闭布局
    public $layout = false;
    //学生登录
    public function actionLogin(){
        $model = new Admin;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->login($post)){
                $this->redirect(['home/index']);
                Yii::$app->end();
            }
        }
        return $this->render('login',['model'=>$model]);
    }
    public function actionLogout(){
        Yii::$app->session->removeAll();
        if (!isset(Yii::$app->session['admin']['isLogin'])) {
            $this->redirect(['index/login']);
            Yii::$app->end();
        }
        $this->goback();
    }
}