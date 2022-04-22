<?php
namespace app\modules\admin\controllers;
use app\models\Mark;
use app\models\Paper;
use app\models\Distribute;
use app\models\Teacher;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;
use PHPExcel;
use PHPExcel_IOFactory;
require_once('E:\wamp\www\page\vendor\PHPExcel\PHPExcel.php');
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
    public function actionScores(){
        $model = Mark::find()->joinWith(['paper']);
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['paper'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $scores = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('scores', ['scores' => $scores, 'pager' => $pager]);
    }
    public  function actionExport(){
        $objExcel = new PHPExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
        $objActSheet = $objExcel->getActiveSheet();
        $models = Mark::find()->joinWith('paper')->all();
        $objActSheet->setTitle('评审结果汇总');
        $objActSheet->setCellValue('A1','编号');
        $objActSheet->setCellValue('B1','论文名称');
        $objActSheet->setCellValue('C1','学生');
        $objActSheet->setCellValue('D1','评审教师');
        $objActSheet->setCellValue('E1','论文得分');
        $objActSheet->setCellValue('F1','评审结果');
        $i = 1;
        foreach ( $models as $model ) {
            $i = $i + 1;
            $objExcel->getActiveSheet()->setCellValue('A'.$i,$i-1);
            $objExcel->getActiveSheet()->setCellValue('B'.$i,$model->paper->title);
            $objExcel->getActiveSheet()->setCellValue('C'.$i,$model->student->truename);
            $objExcel->getActiveSheet()->setCellValue('D'.$i,$model->teacher->truename);
            $objExcel->getActiveSheet()->setCellValue('E'.$i,$model->total);
            if ($model->isok == 0):
                $objExcel->getActiveSheet()->setCellValue('F'.$i,'同意答辩');
            elseif ($model->isok == 1):
                $objExcel->getActiveSheet()->setCellValue('F'.$i,'修改后答辩');
            else:
                $objExcel->getActiveSheet()->setCellValue('F'.$i,'不同意答辩');
            endif;
        }
        $objExcel->setActiveSheetIndex(0);
        $objExcel->setActiveSheetIndex();
        header('Content-Type: applicationnd.ms-excel');
        $time=date('Y-m-d');
        header("Content-Disposition: attachment;filename=评审结果汇总$time.xls");
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
}
