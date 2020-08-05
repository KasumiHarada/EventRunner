<!DOCTYPE html>
<html lang="ja">
<head>
  <title>EventRunner</title>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>EventRunner</h1>
  <p>イベントを主催・参加を管理するアプリケーションです</p> 
</div>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>

<?php include VIEW_PATH . 'templates/messages.php'; ?>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
      <h2>このサイトについて</h2>
      <h5>イベント管理アプリ</h5>
      <div class="fakeimg"><img src="../assets/images/workshop_img.jpg" alt="ワークショップの写真" width="350" height="200"></div>
      <p>開発者は、地域のボランテイア団体に所属し活動していました。所属する団体でのイベントの管理や参加表明など、SNSを用いて行っておりました。</p>
      <p>個人で、情報収集ができ、かつ、参加イベントの管理が行えるプラットフォームがあればいいなぁと思い、開発してみることにしました。</p>
      <p>行事の情報収集や参加表明などができるプラットフォームとしてお使いください。</p>
      
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <h2>イベントを主催する</h2>
      <h5>イベントを開こう</h5>
      <div class="fakeimg"><img src="../assets/images/volunteer.jpg" alt="ボランテイアの写真" width="350" height="200"></div>
      <style>
      img {
  width: 100%;

  object-fit: cover;
}
</style>
      <p>イベントを主催ページから、必要項目を入力し、イベントを開催することができます。</p>
      <br>
      <h2>イベントに参加する</h2>
      <h5>イベントに参加しよう</h5>
      <div class="fakeimg"><img src="../assets/images/paper.jpg" alt="子供の写真" width="350" height="200"></div>
      <p>イベントページから、興味があるイベントの情報を取得することができます。「参加」ボタンをクリックで、簡単に参加登録をすることができます。</p>
    </div>
  </div>
</div>

</body>
<?php include VIEW_PATH . 'templates/footer_logined.php'; ?>
</html>
