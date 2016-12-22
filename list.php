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
    if (substr($_POST['action'],0,3)==='DEL'){
        $id = substr($_POST['action'],4);
        $sql = $pdo->prepare('UPDATE things SET `del`= 1,`del_time`=:del_time  WHERE `id` = :id;');
        $sql->bindValue(':id',$id);
        $sql->bindValue(':del_time',date('Y-m-d H:i:s',time()));
        $sql->execute();
    }
    else if (substr($_POST['action'],0,4)==='DONE'){
        $id = substr($_POST['action'],5);
        $sql = $pdo->prepare('UPDATE things SET `done_time` = :done_time WHERE `id`=:id;');
        $sql->bindValue(':done_time',date('Y-m-d H:i:s',time()));
        $sql->bindValue(':id',$id);
        $sql->execute();
    }
    else if(substr($_POST['action'],0,4)==='DESC'){
        $id_1 = substr($_POST['action'],5);
        header('Location:detail.php?id='.$id_1); 
    }
    else if(substr($_POST['action'],0,4)==='EDIT'){
        $id_1 = substr($_POST['action'],5);
        header('Location:edit.php?id='.$id_1);
    }
}
$sql = $pdo->prepare('SELECT * FROM things WHERE `done_time`is NULL and `del` is NULL;');
$sql->execute();
$things_undo = $sql->fetchall(PDO::FETCH_ASSOC);

$sql = $pdo->prepare('SELECT * FROM things WHERE `done_time` is not NULL and `del` is NULL;');
$sql->execute();
$things_done = $sql->fetchall(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>查看事件</title>
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://www.bootcss.com/p/buttons/css/buttons.css">
        <link rel="stylesheet" href="global.css">
    </head>
    <body>
        <div id="body1">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin:0;">
            <div style="float:right;margin-top:6px;">
                <a href="index.html"><button  class="btn btn-danger" >返回首页</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button  class="btn btn-success" >登陆</button>&nbsp;&nbsp;  
                <button type="button" class="btn btn-danger" >注册</button>&nbsp;&nbsp;
            </div>
        </nav>
        <div align="center" style="background-color:rgba(69,59,256,0.5);width:100%;height:200px;">
        <div style="font-size:400%;position:relative;top:30%;text-shadow: -5px -5px 0 rgba(0,0,0,0.1);color:white;">备忘录α</div>
        </div>
        <form action="list.php" method="post">
            <!--<per><?php var_dump($_POST)?></pre>-->
        <table width=100%  class="table table-striped" style="overflow:hidden;white-space: nowrap;">
            <tr>
                <td>状态</td>
                <td>事件名称</td>
                <td>创建时间</td>
                <td>完成时间</td>
                <td>事件概要</td>
                <td>操作</td>
            </tr>
            <?php foreach ($things_undo as $thing) {?>
            <tr>
                <td>未完成</td>
                <td><a href="detail.php?id=<?php echo $thing['id'];?>"><?php echo urldecode($thing['title']);?></td>
                <td><?php echo $thing['create_time']; ?></td>
                <td>---</td>
                <td><?php echo urldecode($thing['outline']); ?></td>
                <td><button class="btn btn-success" name="action" value="DONE-<?php echo $thing['id']; ?>" >完成</button>&nbsp;&nbsp;<button class="btn btn-danger" name="action" value="DEL-<?php echo $thing['id']; ?>">删除</button>&nbsp;&nbsp;<button class="btn btn-info" name="action" value="DESC-<?php echo $thing['id']; ?>">查看详情</button>&nbsp;&nbsp;<button class="btn btn-warning" name="action" value="EDIT-<?php echo $thing['id']; ?>" >编辑</button></td>
            </tr>
            <?php } ?>
            <?php foreach ($things_done as $thing) {?>
            <tr>
                <td>已完成</td>
                <td><a href="detail.php?id=<?php echo $thing['id'];?>"><del><?php echo urldecode($thing['title']);?></del></a></td>
                <td><?php echo $thing['create_time']; ?></td>
                <td><?php echo $thing['done_time']; ?></td>
                <td><del><?php echo urldecode($thing['outline']); ?></del></td>
                <td><button class="btn btn-success" disabled="disabled" name="action" value="DONE-<?php echo $thing['id']; ?>" >已完成</button>&nbsp;&nbsp;<button class="btn btn-danger" name="action" value="DEL-<?php echo $thing['id']; ?>">删除</button>&nbsp;&nbsp;<button class="btn btn-info" name="action" value="DESC-<?php echo $thing['id']; ?>" >查看详情</button>&nbsp;&nbsp;<button class="btn btn-warning" name="action" value="EDIT-<?php echo $thing['id']; ?>">编辑</button></td>
            </tr>
            <?php } ?>
            <!--<tr>
                <td><input type="checkbox"></td>
                <td><a href="detail.html">事件一</a></td>
                <td>创建时间一</td>
                <td>事件概要一</td>
                <td><button class="btn btn-success">完成</button>&nbsp;&nbsp;<button class="btn btn-danger">删除</button>&nbsp;&nbsp;<a href="detail.html"><button class="btn btn-info">查看详情</button></a>&nbsp;&nbsp;<a href="edit.html"><button class="btn btn-warning">编辑</button></a></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td><a href="detail.html">事件二</a></td>
                <td>创建时间二</td>
                <td>事件概要二</td>
                <td><button class="btn btn-success">完成</button>&nbsp;&nbsp;<button class="btn btn-danger">删除</button>&nbsp;&nbsp;<a href="detail.html"><button class="btn btn-info">查看详情</button></a>&nbsp;&nbsp;<a href="edit.html"><button class="btn btn-warning">编辑</button></a></td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td><a href="detail.html">事件三</a></td>
                <td>创建时间三</td>
                <td>事件概要三</td>
                <td><button class="btn btn-success">完成</button>&nbsp;&nbsp;<button class="btn btn-danger">删除</button>&nbsp;&nbsp;<a href="detail.html"><button class="btn btn-info">查看详情</button></a>&nbsp;&nbsp;<a href="edit.html"><button class="btn btn-warning">编辑</button></a></td>
            </tr>-->
        </table>
        </form>
        </div>
    </body>
    </html>