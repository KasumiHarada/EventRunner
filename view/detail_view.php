<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php';?>
    <title>イベント詳細ページ</title>
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <?php include 'templates/messages.php'; ?>
    <div class="container">
    <h2>イベント詳細ページ</h2>
    
        <li>題名：<?php print h($events['event_name']);?></li>
        <li>日時：<?php print h($events['date']);?></li>
        <li>場所：<?php print h($events['location']);?></li>
        <li>住所：<?php print h($events['address']);?></li>
        <li>時間：<?php print h($events['time']);?></li>
        <li>概要：<?php print h($events['introduction']);?></li>
        <li>定員：<?php print h($events['capacity']);?>名</li>
    
        <h2>参加者</h2>        
        
        <div class="row">
          <?php foreach ($paticipants as $paticipant){ ?>
              <div class="col-sm-3">
                  <div class="card">
                      <div class="card-body">
                      <p><?php print h($paticipant['name']);?></p>
                      <p><img src="<?php print $img_dir. h($paticipant['img']);?>" width=200 height =100></p>
                      </div>
                  </div>
              </div>
          <?php } // foreachおわり?>
        </div>
      
        <?php if ($isset_paticipant === false){?>
          <form method ="POST" action ="paticipant.php">
            <input type="submit" value="参加する" class="btn btn-info">
            <input type="hidden" name="event_id" value="<?php print $events['event_id'];?>"> 
            <input type="hidden" name="action" value="join">        
          </form>
        <?php } else { ?>         
          <form method ="POST" action ="paticipant.php">
            <input type="submit" value="参加を取りやめる" class="btn btn-danger">
            <input type="hidden" name="event_id" value="<?php print $events['event_id'];?>">  
            <input type="hidden" name="action" value="delete">       
          </form>
        <?php }?>

        <h2>コメント一覧</h2>
        <div class="d-flex justify-content-center">
          <div class="form-group">
            <form method="POST" action="detail.php?event_id=<?php print $events['event_id'];?>">
              <input type="text" name="comment" size="60">
              <input type="submit" value="送信" class="btn btn-info">
              <input type="hidden" name="action" value="comment">  
            </form>
            
              <ul class="list-group list-group-flush">
              <?php foreach($comments as $comment){ ?>
                <li><?php print $comment['name'];?></li>
                <li class="list-group-item"><?php print $comment['comment'].'-'.$comment['create_datetime'];?></li>
                <?php }?>
              </ul>
           
          </div>
        </div>
    </div>
</body>
<?php include VIEW_PATH . 'templates/footer_logined.php'; ?>
</html>