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
    public function attributeLabels(){
        return[
            'content'=>'留言：',
        ];
    }
    public function rules(){
        return [
            ['content', 'required','message'=>'留言不能为空', 'on' => ['comment']],
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