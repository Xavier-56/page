<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>研究生论文送审系统（学生）</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="assets/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/lib/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/compiled/signup.css" type="text/css" media="screen" />
<!--    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />-->
<!--    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<div class="header">
    <h2 style="color: white;margin-left: 38%">研究生论文送审系统(学生)</h2>
</div>
<?php
    $form = ActiveForm::begin([
    'fieldConfig'=>[
        'template'=>'{input}{error}',
    ]
])?>
<div class="row-fluid login-wrapper">
    <div class="box">
        <div class="content-wrap">
            <h6>注册</h6>
            <?php echo $form->field($model,'username')->textInput(['class'=>'span12','placeholder'=>'用户名']);?>
            <?php echo $form->field($model,'studentno')->textInput(['class'=>'span12','placeholder'=>'学号']);?>
            <?php echo $form->field($model,'truename')->textInput(['class'=>'span12','placeholder'=>'真实姓名']);?>
            <?php echo $form->field($model, 'grade')->dropDownList([0=>'2018',1=>'2019'],['prompt'=>'请选择年级','class'=>'span12','style'=>'margin-bottom:10px;border:1px solid #B2BFC7;height:10px;height:20px;']) ?>
            <?php echo $form->field($model,'major')->textInput(['class'=>'span12','placeholder'=>'专业']);?>
            <?php echo $form->field($model,'email')->textInput(['class'=>'span12','placeholder'=>'邮箱']);?>
            <?php echo $form->field($model,'password')->passwordInput(['class'=>'span12','placeholder'=>'密码']);?>
            <?php echo $form->field($model,'repassword')->passwordInput(['class'=>'span12','placeholder'=>'确认密码']);?>
            <?php
                if (Yii::$app->session->hasFlash('info')) {
                    echo Yii::$app->session->getFlash('info');
                }
             ?>
            <div class="action">
                <?php echo Html::submitButton('注册',['class'=>"btn-glow primary login"]);?>
            </div>
        </div>
    </div>
    <div class="span4 already">
        <p>已拥有账户</p>
        <a style="color: #0e90d2;"href="<?php echo yii\helpers\Url::to(['index/login'])?>">登录</a>
    </div>
</div>
<?php $form = ActiveForm::end()?>
<!-- scripts -->
<script src="assets/js/jquery-latest.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/theme.js"></script>

</body>
</html>