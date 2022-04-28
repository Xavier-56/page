<link rel="stylesheet" href="assets/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>已提交论文</h3>
                <!--                <div class="span10 pull-right">-->
                <!--                    <a href="--><?php //echo yii\helpers\Url::to(['teacher/register']) ?><!--" class="btn-flat success pull-right">-->
                <!--                        <span>&#43;</span>-->
                <!--                        添加新教师-->
                <!--                    </a>-->
                <!--                </div>-->
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <!--                        <th class="span3 sortable">-->
                        <!--                            <span class="line"></span>用户名-->
                        <!--                        </th>-->
                        <th class="span3 sortable">
                            <span class="line"></span>论文名称
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>提交时间
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>状态
                        </th>
                        <th class="span3 sortable align-right">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php foreach($papers as $paper): ?>
                        <tr class="first">
<!--                                                        <td>-->
<!--                                                            --><?php //if (empty($teacher->avatar)): ?>
<!--                                                                <img src="--><?php //echo Yii::$app->params['defaultValue']['avatar']; ?><!--" class="img-circle avatar hidden-phone" />-->
<!--                                                            --><?php //else: ?>
<!--                                                                <img src="assets/uploads/avatar/--><?php //echo $teacher->avatar; ?><!--" class="img-circle avatar hidden-phone" />-->
<!--                                                            --><?php //endif; ?>
<!--                                                            <a href="#" class="name">--><?php //echo $teacher->username; ?><!--</a>-->
<!--                                                            <span class="subtext">--><?php //echo $teacher->email; ?><!--</span>-->
<!--                                                        </td>-->
                            <td>
                                <?php echo isset($paper->title) ? $paper->title : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo date("Y-m-d H:i:s", $paper->createtime); ?>
                            </td>
                            <td>
                                <?php if ($paper->status == 1):?>
                                    <span class="label label-success">已打分</span>
                                <?php elseif ($paper->status ==2): ?>
                                    <span class="label label-danger">已分配</span>
                                <?php else:?>
                                    <span class="label label-important">未分配</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-right">
                                <?php if ($paper->status == 1):?>
                                     <?php if ($paper->distribute->mode == 0):?>
                                        <a href="<?php echo yii\helpers\Url::to(['paper/score', 'paperid' => $paper->paperid]); ?>">查看得分</a>
                                     <?php else:?>
                                        <a href="<?php echo yii\helpers\Url::to(['paper/scorebypaper', 'paperid' => $paper->paperid]); ?>">查看得分</a>
                                    <?php endif; ?>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/comment', 'paperid' => $paper->paperid]); ?>">留言</a>
                                <?php elseif ($paper->status ==2): ?>
                                    等待评审
                                <?php else:?>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/modify', 'paperid' => $paper->paperid]); ?>">修改</a>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/delete', 'paperid' => $paper->paperid]); ?>">删除</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                    if (Yii::$app->session->hasFlash('info')) {
                        echo Yii::$app->session->getFlash('info');
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination pull-right">
                <?php echo yii\widgets\LinkPager::widget([
                    'pagination' => $pager,
                    'prevPageLabel' => '&#8249;',
                    'nextPageLabel' => '&#8250;',
                ]); ?>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
<!-- end main container -->
