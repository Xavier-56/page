<link rel="stylesheet" href="assets/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>论文列表</h3>
                <div class="span10 pull-right">
                    <?php if ($mode== 0):?>
                        <h5 style="margin-left: 600px">模式：在线评分</h5>
                    <?php else:?>
                        <h5 style="margin-left: 580px">模式：上传文档评分</h5>
                    <?php endif; ?>
                    <a href="<?php echo yii\helpers\Url::to(['paper/change']) ?>" class="btn-flat success pull-right">
                        更换模式
                    </a>
                </div>
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
                            <span class="line"></span>学生学号
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>学生姓名
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>提交时间
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>状态
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>评审教师
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
                            <td>
                                <?php echo isset($paper->title) ? $paper->title : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($paper->student->studentno) ? $paper->student->studentno : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($paper->student->truename) ? $paper->student->truename : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo date("Y-m-d H:i:s", $paper->createtime); ?>
                            </td>
                            <td>
                                <?php if ($paper->status == 1 or $paper->status == 2):?>
                                    <span class="label label-success">已分配</span>
                                <?php else:?>
                                    <span class="label label-important">未分配</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($paper->status == 1 or $paper->status == 2):?>
                                    <?php echo isset($paper->distribute->teachername) ? $paper->distribute->teachername : '未填写'; ?>
                                <?php else:?>
                                    暂无
                                <?php endif; ?>
                            </td>
                            <td class="align-right">
                                <?php if ($paper->status == 1 or $paper->status == 2):?>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/download', 'paperid' => $paper->paperid]); ?>">下载</a>
                                <?php else:?>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/download', 'paperid' => $paper->paperid]); ?>">下载</a>
                                    <a href="<?php echo yii\helpers\Url::to(['paper/distribute', 'paperid' => $paper->paperid]); ?>">分配</a>
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
