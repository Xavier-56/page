<!DOCTYPE html>
<html>
<head>
	<title>研究生论文送审系统（学生）</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="assets/css11/muke/course/course-comment.css" />
<!--    <link rel="stylesheet" type="text/css" href="assets/css11/muke/base.css">-->
<!--    <link rel="stylesheet" type="text/css" href="assets/css11/mooc.css" />-->

    <!-- bootstrap -->
    <link href="assets/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="assets/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="assets/css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/lib/font-awesome.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="assets/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="assets/css/compiled/index.css" type="text/css" media="screen" />
    <link href="assets/css/lib/bootstrap-wysihtml5.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/compiled/form-showcase.css" type="text/css" media="screen" />
    <!-- open sans font -->

    <!-- lato font -->

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

    <!-- navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="brand" href="index.html" style="font-weight:700;font-family:Microsoft Yahei">研究生论文送审系统（学生）</a>

            <ul class="nav pull-right">                
<!--                <li class="hidden-phone">-->
<!--                    <input class="search" type="text" />-->
<!--                </li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
                        账户管理
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                    <li><a href="<?php echo yii\helpers\Url::to(['detail/changedetails']) ?>">个人信息管理</a></li>
                    <li><a href="<?php echo yii\helpers\Url::to(['detail/changepass']); ?>">修改密码</a></li>
                    </ul>
                </li>
                <li class="settings hidden-phone">
                <a href="<?php echo yii\helpers\Url::to(['index/logout']) ?>" role="button">
                        <i class="icon-share-alt"></i>
                    </a>
                </li>
            </ul>            
        </div>
    </div>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li class="active">
<!--                <div class="pointer">-->
<!--                    <div class="arrow"></div>-->
<!--                    <div class="arrow_border"></div>-->
<!--                </div>-->
                <a href="<?php echo yii\helpers\Url::to(['home/index']) ?>">
                    <i class="icon-home"></i>
                    <span>首页</span>
                </a>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-user"></i>
                    <span>提交论文</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                <li><a href="<?php echo yii\helpers\Url::to(['paper/index']); ?>">提交论文</a></li>
                <li><a href="<?php echo yii\helpers\Url::to(['paper/alreadysubmit']); ?>">已提交论文</a></li>
                </ul>
            </li>
