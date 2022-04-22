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
        $mark0 = Mark::find()->where(['isok'=>0])->count();
        $mark1 = Mark::find()->where(['isok'=>1])->count();
        $mark2 = Mark::find()->where(['isok'=>2])->count();
        if ($mark!=0){
            $per0 = $mark0/$mark*100;
            $per1 = $mark1/$mark*100;
            $per2 = $mark2/$mark*100;
        }else{
            $per0=0;
            $per1=0;
            $per2=0;
        }
        return $this->render('stats',[
            'paper' => $paper,
            'distribute' => $distribute,
            'mark'=>$mark,
            'papertoday'=>$papertoday,
            'paperyesterday'=>$paperyesterday,
            'paperbeforeyesterday'=>$paperbeforeyestrday,
            'mark0'=>$mark0,
            'mark1'=>$mark1,
            'mark2'=>$mark2,
            'per0'=>$per0,
            'per1'=>$per1,
            'per2'=>$per2,
        ]);
    }
}