<?php
namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;
use yii\web\UploadedFile;
class Paper extends ActiveRecord {
    /**
     * @var UploadedFile
     */
    public $file;
    public static function tableName(){
        return 'paper';
    }
    public function attributeLabels(){
        return[
            'title'=>'论文题目：',
            'file'=>'上传文件：',
        ];
    }
    public function getDistribute(){
        return $this->hasOne(Distribute::className(), ['paperid' => 'paperid']);
    }
    public function rules(){
        return [
            ['title', 'required', 'message' => '论文题目不能为空','on' => ['upload1']],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf','on' => ['upload','modify']],
        ];
    }

    public function upload(){
        $this->scenario = 'upload';
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . iconv("UTF-8","gb2312",$this->file->baseName). '.' . $this->file->extension);
            $this->createtime = time();
            $this->studentid  = Student::find()->where('username = :user', [':user' => Yii::$app->session['student']['username']])->one()->studentid;
            $this->url ='uploads/' . $this->file->baseName . '.' . $this->file->extension;
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

    public function getStudent(){
        return $this->hasOne(Student::className(), ['studentid' => 'studentid']);
    }
    public function modify(){
        $this->scenario = 'modify';
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            $this->createtime = time();
            $this->studentid  = Student::find()->where('username = :user', [':user' => Yii::$app->session['student']['username']])->one()->studentid;
            $this->url ='uploads/' . $this->file->baseName . '.' . $this->file->extension;
            return (bool)$this->updateAll(['title'=>$this->title,'createtime'=>$this->createtime,'url'=>$this->url], 'studentid = :id', [':id' => $this->studentid]);
        }
        return false;
    }
}