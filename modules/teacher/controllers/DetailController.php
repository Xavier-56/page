<?php
/**
 * Created by PhpStorm.
 * User: Xavier
 * Date: 2022/2/15
 * Time: 10:37
 */
namespace app\modules\teacher\controllers;

use app\models\Teacher;
use yii\web\Controller;
use Yii;
class DetailController extends Controller{
    public $layout = 'layout1';
    public function actionChangedetails(){
        $model = Teacher::find()->where('username = :user', [':user' => Yii::$app->session['teacher']['username']])->one();
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
        $model = Teacher::find()->where('username = :user', [':user' => Yii::$app->session['teacher']['username']])->one();
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