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
                <h3>论文评分</h3>
            </div>

            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?php
                        $form = ActiveForm::begin([
                            'options' => ['class' => 'new_user_form inline-input'],
                            'fieldConfig' => [
                                'template' => '<div class="span12 field-box">{label}{input}</div>{error}'
                            ],
                        ]);
                        ?>
                        <?php echo $form->field($model, 'title')->textInput(['class' => 'span9', 'disabled' => true]); ?>
<!--                        --><?php //echo $form->field($model, 'select')->textInput(['class' => 'span9']); ?>
<!--                        --><?php //echo $form->field($model, 'summarize')->textInput(['class' => 'span9']); ?>
<!--                        --><?php //echo $form->field($model, 'innovation')->textInput(['class' => 'span9']); ?>
<!--                        --><?php //echo $form->field($model, 'theory')->textInput(['class' => 'span9']); ?>
<!--                        --><?php //echo $form->field($model, 'research')->textInput(['class' => 'span9']); ?>
<!--                        --><?php //echo $form->field($model, 'write')->textInput(['class' => 'span9']); ?>
                        选题（10%）：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="span9" type="text"><br><br>
                        综述（5%）：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="span9" type="text"><br><br>
                        成果与新见解（35%）：<input class="span9" type="text"><br><br>
                        理论和专业知识（15%）：<input class="span9" type="text"><br><br>
                        科研能力（25%）：<input class="span9" type="text"><br><br>
                        写作能力（10%）：<input class="span9" type="text"><br><br>

                        <?php
                        if (Yii::$app->session->hasFlash('info')) {
                            echo Yii::$app->session->getFlash('info');
                        }
                        ?>
                        <div class="span11 field-box actions">
                            <?php echo Html::submitButton('提交', ['class' => 'btn-glow primary']); ?>
                            <span>或者</span>
                            <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">

                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        每项得分100分
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

