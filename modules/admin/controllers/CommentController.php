<?php

namespace app\modules\admin\controllers;

use app\models\Comment;
use app\models\Paper;
use app\models\Distribute;
use app\models\Teacher;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;

class CommentController extends Controller
{
    public $layout = 'layout1';
    public function actionComments()
    {
        $model = Comment::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['paper'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $comments = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('comments', ['comments' => $comments, 'pager' => $pager]);
    }
}