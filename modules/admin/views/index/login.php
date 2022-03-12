<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>研究生论文送审系统（管理员）</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="assets/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="assets/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/lib/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/compiled/signup.css" type="text/css" media="screen" />
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<div class="header">
        <h2 style="color: white;margin-left: 38%">研究生论文送审系统(管理员)</h2>
</div>
<?php $form = ActiveForm::begin([
    'fieldConfig'=>[
        'template'=>'{input}{error}',
    ]
])?>
<div class="row-fluid login-wrapper">
    <div class="box">
        <div class="content-wrap">
            <h6>登录</h6>
            <?php echo $form->field($model,'adminusername')->textInput(['class'=>'span12','placeholder'=>'用户名']);?>
            <?php echo $form->field($model,'adminpassword')->passwordInput(['class'=>'span12','placeholder'=>'密码']);?>
            <div class="action">
                <?php echo Html::submitButton('登录',['class'=>"btn-glow primary login"]);?>
            </div>
        </div>
    </div>
</div>
<?php $form = ActiveForm::end()?>

<!-- scripts -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/theme.js"></script>

</body>
</html>