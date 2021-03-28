<?php
    //读取用户输入
    $content = $_POST["content"];
    $username = $_POST["username"];
    include ('db.php');
    check_input($username);
    check_input($content);
    $date = date('Y-m-d H:i:s',time()+6*3600);
    //写入数据
    $save_msg = "INSERT INTO `message` (`username`,`content`,`s_date`) VALUES ('{$username}', '{$content}','{$date}')";
    write_msg($pdo,$save_msg);
    //跳转回首页
    header ('location: index.php');
?>