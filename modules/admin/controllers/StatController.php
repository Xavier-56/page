<?php
namespace app\modules\admin\controllers;

use app\models\Admin;
use app\models\Distribute;
use app\models\Mark;
use app\models\Paper;
use yii\web\Controller;
use Yii;

class StatController extends Controller{
    public function actionStats(){
        $this->layout='layout1';
        $paper = Paper::find()->count();
        $distribute = Distribute::find()->count();
        $mark = Mark::find()->count();
        $papertoday = Paper::find()->where('createtime between :time1 and :time2', [':time1'=>time()-24*60*60,':time2'=>time()])->count();
        $paperyesterday = Paper::find()->where('createtime between :time1 and :time2', [':time1'=>time()-24*60*60*2,':time2'=>time()-24*60*60])->count();
        $paperbeforeyestrday = Paper::find()->where('createtime between :time1 and :time2', [':time1'=>time()-24*60*60*3,':time2'=>time()-24*60*60*2])->count();
        return $this->render('stats',[
            'paper' => $paper,
            'distribute' => $distribute,
            'mark'=>$mark,
            'papertoday'=>$papertoday,
            'paperyesterday'=>$paperyesterday,
            'paperbeforeyesterday'=>$paperbeforeyestrday
        ]);
    }
}