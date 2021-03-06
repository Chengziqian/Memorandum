<?php
date_default_timezone_set('PRC');
$conn_hostname = 'localhost';
$conn_database = 'Memorandum';
$conn_username = 'root';
$conn_password = 'root';
try {
    $pdo=new PDO('mysql:host='.$conn_hostname.';dbname='.$conn_database,$conn_username,$conn_password);
    $pdo->exec('SET NAMES UTF8');
}
catch (Exception $e){
    echo '<h1>数据库链接错误！</h1>';
    return;    
}
$sql = $pdo->prepare('SELECT * FROM things WHERE `id` = :id;');
$sql->bindValue(':id', $_GET['id']);
$sql->execute();
$thing = $sql->fetch(PDO::FETCH_ASSOC);
if($thing === false) {
    echo '<h1>404</h1>';
    return;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>备忘录α</title>
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://www.bootcss.com/p/buttons/css/buttons.css">
        <link rel="stylesheet" href="global.css">
    </head>
    <body>
        <div id="body1">
            <!--<pre><?php echo $_GET['id'];?></pre>-->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin:0;">
            <div style="float:right;margin-top:6px;">
                <a href="index.html"><button  class="btn btn-danger" >返回首页</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-success" >登陆</button>&nbsp;&nbsp;  
                <button class="btn btn-danger" >注册</button>&nbsp;&nbsp;
            </div>
        </nav>
        <div align="center" style="background-color:rgba(69,59,256,0.5);width:100%;height:200px;">
        <div style="font-size:400%;position:relative;top:30%;text-shadow: -5px -5px 0 rgba(0,0,0,0.1);color:white;">备忘录α</div>
        </div>
        <table width=100%  class="table table-striped" border=1>
            <tr>
                <td style="width:10%">事件名称</td>
                <td style="width:10%">创建时间</td>
                <td style="width:10%">完成时间</td>
                <td style="width:10%">事件概要</td>
                <td style="width:70%">事件详情</td>
            </tr>
            <tr>
                <td style="width:10%;height:400px"><?php echo urldecode($thing['title']);?></td>
                <td style="width:10%;height:400px"><?php echo $thing['create_time'];?></td>
                <td style="width:10%;height:400px"><?php echo $thing['done_time'];?></td>
                <td style="width:10%;height:400px"><?php echo urldecode($thing['outline']);?></td>
                <td style="width:70%;height:400px"><textarea style="width:100%;height:100%;resize: none;" readonly><?php echo urldecode($thing['description']);?></textarea></td>
            </tr>
        </table>
        <div style="white-space: nowrap;width:100%;">
            <div style="float:right;width:20%;height:50px"><a href="list.php"><button class="button button-caution button-square button-jumbo" style="width:100%;height:100%">返回</button></a></div>
        </div>
    </body>
    </html>