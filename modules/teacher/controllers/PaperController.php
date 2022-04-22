<?php
namespace app\modules\teacher\controllers;
use app\models\Comment;
use app\models\Distribute;
use app\models\Mark;
use app\models\Paper;
use app\models\Teacher;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;

class PaperController extends Controller{
    public $layout = 'layout1';
    public function actionPapers(){
        $teacherid =Teacher::find()->where('username = :user', [':user' => Yii::$app->session['teacher']['username']])->one()->teacherid;
        $model = Distribute::find()->where('teacherid = :id', [':id' => $teacherid])->joinWith('paper');
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
        Paper::updateAll(['status' => 1], 'paperid = :id', [':id' => $paperid]);
        return $this->render('mark',['model'=>$model,'model1'=>$model1]);
    }
    public function actionComment(){
        $model = new Comment;
        $post = Yii::$app->request->post();
        $model->comment($post);
        $model->author = Teacher::find()->where('username = :user', [':user' => Yii::$app->session['teacher']['username']])->one()->truename;
        $model->save();
        $paperid = (int)Yii::$app->request->get('paperid');
        $comments = Comment::find()->where('paperid = :id', [':id' => $paperid])->all();
        return $this->render('comment', ['model' => $model,'comments'=>$comments]);
    }
}