<?php

namespace app\modules\admin\controllers;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Student;
use Yii;

class StudentController extends Controller{
    public $layout = 'layout1';
    public function actionStudents(){
        $model = Student::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['student'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $students = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('students', ['students' => $students, 'pager' => $pager]);
    }
    public function actionRegister()
    {
        $model = new Student;
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
            $studentid = (int)Yii::$app->request->get('studentid');
            if (empty($userid)) {
                throw new \Exception();
            }
            $trans = Yii::$app->db->beginTransaction();
            if ($obj = Student::find()->where('studentid = :id', [':id' => $studentid])->one()) {
                $res = Student::deleteAll('studentid = :id', [':id' => $studentid]);
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
        $this->redirect(['student/students']);
    }
}
