<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php';?>
    <title>イベント詳細ページ</title>
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <?php include 'templates/messages.php'; ?>
    <h1>イベントを探す</h1>
    <div class ="container">  
    <div class="float-right">
        <form method="GET" action ="events.php">
        <select name="sort">
            <option value="new" <?php if ($_SESSION['sort']=== 'new'){print 'selected';}?>>新着順</option>
            <option value="lower"<?php if ($_SESSION['sort']=== 'lower'){print 'selected';}?>>定員の少ない順</option>
            <option value="higher"<?php if ($_SESSION['sort']=== 'higher'){print 'selected';}?>>定員の多い順</option>
        </select>
        <input type="submit" name="sort_button" value="並べ替え">
        </form>
  　</div>
    　　<h3>イベント一覧</h3>
        <div class="row">
        
            <?php foreach($events as $event){?>
              <?php if(strtotime($event['date']) > strtotime(NOW_DATE)){ ?>
                <div class="col-sm-3">
                  <div class ="mt-5">
                    <div class="card">                  
                      <div class="card-body">
                        <h4 class="card-title"><?php print h($event['event_name']);?></h4>
                        <p class="card-text"><?php print h($event['location']);?></p>
                        <p class="card-text">定員：<?php print h($event['capacity']);?>名</p>
                            <form method ="GET" action="detail.php">
                                <input type="submit" class="btn btn-info" value="詳細">
                                <input type="hidden" name="event_id" value="<?php print $event['event_id'];?>">
                            </form>
                      </div> 
                    </div>
                  </div>
                </div>  
              <?php } ?>   
            <?php } ?>
        </div>  
    </div>

</body>
<?php include VIEW_PATH . 'templates/footer_logined.php'; ?>
</html>    