<?php
date_default_timezone_set('PRC');
$conn_hostname = 'localhost';
$conn_database = 'Memorandum';
$conn_username = 'root';
$conn_password = 'root';
try {
	$pdo = new PDO('mysql:host='.$conn_hostname.';dbname='.$conn_database, $conn_username, $conn_password);
	$pdo->exec('SET NAMES UTF8');
}
catch(Exception $e) {
    echo '<h1>数据库链接错误！</h1>';
    return;
}
if (isset($_POST['action'])){
    if ($_POST['action']==='SAVE'){
        $sql=$pdo->prepare('UPDATE things SET `title`=:title,`outline`=:outline,`description`=:description ,`edit_time`=:edit_time WHERE `id`=:id;');
        $sql->bindValue(':title',urlencode($_POST['newthing_title']));
        $sql->bindValue(':outline',urlencode($_POST['newthing_outline']));
        $sql->bindValue(':description',urlencode($_POST['newthing_desc']));
        $sql->bindValue('edit_time',date('Y-m-d H:i:s',time()));
        $sql->bindValue(':id',$_GET['id']);
        $sql->execute();
        header('Location:list.php');
    }
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
        <title>添加事件</title>
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://www.bootcss.com/p/buttons/css/buttons.css">
        <link rel="stylesheet" href="global.css">
    <!DOCTYPE html>
    </head>
    <body >
        <div id="body1">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin:0;">
            <div style="float:right;margin-top:6px;">
                <a href="index.html"><button  class="btn btn-danger" >返回首页</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-success" >登陆</button>&nbsp;&nbsp;  
                <button class="btn btn-danger" >注册</button>&nbsp;&nbsp;
            </div>
        </nav>
        <div align="center" style="background-color:rgba(69,59,256,0.5);width:100%;height:200px;">
        <div style="font-size:400%;position:relative;top:30%;text-shadow: -5px -5px 0 rgba(0,0,0,0.1);color:white;">备忘录α
        </div>
        </div>
        <form action="edit.php?id=<?php echo $thing['id'] ?>" method="post">
        <div style="white-space: nowrap;width:100%;">
            <div style="background-color:rgba(101,250,90,0.2);float:left;width:30%;height:60px;"><div style="position:relative;top:20%;font-size:180%">编辑事件名称</div></div>
            <div style="float:left;width:70%;height:60px;margin:0;"><input type="text" name="newthing_title"  placeholder="编辑事件名称" value="<?php echo urldecode($thing['title']); ?>"  style="width:100%;height:100%;font-size:180%;"></div>
        </div>
        <div style="white-space: nowrap;width:100%;">
            <div style="background-color:rgba(0,43,163,0.2);float:left;width:30%;height:60px;"><div style="position:relative;top:20%;font-size:180%">编辑事件概要</div></div>
            <div style="float:left;width:70%;height:60px;margin:0;"><input type="text" name="newthing_outline" placeholder="编辑事件概要" value="<?php echo urldecode($thing['outline']); ?>"  style="width:100%;height:100%;font-size:150%;"></div>
        </div>
        <div style="white-space: nowrap;width:100%;height:300px;">
            <div style="background-color:rgba(101,20,90,0.2);float:left;width:30%;height:100%;"><div style="position:relative;top:45%;font-size:180%">编辑事件详情</div></div>
            <div style="float:left;width:70%;height:300px;margin:0;"><textarea name="newthing_desc" style="resize:none;float:left;width:100%;height:100%;font-size:150%;"placeholder="编辑事件详情"><?php echo urldecode($thing['description']); ?></textarea></div>
            </div>
        <div style="white-space: nowrap;width:100%;">
            <div style="float:left;width:50%;height:50px"><button class="button button-action button-square" style="width:100%;height:100%" type="submit" value="SAVE" name="action">保存修改并返回</button></div>
            <div style="float:left;width:50%;height:50px"><a href="list.php"><button type="button" class="button button-caution button-square button-jumbo" style="width:100%;height:100%">取消返回</button></a></div>
        </div>
        </form>
        </div>
    </body>
    </html>
