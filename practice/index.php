<?php
date_default_timezone_set('PRC');
$conn_hostname = 'localhost';
$conn_database = 'memorandum';
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

if(isset($_POST['action'])) { // 有请求
    if($_POST['action'] === 'ADD') {
        // 这里请自学PDO::PREPARE的用法
        $sql = $pdo->prepare('INSERT INTO things (`created_time`, `done_time`, `title`, `content`)
            VALUES (:created_time, :done_time, :title, :content);');
        $sql->bindValue(':created_time', date('Y-m-d H:m:s', time()));
        $sql->bindValue(':done_time', '');
        $sql->bindValue(':title', urlencode($_POST['newThing']));   # urlencode 把字符串编码为安全字符串，对应解码函数为 urldecode
        $sql->bindValue(':content', '');
        $sql->execute();
    }
    else if(substr($_POST['action'], 0, 3) === 'DEL') {
        $id = substr($_POST['action'], 4);
        $sql = $pdo->prepare('DELETE FROM things WHERE `id` = :id;');
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
    else if(substr($_POST['action'], 0, 4) === 'DONE') {
        $id = substr($_POST['action'], 5);
        $sql = $pdo->prepare('UPDATE things SET `done_time` = :done_time WHERE `id` = :id;');
        $sql->bindValue(':done_time', date('Y-m-d H:m:s', time()));
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}

$sql = $pdo->prepare('SELECT * FROM things WHERE `done_time` = "";');
$sql->execute();
$things_undo = $sql->fetchall(PDO::FETCH_ASSOC);

$sql = $pdo->prepare('SELECT * FROM things WHERE `done_time` <> "";');
$sql->execute();
$things_done = $sql->fetchall(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
        <title>备忘录</title>
    </head>
    <body>
        <h1 align="center">备忘录</h1>
        <hr>
        <div class="container">
            <form action="index.php" method="post">
                <table class="table">
                    <tr>
                        <td></td>
                        <td>
                            <input class="form-control" type="text" name="newThing">
                        </td>
                        <td>
                            <input type="submit" class="btn btn-success" value="ADD" name="action">
                        </td>
                    </tr>
                    <?php foreach ($things_undo as $thing) { ?>
                    <tr>
                        <td>
                            <input type="submit" class="btn btn-success btn-xs" value="DONE-<?php echo $thing['id'];?>" name="action">
                        </td>
                        <td><a href="detail.php?id=<?php echo $thing['id'];?>"><?php echo urldecode($thing['title']); ?></td>
                        <td>
                            <input type="submit" class="btn btn-default" value="DEL-<?php echo $thing['id'];?>" name="action">
                        </td>
                    </tr>
                    <?php } ?>
                    <?php foreach ($things_done as $thing) { ?>
                    <tr>
                        <td>已完成</td>
                        <td><a href="detail.php?id=<?php echo $thing['id'];?>"><del><?php echo urldecode($thing['title']); ?></del></td>
                        <td>
                            <input type="submit" class="btn btn-default" value="DEL-<?php echo $thing['id'];?>" name="action">
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </form>
        </div>

        <hr>
        <div align="center">Copyright &copy; 2016 By GuessEver</div>
    </body>
</html>
