<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php';?>
    <title>トップページ</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>
<?php include 'templates/messages.php'; ?>
<div class ="container">
    <h1>EventRunnerについて</h1> 
    <img src="../assets/images/workshop_img.jpg" alt="ワークショップの写真" width="350" height="250">
    <img src="../assets/images/volunteer.jpg" alt="ボランテイアの写真" width="350" height="250"> 
    <h2>使い方</h2> 
  
        <h3>イベントを主催する</h3>
        <p>イベント情報を入力し、イベントを主催しよう！</p>
    
        <h3>イベントを探す</h3>
        <p>イベントを探すから、あなたに必要なイベントを検索することができます</p>

        <h3>イベントを管理する</h3>
        <p>マイページでは、参加予定・主催予定のイベントが確認できます</p>

</div>
</body>
<?php include VIEW_PATH . 'templates/footer_logined.php'; ?>
</html>