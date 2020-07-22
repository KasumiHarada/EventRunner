<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>マイページ</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'signup.css'); ?>">
</head>
<body>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <div class="container">
    <h1>マイページ</h1>
    <p>お名前：<?php print $user['name'];?></p>
    <p>自己紹介：<?php print $user['introduction'];?></p>
    <h4>参加予定のイベント</h4>
    <?php foreach ($events as $event){;?>
      <li><?php print $event['event_name'];?></li>
    <?php } ?>
    <h4>主催予定のイベント</h4>


 



  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">題名</th>
      <th scope="col">日付</th>
      <th scope="col">時間</th>
      <th scope="col">場所</th>
      <th scope="col">概要</th>
      <th scope="col">定員</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($hostEvents as $hostEvent){ ?>
      <tr>
        <th scope="row">1</th>
        <td><?php print $hostEvent['event_name'];?></td>
        <td><?php print $hostEvent['date'];?></td>
        <td><?php print $hostEvent['time'];?></td>
        <td><?php print $hostEvent['location'];?></td>
        <td><?php print $hostEvent['introduction'];?></td>
        <td><?//php print $hostEvent[''];?></td>
      </tr>
    <?php }?>  
  </tbody>
</table>
  </div>
</body>
</html>    