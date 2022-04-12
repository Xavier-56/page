<?php
namespace app\controllers;
use app\models\Comment;
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
        $this->redirect(['paper/alreadysubmit']);
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
        $srcfilename =Yii::getAlias('@webroot') . '/download/'.$time1.'.docx';
        $destfilename =Yii::getAlias('@webroot') . '/download/'.$time1.'.pdf';
        $this->doc_to_pdf($srcfilename,$destfilename);
//        $file = Yii::getAlias('@webroot') . '/download/'.$destfilename;
        $file = $destfilename;
        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
    }
    public function doc_to_pdf($srcfilename,$destfilename) {
        try {
            if(!file_exists($srcfilename)){
                return;
            }
            $word = new \COM("word.application") or die("Can't start Word!");
            $word->Visible=0;
            $word->Documents->Open($srcfilename, false, false, false, "1", "1", true);
            $word->ActiveDocument->final = false;
            $word->ActiveDocument->Saved = true;
            $word->ActiveDocument->ExportAsFixedFormat($destfilename, 17, false, 0, 3, 1, 5000, 7, true, true, 1);
            $word->ActiveDocument->Close();
            $word->Quit();
        } catch (\Exception $e) {
            if (method_exists($word, "Quit")){
                $word->Quit();
            }
            return;
        }
    }
    public function actionComment(){
        $model = new Comment;
        $post = Yii::$app->request->post();
        $model->comment($post);
        $paperid = (int)Yii::$app->request->get('paperid');
        $comments = Comment::find()->where('paperid = :id', [':id' => $paperid])->all();
        return $this->render('comment', ['model' => $model,'comments'=>$comments]);
    }
}