<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Comment extends ActiveRecord{
    public static function tableName(){
        return 'comment';
    }
    public function getPaper(){
        return $this->hasOne(Paper::className(), ['paperid' => 'paperid']);
    }
//    public function getDistribute(){
//        return $this->hasOne(Paper::className(), ['paperid' => 'paperid']);
//    }
//    public function getStudent(){
//        return $this->hasOne(Paper::className(), ['studentid' => 'studentid']);
//    }
//    public function getTeacher(){
//        return $this->hasOne(Paper::className(), ['teacherid' => 'teacherid']);
//    }
    public function attributeLabels(){
        return[
            'content'=>'留言：',
        ];
    }
    public function rules(){
        return [
            ['content', 'required', 'on' => ['comment']],
        ];
    }
    public function comment($data){
        $this->scenario = 'comment';
        if ($this->load($data)&&$this->validate()){
            $this->createtime = time();
            $paperid = (int)Yii::$app->request->get('paperid');
            $this->paperid = $paperid;
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
}