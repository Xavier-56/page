<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<link rel="stylesheet" href="assets/css/compiled/new-user.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>上传论文</h3>
            </div>

            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?php
                        $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' => '<div class="span12 field-box">{label}{input}</div>{error}',
                            ],
                            'options' => [
                                'class' => 'new_user_form inline-input',
                                'enctype' => 'multipart/form-data'
                            ],
                        ]);
                        ?>
                        <?php echo $form->field($model, 'title')->textInput(['class' => 'span9']);?>
                        <?php echo $form->field($model, 'file')->fileInput(['class' => 'span9']);?>
                        <?php
                        if (Yii::$app->session->hasFlash('info')) {
                            echo Yii::$app->session->getFlash('info');
                        }
                        ?>
                        <div class="span11 field-box actions">
                            <?php echo Html::submitButton('修改', ['class' => 'btn-glow primary']); ?>
                            <span>OR</span>
                            <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">

                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        请在左侧表单当中填入论文题目以并上传文件<br/>
                        注意上传的文件为PDF格式
                    </div>
                    <!--                        <h6>重要提示：</h6>-->
                    <!--                        <p>管理员可以管理后台功能模块</p>-->
                    <!--                        <p>请谨慎修改</p>-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end main container -->

