<link rel="stylesheet" href="assets/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>学生列表</h3>
                <div class="span10 pull-right">
                    <a href="<?php echo yii\helpers\Url::to(['student/register']) ?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        添加新学生
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span3 sortable">
                            <span class="line"></span>用户名
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>真实姓名
                        </th>
                        <th class="span2 sortable">
                            <span class="line"></span>学号
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>年级
                        </th>
                        <th class="span3 sortable">
                            <span class="line"></span>专业
                        </th>
                        <th class="span3 sortable align-right">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php foreach($students as $student): ?>
                        <tr class="first">
                            <td>
                                <?php if (empty($student->avatar)): ?>
                                    <img src="<?php echo Yii::$app->params['defaultValue']['avatar']; ?>" class="img-circle avatar hidden-phone" />
                                <?php else: ?>
                                    <img src="assets/uploads/avatar/<?php echo $student->avatar; ?>" class="img-circle avatar hidden-phone" />
                                <?php endif; ?>
                                <a href="#" class="name"><?php echo $student->username; ?></a>
                                <span class="subtext"><?php echo $student->email; ?></span>
                            </td>
                            <td>
                                <?php echo isset($student->truename) ? $student->truename : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($student->studentno) ? $student->studentno : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($student->grade) ? $student->grade : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($student->major) ? $student->major : '未填写'; ?>
                            </td>
                            <td class="align-right">
                                <a href="<?php echo yii\helpers\Url::to(['student/delete', 'id' => $student->studentid]); ?>">删除</a>
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
