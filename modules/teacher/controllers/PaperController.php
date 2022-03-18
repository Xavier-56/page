<?php
namespace app\modules\teacher\controllers;
use app\models\Distribute;
use app\models\Mark;
use app\models\Paper;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;

class PaperController extends Controller{
    public $layout = 'layout1';
    public function actionPapers(){
        $model = Distribute::find()->joinWith('paper');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['paper'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $distributes = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('papers', ['distributes' => $distributes, 'pager' => $pager]);
    }
    public function actionDownload(){
        $paperid = (int)Yii::$app->request->get('paperid');
        $title = Paper::find()->where('paperid = :id', [':id' => $paperid])->one()->url;
        $file = Yii::getAlias('@webroot') . '/' .$title;
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }
    public function actionMark(){
        $paperid = (int)Yii::$app->request->get('paperid');
        $model1 = Paper::find()->where('paperid = :id', [':id' => $paperid])->one();
        $model = new Mark;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->mark($post)){
                Yii::$app->session->setFlash('info','评分成功');
            }else{
                Yii::$app->session->setFlash('info','评分失败');
            }
        }
        return $this->render('mark',['model'=>$model,'model1'=>$model1]);
    }
}