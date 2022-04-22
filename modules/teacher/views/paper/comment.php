<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="info-bar clearfix">
    <div class="content-wrap clearfix">
        <div class="content">
            <div id="course_note">
                <ul class="mod-post" id="comment-list">
                    <?php foreach($comments as $comment): ?>
                        <li class="post-row">
                            <div class="media">
                            <span target="_blank">
                                <?php if (empty($comment->avatar)): ?>
                                    <img src="<?php echo Yii::$app->params['defaultValue']['avatar']; ?>" class="img-circle avatar hidden-phone" />
                                <?php else: ?>
                                    <img src="assets/uploads/avatar/<?php echo $comment->avatar; ?>" class="img-circle avatar hidden-phone" />
                                <?php endif; ?>
                            </span>
                            </div>
                            <div class="bd">
                                <p class="cnt"><?= Html::encode($comment->content); ?></p>
                                <div class="footer clearfix">
                                    <span title="创建时间" class="l timeago">留言时间：<?php echo date("Y-m-d H:i", $comment->createtime); ?></span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--发布评论-->
            <div id="js-pub-container" class="issques clearfix js-form" style="margin-left: 40px;">
                <div class="wgt-ipt-wrap pub-editor-wrap " id="js-pl-input-fake">
                    <?php $form = ActiveForm::begin();
                    echo $form->field($model,'content')->textarea(['id' => 'js-pl-textarea','placeholder'=>'发表留言吧']);
                    ?>
                </div>
                <br>
                <?php echo Html::submitButton('发表留言', ['class' => 'btn-glow primary']); ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>