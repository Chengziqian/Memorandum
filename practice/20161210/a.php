<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form action="a.php" method="get"> <!-- get / post -->
            <p>你的名字是啥：
                <input type="text" name="name">
            </p> 
            <button>提交</button>
        </form>
        <p>欢迎,<?php echo $_GET['name']; ?></p>
        <pre><?php
        // $a = ['aaa', 'bbb'];
        // var_dump($a);
        var_dump($_GET);
        var_dump($_POST);
        ?></pre>
        </form>
    </body>
</html>
