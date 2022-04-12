<?php

namespace app\modules\admin\controllers;

use app\models\Comment;
use app\models\Mark;
use app\models\Paper;
use app\models\Distribute;
use app\models\Student;
use app\models\Teacher;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;

class JudgeController extends Controller
{
    public $layout = 'layout1';
    public function actionJudges()
    {
        $model = Mark::find()->joinWith('paper');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['paper'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $judges = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('comments', ['judges' => $judges, 'pager' => $pager]);
    }
}