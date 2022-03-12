<?php
/**
 * Created by PhpStorm.
 * User: Xavier
 * Date: 2022/2/13
 * Time: 15:46
 */
namespace app\modules\teacher\controllers;

use app\models\Teacher;
use yii\web\Controller;
use Yii;
class IndexController extends Controller{
    //关闭布局
    public $layout = false;
    //学生登录
    public function actionLogin(){
        $model = new Teacher;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->login($post)){
                $this->redirect(['home/index']);
                Yii::$app->end();
            }
        }
        return $this->render('login',['model'=>$model]);
    }
    //学生注册
    public function actionRegister(){
        $model = new Teacher;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->register($post)){
                Yii::$app->session->setFlash('info','注册成功');
            }else{
                Yii::$app->session->setFlash('info','注册失败');
            }
        }
        $model->password = '';
        $model->repassword = '';
        return $this->render('register',['model'=>$model]);
    }
    //找回密码
    public function actionSeekpassword(){
        $model = new Teacher;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->seekPass($post)) {
                Yii::$app->session->setFlash('info', '电子邮件已经发送成功，请查收');
            }
        }
        return $this->render('seekpassword',['model'=>$model]);
    }
    //修改密码
    public function actionMailchangepass(){
        $time = Yii::$app->request->get('timestamp');
        $username = Yii::$app->request->get("username");
        $token = Yii::$app->request->get("token");
        $model = new Teacher;
        $myToken = $model->createToken($username,$time);
        if ($token != $myToken){
            $this->redirect(['login']);
            Yii::$app->end();
        }
        if (time()-$time > 300){
            $this->redirect(['login']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->changePass($post)){
                Yii::$app->session->setFlash('info','密码修改成功');
            }
        }
        $model->username = $username;
        return $this->render('mailchangepass',['model'=>$model]);
    }
    //注销
    public function actionLogout(){
        Yii::$app->session->removeAll();
        if (!isset(Yii::$app->session['teacher']['isLogin'])) {
            $this->redirect(['index/login']);
            Yii::$app->end();
        }
        $this->goback();
    }
}