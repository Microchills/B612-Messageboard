<!DOCTYPE html>
<?php
    $dsn = "mysql:dbname=messageboard;host=127.0.0.1";
    $pdo = new PDO($dsn,'root','');
    //获取数据库留言
    function read_msg($pdo,$sql){
        $get_msg = $pdo->prepare($sql);
        $get_msg->execute();
        $msg_data = $get_msg->fetchall();
        return $msg_data;
    }

    //写入留言数据
    function write_msg($pdo,$sql){
        $save_sth = $pdo->prepare($sql);
        $save_sth->execute();
    }
    //判断输入是否合格
    function check_input($input){
        if (trim($input) == ''){
            echo"
                <script type='text/javascript'>
                    alert('看看是不是忘记什么了？');
                    history.back();
                </script>";
            exit;
        }
    }
    function visit_sum($pdo){
        $date_time = date('Y年m月d日，H点i分s秒',time());
        $save_time = date('Y-m-d H:i:s',time());
        $save_visit_sql = "INSERT INTO `visit_data`(`visit_date`) VALUES ('{$save_time}')";
        $save_visit = $pdo->prepare($save_visit_sql);
        $save_visit->execute();
        $t_visit_sql = "SELECT `visit_no` FROM `visit_data` ORDER BY `visit_no` DESC limit 1;";
        $t_visit = $pdo->prepare($t_visit_sql);
        $t_visit->execute();
        $t_visit_no = $t_visit->fetchall();
        return $t_visit_no;
    }
    function random_quote(){
        $l_num = rand(1,16);
        $filename = "ThelittlePrince.txt";
        $file = fopen($filename,"r");
        for ($i = 0; $i < $l_num; $i++){
            $quote = fgets($file);
        }
        return $quote;
    }
?>
