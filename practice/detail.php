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
        <title>详情</title>
    </head>
    <body>
        <div class="container">
            <h1 align="center">备忘录</h1>
            <div class="pull-right"><a href="index.php">返回主页</a></div>
            <hr>

            <h2><?php echo urldecode($thing['title']); ?></h2>
            <div align="right">
                <a href="edit.php?id=<?php echo $thing['id'];?>"><button class="btn btn-info">编辑</button></a>
            </div>
            <pre><?php echo urldecode($thing['content']); ?></pre>

            <hr>
            <div align="center">Copyright &copy; 2016 By GuessEver</div>
        </div>
    </body>
</html>
