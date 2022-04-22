<link rel="stylesheet" href="assets/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>成绩</h3>
                <div class="span10 pull-right">
                    <a href="<?php echo yii\helpers\Url::to(['paper/export']) ?>" class="btn-flat success pull-right">
                        下载成绩
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span3 sortable">
                            <span class="line"></span>论文题目
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>学生
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>评审教师
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>得分
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>结果
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php foreach($scores as $score): ?>
                        <tr class="first">
                            <td>
                                <?php echo isset($score->paper->title) ? $score->paper->title : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($score->student->truename) ? $score->student->truename : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($score->teacher->truename) ? $score->teacher->truename : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($score->total) ? $score->total : '未填写'; ?>
                            </td>
                            <td>
                                <?php if ($score->isok == 0):?>
                                    同意答辩
                                <?php elseif ($score->isok ==1): ?>
                                    修改后答辩
                                <?php else:?>
                                    不同意答辩
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
