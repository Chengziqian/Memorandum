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
    if (substr($_POST['action'],0,4)=='EDIT'){
        $id_2=substr($_POST['action'],5);
        header('Location:edit.php?id='.$id_2);
    }
    if (substr($_POST['action'],0,2)=='RE'){
        $id_2=substr($_POST['action'],3);
        $sql=$pdo->prepare('UPDATE things SET `del` = NULL,`del_time`= NULL WHERE `id`=:id_2');
        $sql->bindValue(':id_2',$id_2);
        $sql->execute();
    }
    if (substr($_POST['action'],0,5)=='NDONE'){
        $id_2=substr($_POST['action'],6);
        $sql=$pdo->prepare('UPDATE things SET `done_time`= NULL WHERE `id`=:id_2');
        $sql->bindValue(':id_2',$id_2);
        $sql->execute();
    }
    if (substr($_POST['action'],0,2)=='RD'){
        $id_2=substr($_POST['action'],3);
        $sql=$pdo->prepare('DELETE FROM things WHERE `id`=:id_2');
        $sql->bindValue(':id_2',$id_2);
        $sql->execute();
    }
}
$sql = $pdo->prepare('SELECT * FROM things WHERE `id` is not NULL;');
$sql->execute();
$history=$sql->fetchall(PDO::FETCH_ASSOC);
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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin:0;">
            <div style="float:right;margin-top:6px;">
                <div style="float:right;margin-top:6px;">
                <a href="index.html"><button  class="btn btn-danger" >返回首页</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-success" >登陆</button>&nbsp;&nbsp;  
                <button class="btn btn-danger" >注册</button>&nbsp;&nbsp;
            </div>
            </div>
        </nav>
        <div align="center" style="background-color:rgba(69,59,256,0.5);width:100%;height:200px;">
        <div style="font-size:400%;position:relative;top:30%;text-shadow: -5px -5px 0 rgba(0,0,0,0.1);color:white;">备忘录α--历史记录
        </div>
        </div>
        <div  style="height: 60px;margin: 0;overflow:hidden;white-space: nowrap;">
                 <div  style="display:inline-block;width:30%; height: 100%;background-color: lightseagreen;">
                     <div style="height :40px;width:300px;margin:0 auto;margin-top:3px;font-size: 200%;font-family:Microsoft YaHei;">事件名称</div>
                 </div><!--
              --><div  style="display:inline-block;width:10%;height: 100%;background-color:grey;">
                     <div style="font-size: 200%;font-family:Microsoft YaHei;height :40px;width:100px;margin:0 auto;margin-top:3px;">状态</div>
                 </div><!--
              --><div  style="display:inline-block;width:10%;height: 100%;background-color:#eb5424;">
                     <div style="font-size: 200%;font-family:Microsoft YaHei;height :40px;width:100px;margin:0 auto;margin-top:3px;">操作</div>
                 </div><!--
              --><div  style="display:inline-block;width:30%;height: 100%;background-color:#6677ff;">
                     <div style="font-size: 200%;font-family:Microsoft YaHei;height :40px;width:100px;margin:0 auto;margin-top:3px;">时间</div>
                 </div><!--
              --><div style="display:inline-block;width:20%;height: 100%;background-color:rgb(255,136,0);">
                        <div style="font-size: 200%;font-family:Microsoft YaHei;height :40px;width:100px;margin:0 auto;margin-top:3px;">选项</div>
                    </div>
                 </div>
                 <form action="history.php" method="post">
        <?php foreach ($history as $h){?>
                 <div style="height: 150px;margin: 0;overflow:hidden;white-space: nowrap;margin-bottom:10px;">
                     <div style="display:inline-block;width:30%; height: 100%;vertical-align: top;background-color:<?php if ($h['id']%2==0) echo 'rgba(26,255,0,0.5)'; else echo 'rgba(26,255,0,0.3)';?>; ">
        <div style="height :40px;width:300px;margin:0 auto;position:relative;top:50px;font-size: 200%;font-family:Microsoft YaHei;"><?php echo urldecode($h['title'])?> </div>
                     </div><!--
                  --><div style="background-color:<?php if ($h['done_time']!=NULL&&$h['del']!=1) echo 'rgba(26,255,0,0.3)';elseif ($h['del']==1) echo 'rgba(255,0,0,0.3)';elseif ($h['done_time']==NULL&&$h['del']!=1) echo 'rgba(255,145,0,0.3)';?>;display:inline-block;width:10%;height: 100%;vertical-align: top; ">
                         <div style=" position:relative;top:50px;font-size: 200%;font-family:Microsoft YaHei;height :40px;width:100px;margin:0 auto;margin-top:3px;"><?php 
                            if ($h['done_time']!=NULL&&$h['del']!=1) {echo '已完成'; $status=1;}
                            elseif ($h['del']==1) {echo '已删除'; $status=-1;} 
                            elseif ($h['done_time']==NULL&&$h['del']!=1) {echo '未完成'; $status=0;}
                         ?></div>
                     </div><!--    
                  --><div style="display:inline-block;width:10%;height: 100%;vertical-align: top; ">
                             <span style="background-color:rgba(60,255,0,0.4);font-size: 150%;font-family:Microsoft YaHei;display:block; height:25%;width:100%">创建</span>
                             <span style="background-color:rgba(255,166,0,0.4);display:block;height:25%;width:100%;font-size: 150%;font-family:Microsoft YaHei;">最后一次编辑</span>
                             <span style="background-color:rgba(0,191,255,0.4);display:block;height:25%;width:100%;font-size: 150%;font-family:Microsoft YaHei;">完成</span>
                             <sapn style="background-color:rgba(255,0,0,0.4);display:block;height:25%;width:100%;font-size: 150%;font-family:Microsoft YaHei;">删除</span>
                     </div><!--
                  --><div style="display:inline-block;width:30%;height: 100%;vertical-align: top; ">
                             <span style="display:block; height:25%;width:100%;font-size: 150%;font-family:Microsoft YaHei;"><?php if ($h['create_time']!=NULL) echo $h['create_time'];else echo '------';?></span>
                             <span style="display:block;height:25%;width:100%;font-size: 150%;font-family:Microsoft YaHei;"><?php if ($h['edit_time']!=NULL) echo $h['edit_time'];else echo '------';?></span>
                             <span style="display:block;height:25%;width:100%;font-size: 150%;font-family:Microsoft YaHei;"><?php if ($h['done_time']!=NULL) echo $h['done_time'];else echo '------';?></span>
                             <span style="display:block;height:25%;width:100%;font-size: 150%;font-family:Microsoft YaHei;"><?php if ($h['del_time']!=NULL) echo $h['del_time'];else echo '------';?></span>
                     </div><!--
                  --><div style="display:inline-block;width:20%;height: 100%;vertical-align: top; ">
                      <div style="display:inline-block;width:30%;height: 100%;vertical-align: top; ">
                         <div style="font-size: 200%;font-family:Microsoft YaHei;height :50px;width:100px;margin:0 auto;margin-top:20px;">
                             <button <?php if ($status==1||$status==0) ;else echo 'disabled="disable"'; ?>class="btn btn-warning" name="action" value="EDIT-<?php echo $h['id']; ?>" style="width:80px;height:50px;font-size: 90%;font-family:Microsoft YaHei;" >编辑</button>
                         </div>
                         <div style="font-size: 200%;font-family:Microsoft YaHei;height :50px;width:100px;margin:0 auto;margin-top:20px;">
                             <button <?php if ($status==-1) ;else echo 'disabled="disable"'; ?> style="width:80px;height:50px;font-size: 90%;font-family:Microsoft YaHei;"class="btn btn-info" name="action" value="RE-<?php echo $h['id']; ?>" >恢复</button>
                         </div>
                      </div>
                      <div style="display:inline-block;width:70%;height: 100%;vertical-align: top; ">
                         <div style="font-size: 200%;font-family:Microsoft YaHei;height :50px;width:180px;margin:0 auto;margin-top:20px;">
                             <button <?php if ($status==1) ;else echo 'disabled="disable"'; ?> class="btn btn-success" name="action" value="NDONE-<?php echo $h['id']; ?>" style="width:180px;height:50px;font-size: 90%;font-family:Microsoft YaHei;" >恢复为未完成</button>
                         </div>
                         <div style="font-size: 200%;font-family:Microsoft YaHei;height :50px;width:180px;margin:0 auto;margin-top:20px;">
                             <button  style="width:180px;height:50px;font-size: 90%;font-family:Microsoft YaHei;"class="btn btn-danger" name="action" value="RD-<?php echo $h['id']; ?>" >彻底删除</button>
                         </div>
                      </div>
                     </div>
                 </div>
        <?php }?>
            </form>
        </div>
    </body>
    </html>