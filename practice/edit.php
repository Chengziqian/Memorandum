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
    if($_POST['action'] === 'SAVE') {
        $sql = $pdo->prepare('UPDATE things SET `title` = :title, `content` = :content WHERE `id` = :id;');
        $sql->bindValue(':title', urlencode($_POST['title']));
        $sql->bindValue(':content', urlencode($_POST['content']));
        $sql->bindValue(':id', $_POST['id']);
        $sql->execute();
        header('Location: detail.php?id='.$_POST['id']);
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
        <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
        <title>编辑</title>
    </head>
    <body>
        <div class="container">
            <h1 align="center">备忘录</h1>
            <hr>
            <form action="edit.php?id=<?php echo $thing['id']; ?>" method="post">
                <input style="display:none;" name="id" value="<?php echo $thing['id']; ?>">
                <input class="form-control" type="text" placeholder="在此输入标题" value="<?php echo urldecode($thing['title']); ?>" name="title">
                <div align="right">
                    <a href="index.php"><button type="button" class="btn btn-default">返回主页</button></a>
                </div>
                <div>
                    <textarea class="form-control" placeholder="在此输入详情" name="content"><?php echo urldecode($thing['content']); ?></textarea>
                </div>
                <div align="center">
                    <input type="submit" class="btn btn-default" value="SAVE" name="action">
                </div>
            </form>


            <hr>
            <div align="center">Copyright &copy; 2016 By GuessEver</div>
        </div>
    </body>
</html>
