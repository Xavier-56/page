<?php
namespace app\modules\admin\controllers;

use app\models\Template;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class TemplateController extends Controller{
    public $layout = 'layout1';
    public function actionTemplate(){
        $count = Template::find()->count();
        if($count==1){
            $model = Template::find()->one();
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                Yii::$app->session->setFlash('info', '上传成功');
                $this->redirect(['template/template']);
            }
        }
        else{
            $model = new Template;
            if (Yii::$app->request->isPost) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->upload()) {
                    Yii::$app->session->setFlash('info', '上传成功');
                    $this->redirect(['template/template']);
                }
            }
        }
        return $this->render('template', ['model' => $model,'count'=>$count]);
    }
    public function actionDownload(){
        $title = Template::find()->one()->url;
        $file = Yii::getAlias('@webroot') . '/' .$title;
        Yii::$app->response->sendFile($file);
    }
}