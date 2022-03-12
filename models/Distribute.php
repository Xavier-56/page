<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Distribute extends ActiveRecord{
    public static function tableName(){
        return 'distribute';
    }
    public function getPaper(){
        return $this->hasOne(Paper::className(), ['paperid' => 'paperid']);
    }
}