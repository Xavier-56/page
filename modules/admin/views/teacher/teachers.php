<link rel="stylesheet" href="assets/css/compiled/user-list.css" type="text/css" media="screen" />
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>教师列表</h3>
                <div class="span10 pull-right">
                    <a href="<?php echo yii\helpers\Url::to(['teacher/register']) ?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        添加新教师
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
                            <span class="line"></span>工作单位
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
                    <?php foreach($teachers as $teacher): ?>
                        <tr class="first">
                            <td>
                                <?php if (empty($teacher->avatar)): ?>
                                    <img src="<?php echo Yii::$app->params['defaultValue']['avatar']; ?>" class="img-circle avatar hidden-phone" />
                                <?php else: ?>
                                    <img src="assets/uploads/avatar/<?php echo $teacher->avatar; ?>" class="img-circle avatar hidden-phone" />
                                <?php endif; ?>
                                <a href="#" class="name"><?php echo $teacher->username; ?></a>
                                <span class="subtext"><?php echo $teacher->email; ?></span>
                            </td>
                            <td>
                                <?php echo isset($teacher->truename) ? $teacher->truename : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($teacher->school) ? $teacher->school : '未填写'; ?>
                            </td>
                            <td>
                                <?php echo isset($teacher->major) ? $teacher->major : '未填写'; ?>
                            </td>
                            <td class="align-right">
                                <a href="<?php echo yii\helpers\Url::to(['teacher/delete', 'id' => $teacher->teacherid]); ?>">删除</a>
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
