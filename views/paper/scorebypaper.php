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
            <div style="color: red;font-size: 30px">
                <h style = "color: #0e0e0e">评审结果：</h>
                <?php if ($model->isok == 0):?>
                    同意答辩
                <?php elseif ($model->isok ==1): ?>
                    修改后答辩
                <?php else:?>
                    不同意答辩
                <?php endif; ?>
            </div>
            <br/>
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
                        <?php
                        if (Yii::$app->session->hasFlash('info')) {
                            echo Yii::$app->session->getFlash('info');
                        }
                        ?>
                        <div class="btn-glow primary" style="margin-left: 300px">
                            <a style="color: white" href="<?php echo yii\helpers\Url::to(['paper/downloadbypaper','paperid' => $model->paperid]); ?>">下载得分表</a>
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

