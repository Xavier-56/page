<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Admin extends ActiveRecord{
    public static function tableName(){
        return 'admin';
    }
    public function attributeLabels(){
        return[
            'adminusername'=>'用户名：',
            'adminpassword'=>'密码：',
        ];
    }
    public function rules(){
        return [
            ['adminusername', 'required', 'message' => '用户名不能为空', 'on' => ['login']],
            ['adminpassword', 'required', 'message' => '用户密码不能为空', 'on' => ['login']],
            ['adminpassword', 'validatePass', 'on' => ['login']],
        ];
    }
    public function login($data){
        $this->scenario='login';
        if ($this->load($data) && $this->validate()) {
            $session = Yii::$app->session;
            $session['admin'] = [
                'adminusername' => $this->adminusername,
                'isLogin' => 1,
            ];
            return (bool)$session['admin']['isLogin'];
        }
        return false;
    }
    public function validatePass(){
        if (!$this->hasErrors()) {
            $data = self::find()->where('adminusername = :user and adminpassword = :pass', [":user" => $this->adminusername, ":pass" => md5($this->adminpassword)])->one();
            if (is_null($data)) {
                $this->addError("adminpassword", "用户名或者密码错误");
            }
        }
    }
}