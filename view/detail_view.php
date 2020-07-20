<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
    <title>イベント詳細ページ</title>
</head>
<body>
    <h1>イベント詳細ページ</h1>

        <li>題名：<?php print $events['event_name'];?></li>
        <li>日時：<?php print $events['date'];?></li>
        <li>場所：<?php print $events['location'];?></li>
        <li>概要：<?php print $events['introduction'];?></li>

    <form method ="POST" action ="paticipant.php">
        <input type="submit" value="参加する" class="btn btn-primary">
        <input type="hidden" name="event_id" value="<?php print $events['event_id'];?>">        
    </form>
</body>
</html>