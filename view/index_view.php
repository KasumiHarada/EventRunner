<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
    <title>トップページ</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/messages.php'; ?>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>

<div class ="container">
    <h1>イベント一覧</h1>
    <div class="row">
        <?php foreach($events as $event){?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php print $event['event_name'];?></h5>
                        <p class="card-text"><?php print $event['location'];?></p>
                       
                        <form method ="POST" action="detail.php">
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