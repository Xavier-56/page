<?php
namespace app\controllers;
use app\models\Paper;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class PaperController extends Controller{
    public $layout = 'layout1';
    public function actionIndex(){
        $model = new Paper;
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                Yii::$app->session->setFlash('info', '上传成功');
                $this->redirect(['paper/alreadysubmit']);
            }
        }
        return $this->render('submitpaper', ['model' => $model]);
    }
    public function actionAlreadysubmit(){
        $model = Paper::find()->joinWith('student');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['paper'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $papers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('alreadysubmit',['papers' => $papers, 'pager' => $pager]);
    }
    public function actionModify(){
        $paperid = (int)Yii::$app->request->get('paperid');
        $model = Paper::find()->where('paperid = :id', [':id' => $paperid])->one();
        if (Yii::$app->request->isPost){
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->modify()){
                Yii::$app->session->setFlash('info','修改成功');
                $this->redirect(['paper/alreadysubmit']);
            }
        }
        return $this->render('modify',['model'=>$model]);
    }
}