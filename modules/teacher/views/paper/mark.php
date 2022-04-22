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
                        <?php echo $form->field($model1, 'title')->textInput(['class' => 'span9', 'disabled' => true]); ?>
                        <?php echo $form->field($model, 'select')->textInput(['class' => 'span9','id'=>'a','onchange'=>'total()']); ?>
                        <?php echo $form->field($model, 'summarize')->textInput(['class' => 'span9','id'=>'b','onchange'=>'total()']); ?>
                        <?php echo $form->field($model, 'innovation')->textInput(['class' => 'span9','id'=>'c','onchange'=>'total()']); ?>
                        <?php echo $form->field($model, 'theory')->textInput(['class' => 'span9','id'=>'d','onchange'=>'total()']); ?>
                        <?php echo $form->field($model, 'research')->textInput(['class' => 'span9','id'=>'e','onchange'=>'total()']); ?>
                        <?php echo $form->field($model, 'write')->textInput(['class' => 'span9','id'=>'f','onchange'=>'total()']); ?>
                        <?php echo $form->field($model, 'total')->textInput(['class' => 'span9','id'=>'g']); ?>
                        <?php echo $form->field($model, 'isok')->radioList([0=>'同意答辩',1=>'修改后答辩',2=>'不同意答辩'], ['class' => 'span1']);?>
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end main container -->
<script>
    function total() {
        const a = document.getElementById('a').value;
        const b = document.getElementById('b').value;
        const c = document.getElementById('c').value;
        const d = document.getElementById('d').value;
        const e = document.getElementById('e').value;
        const f = document.getElementById('f').value;
        const g = document.getElementById('g');
        g.value = a*0.1+b*0.05+c*0.35+d*0.15+e*0.25+f*0.1;
    }
</script>
