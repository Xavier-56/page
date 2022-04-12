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
    public function attributeLabels(){
        return[
            'select'=>'选题（10%）：',
            'summarize'=>'综述（5%）：',
            'innovation'=>'成果与新见解（35%）：',
            'theory'=>'理论和专业知识（15%）：',
            'research'=>'科研能力（25%）：',
            'write'=>'写作能力（10%）：',
            'total'=>'总分:'
        ];
    }
    public function rules(){
        return [
            ['paperid','safe'],
            ['select','safe'],
            ['summarize','safe'],
            ['innovation','safe'],
            ['theory','safe'],
            ['research','safe'],
            ['write','safe'],
            ['total','safe']
        ];
    }
    public function mark($data){
        if ($this->load($data)&&$this->validate()){
            $paperid = (int)Yii::$app->request->get('paperid');
            $this->paperid = $paperid;
            $this->createtime = time();
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
}