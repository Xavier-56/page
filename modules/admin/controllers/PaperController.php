<?php
namespace app\modules\admin\controllers;
use app\models\Paper;
use app\models\Distribute;
use app\models\Teacher;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;

class PaperController extends Controller{
    public $layout = 'layout1';
    public function actionPapers(){
        $model = Paper::find()->joinWith('student');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['paper'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $papers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('papers',['papers' => $papers, 'pager' => $pager]);
    }
    public function actionDownload(){
        $paperid = (int)Yii::$app->request->get('paperid');
        $title = Paper::find()->where('paperid = :id', [':id' => $paperid])->one()->url;
        $file = Yii::getAlias('@webroot') . '/' .$title;
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }
    public function actionDistribute(){
        $model = new Distribute;
        $paperid = (int)Yii::$app->request->get('paperid');
        $model->paperid = $paperid;
        $teacher = Teacher::find()->select(['teacherid'])->asArray()->all();
        foreach ($teacher as $key=>$v){
            $ids[]=$v['teacherid'];
        }
        $rand_keys = array_rand($ids,1);
        $model->teacherid = $ids[$rand_keys];
        $model->save();
        Paper::updateAll(['status' => 2], 'paperid = :id', [':id' => $paperid]);
        $this->redirect(['paper/papers']);
        Yii::$app->session->setFlash('info', '分配成功');
    }
    public function actionDelete(){
        try{
            $paperid = (int)Yii::$app->request->get('paperid');
            if (empty($paperid)) {
                throw new \Exception();
            }
            $trans = Yii::$app->db->beginTransaction();
            if ($obj = Paper::find()->where('paperid = :id', [':id' => $paperid])->one()) {
                $res = Paper::deleteAll('paperid = :id', [':id' => $paperid]);
                if (empty($res)) {
                    throw new \Exception();
                }
            }
            $trans->commit();
        } catch(\Exception $e) {
            if (Yii::$app->db->getTransaction()) {
                $trans->rollback();
            }
        }
        $this->redirect(['paper/papers']);
    }
}
