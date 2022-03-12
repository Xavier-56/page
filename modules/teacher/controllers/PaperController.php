<?php
namespace app\modules\teacher\controllers;
use app\models\Distribute;
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
        $model = Paper::find()->where('paperid = :id', [':id' => $paperid])->one();
        return $this->render('mark',['model'=>$model]);
    }
}