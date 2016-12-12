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
if (isset($_POST['action'])){
    if($_POST['action']==='add'){
    $sql=$pdo->prepare('INSERT INTO things(`create_time`,`title`,`outline`,`description`) VALUES (:create_time,:title,:outline,:description);');
    $sql->bindValue(':create_time',date('Y-m-d H:m:s',time()));
    $sql->bindValue(':title',urlencode($_POST['newthing_title']));
    $sql->bindValue(':outline',urlencode($_POST['newthing_outline']));
    $sql->bindValue(':description',urlencode($_POST['newthing_desc']));
    $sql->execute();
    header('Location:list.php'); 
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>添加事件</title>
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://www.bootcss.com/p/buttons/css/buttons.css">
        <link rel="stylesheet" href="global.css">
    </head>
    <body >
        <div id="body1">
            <!--</pre><?php var_dump($_POST)?></pre>-->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin:0;">
            <div style="float:right;margin-top:6px;">
                <a href="index.html"><button  class="btn btn-danger" >返回首页</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button  class="btn btn-success" >登陆</button>&nbsp;&nbsp;  
                <button type="button" class="btn btn-danger" >注册</button>&nbsp;&nbsp;
            </div>
        </nav>
        <div align="center" style="background-color:rgba(69,59,256,0.5);width:100%;height:200px;">
        <div style="font-size:400%;position:relative;top:30%;text-shadow: -5px -5px 0 rgba(0,0,0,0.1);color:white;">备忘录α
        </div>
        </div>
        <form action="add new.php" method="post">
        <div style="white-space: nowrap;width:100%;">
            <div style="background-color:rgba(101,250,90,0.2);float:left;width:30%;height:60px;"><div style="position:relative;top:20%;font-size:180%">请输入事件名称</div></div>
            <div style="float:left;width:70%;height:60px;margin:0;"><input type="text" name="newthing_title" placeholder="事件名称" style="width:100%;height:100%;font-size:180%;"></div>
        </div>
        <div style="white-space: nowrap;width:100%;">
            <div style="background-color:rgba(0,43,163,0.2);float:left;width:30%;height:60px;"><div style="position:relative;top:20%;font-size:180%">请输入事件概要</div></div>
            <div style="float:left;width:70%;height:60px;margin:0;"><input type="text" name="newthing_outline" placeholder="事件概要" style="width:100%;height:100%;font-size:150%;"></div>
        </div>
        <div style="white-space: nowrap;width:100%;height:300px;">
            <div style="background-color:rgba(101,20,90,0.2);float:left;width:30%;height:100%;"><div style="position:relative;top:45%;font-size:180%">请输入事件详情</div></div>
            <div style="float:left;width:70%;height:300px;margin:0;"><textarea style="resize: none;float:left;width:100%;height:100%;font-size:150%;" name="newthing_desc" placeholder="事件详情"></textarea></div>
        </div>
        
        <div style="white-space:nowrap;width:100%;">
            <div style="float:left;width:50%;height:50px"><a href="list.php"><button name="action" type="submit" class="button button-action button-square" style="width:100%;height:100%" value="add">添加事件</button></a></div></form>
            <div style="float:left;width:50%;height:50px"><a href="index.html"><button type="button" class="button button-caution button-square button-jumbo" style="width:100%;height:100%">取消返回</button></a></div>
        </div>
        </div>
    </body>
    </html>