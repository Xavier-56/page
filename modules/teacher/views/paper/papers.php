<link rel="stylesheet" href="assets/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>论文列表</h3>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
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
                    <?php foreach($distributes as $distribute): ?>
                        <tr class="first">
                            <td>
                                <?php echo isset($distribute->paper->title) ? $distribute->paper->title : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo date("Y-m-d H:i:s", $distribute->paper->createtime); ?>
                            </td>
                            <td>
                                <?php if ($distribute->paper->status == 1):?>
                                    <span class="label label-success">已打分</span>
                                <?php else:?>
                                    <span class="label label-important">未打分</span>
                                <?php endif; ?>
                            </td>
                            <td class="align-right">
                                <?php if ($distribute->paper->status == 1):?>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/comment', 'paperid' => $distribute->paper->paperid]); ?>">留言</a>
                                <?php else:?>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/download', 'paperid' => $distribute->paper->paperid]); ?>">下载</a>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/mark', 'paperid' => $distribute->paper->paperid]); ?>">评分</a>
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
