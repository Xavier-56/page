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
}