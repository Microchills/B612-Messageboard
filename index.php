<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <!-- 必须的 meta 标签 -->
    <title>B612</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap 的 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10">
                <?php
                include('db.php');
                $sql = "select * from message order by `msg_id` desc";
                $msg_data = read_msg($pdo, $sql); //读取留言信息
                ?>
                <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
                    <a id='time' class="navbar-brand" href="#">
                        <?php
                        echo '
                        <script type="text/javascript">
                            function showtime() {
                                var time = new Date(); //获取系统当前时间
                                var year = time.getFullYear();
                                var month = time.getMonth() + 1;
                                var date = time.getDate(); //系统时间月份中的日
                                var day = time.getDay(); //系统时间中的星期值
                                var weeks = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
                                var week = weeks[day]; //显示为星期几
                                var hour = time.getHours();
                                var minutes = time.getMinutes();
                                var seconds = time.getSeconds();
                                console.log(seconds);
                                if (month < 10) {
                                    month = "0" + month;
                                }
                                if (date < 10) {
                                    date = "0" + date;
                                }
                                if (hour < 10) {
                                    hour = "0" + hour;
                                }
                                if (minutes < 10) {
                                    minutes = "0" + minutes;
                                }
                                if (seconds < 10) {
                                    seconds = "0" + seconds;
                                }
                                document.getElementById("time").innerHTML = "地球纪元" + year + "年" + month + "月" + date + "日" + week + "  " + 
                                                                            hour + ":" + minutes + ":" + seconds;
                                setTimeout("showtime()",1000);
                            }
                            showtime();
                        </script>';
                        ?>
                    </a>
                    <span class="navbar-text text-right">欢迎来到B612星球，您是本行星第
                        <span class="navbar-text text-right font-weight-bolder ">
                            <?php
                            $visit_no = visit_sum($pdo)[0];
                            echo "$visit_no[0]";
                            ?>
                        </span>
                        <span class="navbar-text text-right">位访客</span>
                </nav>
                <form action="save.php" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <textarea name="content" type="text" class="form-control" rows="4" placeholder="说点什么叭..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" placeholder="这里输昵称哦">
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">发表</button>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </form>

                <?php
                foreach ($msg_data as $key => $msg) {
                ?>
                    <div class="border rounded p-2 mb-2">
                        <div class="row">
                            <div class="col-12">
                                <?php echo $msg['content']; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-primary col-4">
                                <?php echo $msg['username']; ?>
                            </div>
                            <div class="text-primary col-4">
                                <?php echo $msg['s_date']; ?>
                            </div>
                        </div>

                    </div>

                <?php
                }
                ?>
            </div>
            <div class="col-1"></div>
        </div>
</body>

</html>