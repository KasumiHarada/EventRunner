<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
    <title>イベント詳細ページ</title>
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <div class="container">
    <h2>イベント詳細ページ</h2>
        <li>題名：<?php print $events['event_name'];?></li>
        <li>日時：<?php print $events['date'];?></li>
        <li>場所：<?php print $events['location'];?></li>
        <li>住所：<?php print $events['address'];?></li>
        <li>時間：<?php print $events['time'];?></li>
        <li>概要：<?php print $events['introduction'];?></li>
        <li>定員：<?php print $events['capacity'];?>名</li>
    
        <h2>参加者</h2>
        
        
        <div class="row">
        <?php foreach ($paticipants as $paticipant){ ?>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                    <p><?php print $paticipant['name'];?></p>
                    <p><img src="<?php print $img_dir. $paticipant['img'];?>" width=200 height =100></p>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
      

        <?php if ($paticipant['user_id'] === $user['user_id']){ ?>
          <form method ="POST" action ="paticipant.php">
            <input type="submit" value="参加を取りやめる" class="btn btn-danger">
            <input type="hidden" name="event_id" value="<?php print $events['event_id'];?>">  
            <input type="hidden" name="action" value="delete">       
          </form>
        <?php } else { ?>         
          <form method ="POST" action ="paticipant.php">
            <input type="submit" value="参加する" class="btn btn-primary">
            <input type="hidden" name="event_id" value="<?php print $events['event_id'];?>"> 
            <input type="hidden" name="action" value="join">        
          </form>
        <?php }?>
        <h2>コメント一覧</h2>
        <div class="form-group">
        <form method="POST" action="comment.php">
            <input type="text" name="comment" size="60">
            <input type="submit" value="送信" class="btn btn-primary">
            <input type="hidden" name="action" value="comment">  
        </form>
        </div>
    </div>
</body>
</html>