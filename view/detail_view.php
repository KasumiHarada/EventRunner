<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
    <title>イベント詳細ページ</title>
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>イベント詳細ページ</h1>

        <li>題名：<?php print $events['event_name'];?></li>
        <li>日時：<?php print $events['date'];?></li>
        <li>場所：<?php print $events['location'];?></li>
        <li>住所：<?php print $events['address'];?></li>
        <li>時間：<?php print $events['time'];?></li>
        <li>概要：<?php print $events['introduction'];?></li>

    <form method ="POST" action ="paticipant.php">
        <input type="submit" value="参加する" class="btn btn-primary">
        <input type="hidden" name="event_id" value="<?php print $events['event_id'];?>">        
    </form>
    <h2>参加者</h2>
    <?php foreach ($paticipants as $paticipant){ ?>
        <li><?php print $paticipant['name'];?></li>
    <?php } ?>
</body>
</html>