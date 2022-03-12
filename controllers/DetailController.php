<?php
/**
 * Created by PhpStorm.
 * User: Xavier
 * Date: 2022/2/15
 * Time: 10:37
 */
namespace app\controllers;

use app\models\Student;
use yii\web\Controller;
use Yii;
class DetailController extends Controller{
    public $layout = 'layout1';
    public function actionChangedetails(){
        $model = Student::find()->where('username = :user', [':user' => Yii::$app->session['student']['username']])->one();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->changeDetail($post)){
                Yii::$app->session->setFlash('info','修改成功');
            }
        }
        $model->password= '';
        return $this->render('changedetails',['model'=>$model]);
    }
    public function actionChangepass()
    {
        $model = Student::find()->where('username = :user', [':user' => Yii::$app->session['student']['username']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changePass($post)) {
                Yii::$app->session->setFlash('info', '修改成功');
            }
        }
        $model->password = '';
        $model->repassword = '';
        return $this->render('changepass', ['model' => $model]);
    }
}