<!--            <li>-->
<!--                <a href="chart-showcase.html">-->
<!--                    <i class="icon-signal"></i>-->
<!--                    <span>进度</span>-->
<!--                </a>-->
<!--            </li>-->
<!---->
<!--            <li>-->
<!--                <a class="dropdown-toggle" href="#">-->
<!--                    <i class="icon-group"></i>-->
<!--                    <span>用户管理</span>-->
<!--                    <i class="icon-chevron-down"></i>-->
<!--                </a>-->
<!--                <ul class="submenu">-->
<!--                <li><a href="--><?php //echo yii\helpers\Url::to(['user/users']); ?><!--">用户列表</a></li>-->
<!--                <li><a href="--><?php //echo yii\helpers\Url::to(['user/reg']); ?><!--">加入新用户</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a class="dropdown-toggle" href="#">-->
<!--                    <i class="icon-list"></i>-->
<!--                    <span>分类管理</span>-->
<!--                    <i class="icon-chevron-down"></i>-->
<!--                </a>-->
<!--                <ul class="submenu">-->
<!--                <li><a href="--><?php //echo yii\helpers\Url::to(['category/list']); ?><!--">分类列表</a></li>-->
<!--                <li><a href="--><?php //echo yii\helpers\Url::to(['category/add']); ?><!--">加入分类</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a class="dropdown-toggle" href="#">-->
<!--                    <i class="icon-glass"></i>-->
<!--                    <span>商品管理</span>-->
<!--                    <i class="icon-chevron-down"></i>-->
<!--                </a>-->
<!--                <ul class="submenu">-->
<!--                <li><a href="--><?php //echo yii\helpers\Url::to(['product/list']); ?><!--">商品列表</a></li>-->
<!--                <li><a href="--><?php //echo yii\helpers\Url::to(['product/add']); ?><!--">添加商品</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a class="dropdown-toggle" href="#">-->
<!--                    <i class="icon-edit"></i>-->
<!--                    <span>订单管理</span>-->
<!--                    <i class="icon-chevron-down"></i>-->
<!--                </a>-->
<!--                <ul class="submenu">-->
<!--                <li><a href="--><?php //echo yii\helpers\Url::to(['order/list']); ?><!--">订单列表</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!---->
<!--            <li>-->
<!--                <a class="dropdown-toggle" href="#">-->
<!--                    <i class="icon-edit"></i>-->
<!--                    <span>表单</span>-->
<!--                    <i class="icon-chevron-down"></i>-->
<!--                </a>-->
<!--                <ul class="submenu">-->
<!--                    <li><a href="form-showcase.html">基本表单</a></li>-->
<!--                    <li><a href="form-wizard.html">步骤表单</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="gallery.html">-->
<!--                    <i class="icon-picture"></i>-->
<!--                    <span>相册管理</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="calendar.html">-->
<!--                    <i class="icon-calendar-empty"></i>-->
<!--                    <span>日历事件管理</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="tables.html">-->
<!--                    <i class="icon-th-large"></i>-->
<!--                    <span>表格</span>-->
<!--                </a>-->
<!--            </li>-->
            
            <li>
                <a href="<?php echo yii\helpers\Url::to(['detail/changedetails']) ?>">
                    <i class="icon-cog"></i>
                    <span>我的信息</span>
                </a>
            </li>
            
        </ul>
    </div>
    <!-- end sidebar -->

    <?php echo $content; ?>


	<!-- scripts -->
    <script src="assets/js/jquery-latest.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- knob -->
    <script src="assets/js/jquery.knob.js"></script>
    <!-- flot charts -->
    <script src="assets/js/jquery.flot.js"></script>
    <script src="assets/js/jquery.flot.stack.js"></script>
    <script src="assets/js/jquery.flot.resize.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/wysihtml5-0.3.0.js"></script>
    <script src="assets/js/bootstrap-wysihtml5-0.0.2.js"></script>

    <script type="text/javascript">
        $(function () {

            // jQuery Knobs
            $(".knob").knob();



            // jQuery UI Sliders
            $(".slider-sample1").slider({
                value: 100,
                min: 1,
                max: 500
            });
            $(".slider-sample2").slider({
                range: "min",
                value: 130,
                min: 1,
                max: 500
            });
            $(".slider-sample3").slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 40, 170 ],
            });

            

            // // jQuery Flot Chart
            // var visits = [[1, 50], [2, 40], [3, 45], [4, 23],[5, 55],[6, 65],[7, 61],[8, 70],[9, 65],[10, 75],[11, 57],[12, 59]];
            // var visitors = [[1, 25], [2, 50], [3, 23], [4, 48],[5, 38],[6, 40],[7, 47],[8, 55],[9, 43],[10,50],[11,47],[12, 39]];
            //
            // var plot = $.plot($("#statsChart"),
            //     [ { data: visits, label: "注册量"},
            //      { data: visitors, label: "访客量" }], {
            //         series: {
            //             lines: { show: true,
            //                     lineWidth: 1,
            //                     fill: true,
            //                     fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
            //                  },
            //             points: { show: true,
            //                      lineWidth: 2,
            //                      radius: 3
            //                  },
            //             shadowSize: 0,
            //             stack: true
            //         },
            //         grid: { hoverable: true,
            //                clickable: true,
            //                tickColor: "#f9f9f9",
            //                borderWidth: 0
            //             },
            //         legend: {
            //                 // show: false
            //                 labelBoxBorderColor: "#fff"
            //             },
            //         colors: ["#a7b5c5", "#30a0eb"],
            //         xaxis: {
            //             ticks: [[1, "一月"], [2, "二月"], [3, "三月"], [4,"四月"], [5,"五月"], [6,"六月"],
            //                    [7,"七月"], [8,"八月"], [9,"九月"], [10,"十月"], [11,"十一月"], [12,"十二月"]],
            //             font: {
            //                 size: 12,
            //                 family: "Open Sans, Arial",
            //                 variant: "small-caps",
            //                 color: "#697695"
            //             }
            //         },
            //         yaxis: {
            //             ticks:3,
            //             tickDecimals: 0,
            //             font: {size:12, color: "#9da3a9"}
            //         }
            //      });

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y - 30,
                    left: x - 50,
                    color: "#fff",
                    padding: '2px 5px',
                    'border-radius': '6px',
                    'background-color': '#000',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }

            var previousPoint = null;
            $("#statsChart").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        var month = item.series.xaxis.ticks[item.dataIndex].label;

                        showTooltip(item.pageX, item.pageY,
                                    item.series.label + " of " + month + ": " + y);
                    }
                }
                else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });
        $(".wysihtml5").wysihtml5({
            "font-styles": false
        });
        $("#addpic").click(function(){
            var pic = $("#product-pics").clone();
            pic.attr("style", "margin-left:120px");
            $("#product-pics").parent().append(pic);
        });

    </script>

</body>
</html>

