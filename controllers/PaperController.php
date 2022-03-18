<?php
namespace app\controllers;
use app\models\Mark;
use app\models\Paper;
use app\models\Student;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use PhpOffice\PhpWord\PhpWord;
class PaperController extends Controller{
    public $layout = 'layout1';
    public function actionIndex(){
        $model = new Paper;
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                Yii::$app->session->setFlash('info', '上传成功');
                $this->redirect(['paper/alreadysubmit']);
            }
        }
        return $this->render('submitpaper', ['model' => $model]);
    }
    public function actionAlreadysubmit(){
        $model = Paper::find()->joinWith('student');
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['paper'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $papers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('alreadysubmit',['papers' => $papers, 'pager' => $pager]);
    }
    public function actionModify(){
        $paperid = (int)Yii::$app->request->get('paperid');
        $model = Paper::find()->where('paperid = :id', [':id' => $paperid])->one();
        if (Yii::$app->request->isPost){
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->modify()){
                Yii::$app->session->setFlash('info','修改成功');
                $this->redirect(['paper/alreadysubmit']);
            }
        }
        return $this->render('modify',['model'=>$model]);
    }
    public function actionScore(){
        $paperid = (int)Yii::$app->request->get('paperid');
        $model1 = Paper::find()->where('paperid = :id', [':id' => $paperid])->one();
        $model = Mark::find()->where('paperid = :id', [':id' => $paperid])->one();
        return $this->render('score',['model'=>$model,'model1'=>$model1]);
    }
    public function actionDownload(){
        $phpword = new PhpWord;
        $template = $phpword->loadTemplate('template/score.docx');
        $model = Student::find()->where('username = :user', [':user' => Yii::$app->session['student']['username']])->one();
        $paperid = (int)Yii::$app->request->get('paperid');
        $model1 = Mark::find()->where('paperid = :id', [':id' => $paperid])->one();
        $model2 = Paper::find()->where('paperid = :id', [':id' => $paperid])->one();
        $template->setValue('${name}', $model->truename);
        $template->setValue('${title}', $model2->title);
        $template->setValue('${select}', $model1->select);
        $template->setValue('${summarize}', $model1->summarize);
        $template->setValue('${innovation}', $model1->innovation);
        $template->setValue('${theory}', $model1->theory);
        $template->setValue('${research}', $model1->research);
        $template->setValue('${write}', $model1->write);
        $template->setValue('${total}', $model1->total);
        $time =date("Y年m月d日 H:i:s ");
        $template->setValue('${time}', $time);
        $time1 = time();
        $filename = 'download/'.$time1.'.docx';
//        $filename=iconv("utf-8","gb2312",$filename);
        $template->saveAs($filename);
        $file = Yii::getAlias('@webroot') . '/'.$filename;
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }
}