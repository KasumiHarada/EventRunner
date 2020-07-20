<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
    <title>トップページ</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header.php'; ?>
<h1>イベント一覧</h1>
<ul>
    <li><a href="">ABOUT</a></li>
    <li><a href="create_event.php">イベントを主催する</a></li>
    <li><a href="">イベントを探す</a></li>
    <li><a href="">マイページ</a></li>
    <li><a href="create_event.php">ログアウト</a></li>
</ul>

<ul>
<?php foreach($events as $event){?>
    <li><?php print $event['event_name'];?></li>
    <li>場所：<?php print $event['location'];?><a href ="detail.php">詳細</a></li>
<?php } ?>
</ul>


</body>
</html>