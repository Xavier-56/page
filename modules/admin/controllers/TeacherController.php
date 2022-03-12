<?php

namespace app\modules\admin\controllers;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Teacher;
use Yii;

class TeacherController extends Controller{
    public $layout = 'layout1';
    public function actionTeachers(){
        $model = Teacher::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['teacher'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $teachers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('teachers', ['teachers' => $teachers, 'pager' => $pager]);
    }
    public function actionRegister()
    {
        $model = new Teacher();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->register($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            }
        }
        $model->password = '';
        $model->repassword = '';
        return $this->render("register", ['model' => $model]);
    }
    public function actionDelete(){
        try{
            $teacherid = (int)Yii::$app->request->get('teacherid');
            if (empty($teacherid)) {
                throw new \Exception();
            }
            $trans = Yii::$app->db->beginTransaction();
            if ($obj = Teacher::find()->where('teacherid = :id', [':id' => $teacherid])->one()) {
                $res = Teacher::deleteAll('teacherid = :id', [':id' => $teacherid]);
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
        $this->redirect(['teacher/teachers']);
    }
}
