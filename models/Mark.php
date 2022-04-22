<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Mark extends ActiveRecord{
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
    public function attributeLabels(){
        return[
            'select'=>'选题（10%）：',
            'summarize'=>'综述（5%）：',
            'innovation'=>'成果与新见解（35%）：',
            'theory'=>'理论和专业知识（15%）：',
            'research'=>'科研能力（25%）：',
            'write'=>'写作能力（10%）：',
            'total'=>'总分:',
            'isok'=>'结果:'
        ];
    }
    public function rules(){
        return [
            ['paperid','safe',],
            ['select','required', 'message' => '不能为空'],
            ['summarize','required', 'message' => '不能为空'],
            ['innovation','required', 'message' => '不能为空'],
            ['theory','required', 'message' => '不能为空'],
            ['research','required', 'message' => '不能为空'],
            ['write','required', 'message' => '不能为空'],
            [['select','summarize','innovation','theory','research','write'], 'integer','message' => '范围0-100','min' =>1, 'max'=>100],
            ['total','safe'],
            ['isok','safe']
        ];
    }
    public function mark($data){
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
}