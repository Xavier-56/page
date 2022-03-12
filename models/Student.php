<?php
/**
 * Created by PhpStorm.
 * User: Xavier
 * Date: 2022/2/13
 * Time: 16:16
 */
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Student extends ActiveRecord{
    public $repassword;
    public static function tableName(){
        return 'student';
    }
    public function attributeLabels(){
        return[
            'username'=>'用户名：',
            'studentno'=>'学号：',
            'truename'=>'真实姓名：',
            'email'=>'邮箱：',
            'password'=>'密码：',
            'repassword'=>'确认密码：',
            'grade'=>'年级：',
            'major'=>'专业：'
        ];
    }
    public function rules(){
        return [
            ['username', 'required', 'message' => '用户名不能为空', 'on' => ['register','login','seekpass','changepass','changedetail']],
            ['username', 'unique', 'message' => '用户已经被注册', 'on' => ['register']],
            ['email', 'required', 'message' => '电子邮件不能为空', 'on' => ['register','seekpass','changedetail']],
            ['email', 'email', 'message' => '电子邮件格式不正确', 'on' => ['register','seekpass','changedetail']],
            ['email', 'unique', 'message' => '电子邮件已被注册', 'on' => ['register','changedetail']],
            ['studentno', 'required', 'message' => '学号不能为空', 'on' => ['register','changedetail']],
            ['truename', 'required', 'message' => '真实姓名不能为空', 'on' => ['register','changedetail']],
            ['major', 'required', 'message' => '专业不能为空', 'on' => ['register','changedetail']],
            ['password', 'required', 'message' => '用户密码不能为空', 'on' => ['register', 'login','changepass','changedetail']],
            ['repassword', 'required', 'message' => '确认密码不能为空', 'on' => ['register','changepass']],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码输入不一致', 'on' => ['register','changepass']],
            ['password', 'validatePass', 'on' => ['login','changedetail']],
        ];
    }
    public function register($data){
        $this->scenario = 'register';
        if ($this->load($data)&&$this->validate()){
//            $this->grade = $this->
            $this->createtime = time();
            $this->password = md5($this->password);
            if ($this->save(false)){
                return true;
            }
            return false;
        }
        return false;
    }
    public function validatePass(){
        if (!$this->hasErrors()) {
            $data = self::find()->where('username = :user and password = :pass', [":user" => $this->username, ":pass" => md5($this->password)])->one();
            if (is_null($data)) {
                $this->addError("password", "用户名或者密码错误");
            }
        }
    }
    public function login($data){
        $this->scenario='login';
        if ($this->load($data) && $this->validate()) {
            $session = Yii::$app->session;
            $session['student'] = [
                'username' => $this->username,
                'studentid'=>22,
                'isLogin' => 1,
            ];
            return (bool)$session['student']['isLogin'];
        }
        return false;
    }
    public function seekPass($data){
        $this->scenario='seekpass';
        if ($this->load($data) && $this->validate()) {
            $time = time();
            $token = $this->createToken($data['Student']['username'], $time);
            $mailer = Yii::$app->mailer->compose('seekpass', ['username' => $data['Student']['username'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("xavierzy@163.com");
            $mailer->setTo($data['Student']['email']);
            $mailer->setSubject("研究生论文送审系统--找回密码");
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    }
    public function createToken($username, $time){
        return md5(md5($username).base64_encode(Yii::$app->request->userIP).md5($time));
    }
    public function changePass($data){
        $this->scenario = 'changepass';
        if ($this->load($data)&&$this->validate()){
            return(bool)$this->updateAll(['password'=>md5($this->password)],'username= :user',[':user'=>$this->username]);
        }
        return false;
    }
    public function changeDetail($data){
        $this->scenario = 'changedetail';
        if ($this->load($data) && $this->validate()){
            return (bool)$this->updateAll(['studentno'=>$this->studentno,'truename'=>$this->truename,'grade'=>$this->grade,'major'=>$this->major,'email'=>$this->email], 'username = :user', [':user' => $this->username]);
        }
    }
}