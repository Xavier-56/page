<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\web\UploadedFile;

class Template extends ActiveRecord{
    /**
     * @var UploadedFile
     */
    public $file;
    public static function tableName(){
        return 'template';
    }
    public function attributeLabels(){
        return[
            'file'=>'上传模板：',
        ];
    }
    public function rules(){
        return [
            [['file'], 'file', 'skipOnEmpty' => false,'on' => ['upload']],
        ];
    }
    public function upload(){
        $this->scenario = 'upload';
        if ($this->validate()) {
            $this->file->saveAs('template/' . iconv("UTF-8","gb2312",'template'). '.' . $this->file->extension);
            $this->createtime = time();
            $this->title = 'template';
            $this->url ='template/' . 'template'. '.' . $this->file->extension;
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
}