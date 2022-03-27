<?php
use yii\bootstrap\ActiveForm;
?>
<link rel="stylesheet" href="assets/css/compiled/new-user.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>论文得分</h3>
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
                        <?php echo $form->field($model1, 'title')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'total')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'select')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'summarize')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'innovation')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'theory')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'research')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'write')->textInput(['class' => 'span9', 'disabled' => true]); ?>

                        <?php
                        if (Yii::$app->session->hasFlash('info')) {
                            echo Yii::$app->session->getFlash('info');
                        }
                        ?>
                        <div class="btn-glow primary" style="margin-left: 300px">
                            <a style="color: white" href="<?php echo yii\helpers\Url::to(['paper/download','paperid' => $model->paperid]); ?>">下载得分表</a>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end main container -->

