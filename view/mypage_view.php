<!DOCTYPE html>
<html lang="ja">
<head>
  <title>マイページ</title>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>
<div class="container">
  <div class ="row">
    <div class="col-sm-5">
      <h2>プロフィール</h2>
      <p>自己紹介</p>
      <div class="card" style="width:400px">
        <img class="card-img-top" src="<?php print $img_dir. $user['img'];?>" alt="img" style="width:100%">
        <div class="card-body">
          <h4 class="card-title"><?php print $user['name'];?></h4>
          <p class="card-text"><?php print $user['introduction'];?></p>
        </div>
      </div>
    </div>

    <div class="col-sm-7">
      <h2>Accordion Example</h2>
      
      <h4>参加予定のイベント</h4>
      <?php foreach ($events as $event){;?>
        <?php if(strtotime($event['date']) > strtotime(NOW_DATE)){ ?>
          <li><a href="detail.php?event_id=<?php print $event['event_id'];?>"><?php print $event['event_name'];?></a></li>
        <?php } ?>
      <?php } // foreachおわり?>
     
      <h4>参加履歴</h4>
      <?php foreach ($events as $event){;?>
        <?php if(strtotime($event['date']) < strtotime(NOW_DATE)){?>
          <li><a href="detail.php?event_id=<?php print $event['event_id'];?>"><?php print $event['event_name'];?></a></li>
        <?php } ?>
      <?php } // foreachおわり?>
      </div>


  </div>

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
        <td><?php print h($hostEvent['event_name']);?></td>
        <td><?php print h($hostEvent['date']);?></td>
        <td><?php print h($hostEvent['time']);?></td>
        <td><?php print h($hostEvent['location']);?></td>
        <td><?php print h($hostEvent['introduction']);?></td>
        <td>
          <form method="POST" action="">
            <input type="text" size="3" value="<?php print h($hostEvent['capacity']);?>">名
            <input type="hidden" value="<?php print $hostEvent['event_id'];?>">
            <input type="submit" value="変更">
          </form>
        </td>
      </tr>
    <?php }?>  
  </tbody>
　</table>
</div>


  
    
</body>
<?php include VIEW_PATH . 'templates/footer_logined.php'; ?>
</html>   