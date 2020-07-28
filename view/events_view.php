<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
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
    　　<h2>イベント一覧</h2>
        <div class="row">
            <?php foreach($events as $event){?>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php print $event['event_name'];?></h5>
                            <p class="card-text"><?php print $event['location'];?></p>
                            <p class="card-text">定員：<?php print $event['capacity'];?>名</p>
                            <form method ="GET" action="detail.php">
                                <input type="submit" class="btn btn-primary" value="詳細">
                                <input type="hidden" name="event_id" value="<?php print $event['event_id'];?>">
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>  
    </div>

</body>
</html>    