<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\web\UploadedFile;

class Mark extends ActiveRecord{
    /**
     * @var UploadedFile
     */
    public $file;
    public static function tableName(){
        return 'mark';
    }
    public function getPaper(){
        return $this->hasOne(Paper::className(), ['paperid' => 'paperid']);
    }
    public function getTeacher(){
        return $this->hasOne(Teacher::className(), ['teacherid' => 'teacherid']);
    }
    public function getStudent(){
        return $this->hasOne(Student::className(), ['studentid' => 'studentid']);
    }
    public function getDistribute(){
        return $this->hasOne(Distribute::className(), ['paperid' => 'paperid']);
    }
    public function attributeLabels(){
        return[
            'select'=>'论文选题（10）：',
            'summarize'=>'文献综述（10）：',
            'innovation'=>'专业水平（20）：',
            'theory'=>'研究工作（20）：',
            'research'=>'研究成果（20）：',
            'write'=>'论文写作（20）：',
            'total'=>'总分:',
            'isok'=>'结果:',
            'file'=>'上传评分表：',
        ];
    }
    public function rules(){
        return [
            ['paperid','safe'],
            ['select','required', 'message' => '不能为空','on' => ['mark']],
            ['summarize','required', 'message' => '不能为空','on' => ['mark']],
            ['innovation','required', 'message' => '不能为空','on' => ['mark']],
            ['theory','required', 'message' => '不能为空','on' => ['mark']],
            ['research','required', 'message' => '不能为空','on' => ['mark']],
            ['write','required', 'message' => '不能为空','on' => ['mark']],
            [['innovation','theory','research','write'], 'integer','tooBig' => '分值范围0-100','min' =>0, 'max'=>20,'on' => ['mark']],
            [['select','summarize'], 'integer','tooBig' => '分值范围0-100','min' =>0, 'max'=>10,'on' => ['mark']],
            ['total','required','message' => '不能为空','on' => ['upload1','mark']],
            ['isok','safe','on' => ['upload1','mark']],
            [['file'], 'file', 'skipOnEmpty' => false,'on' => ['upload']],
        ];
    }
    public function mark($data){
        $this->scenario = 'mark';
        if ($this->load($data)&&$this->validate()){
            $paperid = (int)Yii::$app->request->get('paperid');
            $this->paperid = $paperid;
            $this->createtime = time();
            $this->teacherid = Teacher::find()->where('username = :user', [':user' => Yii::$app->session['teacher']['username']])->one()->teacherid;
            $this->studentid = Paper::find()->where(['paperid'=>$this->paperid])->one()->studentid;
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }

    public function upload(){
        $this->scenario = 'upload';
        if ($this->validate()) {
            $this->file->saveAs('mark/'.'mark' .time(). '.' . $this->file->extension);
            $this->createtime = time();
            $paperid = (int)Yii::$app->request->get('paperid');
            $this->paperid = $paperid;
            $this->teacherid = Teacher::find()->where('username = :user', [':user' => Yii::$app->session['teacher']['username']])->one()->teacherid;
            $this->studentid = Paper::find()->where(['paperid'=>$this->paperid])->one()->studentid;
            $this->url ='mark/'.'mark'. time(). '.' . $this->file->extension;
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
    public function upload1($data){
        $this->scenario = 'upload1';
        if ($this->load($data)&&$this->validate()){
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
}