<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
    <title>イベント登録ページ</title>
</head>
<body>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>
<?php include VIEW_PATH . 'templates/messages.php'; ?>
<h1>イベント登録ページ</h1>

<?php //if ($mode === 'input'){ ?>
<?php //|| count ($err_msg)>0?>
    <!--入力画面のページ-->
    <div class ="container">
        <div class="contact_confirm">
            <form method="post" action="create_event.php" class="signup_form mx-auto">
                <div class="form-group">
                    <lavel for="event_name">題名</lavel>
                    <input type="text" name="event_name" class="form-control" value="<?php print $_SESSION['event_name'];?>"/>
                </div>
                <div class="form-group">
                    <lavel for="name">代表者名</lavel>
                    <input type="text" name="name" placeholder="山田　花子" class="form-control" value="<?php print $_SESSION['name'];?>"/>
                </div>
                <div class="form-group">
                    <lavel for="email">代表のメールアドレス</lavel>
                    <input type="email" name="email" class="form-control" value="<?php print $_SESSION['email'];?>"/>
                </div>
                <div class="form-group">
                    <lavel for="date">開催日</lavel>
                    <input type="date" name="date" class="form-control" value="<?php print $_SESSION['date'];?>"/>
                </div>
                <div class="form-group">
                    <lavel for="time">開催時間</lavel>
                    <input type="time" name="time" class="form-control" value="<?php print $_SESSION['time'];?>"/>
                </div>
                <div class="form-group">
                    <lavel for="location">開催場所</lavel>
                    <input type="text" name="location" class="form-control" value="<?php print $_SESSION['location'];?>"/>
                </div>
                <div class="form-group">
                    <lavel for="address">住所</lavel>
                    <input type="text" name="address" class="form-control" value="<?php print $_SESSION['address'];?>"/>
                </div>
                <div class="form-group">
                    <lavel for="introduction">イベントの情報</lavel>
                    <textarea type="text" name="introduction" class="form-control"><?php print $_SESSION['introduction'];?></textarea>
                </div>
                
                <div class="button">
                    <input type="submit" name="send" value="確認" class="btn btn-block btn-primary">
                    <input type="hidden" name="action" value="send">
                </div>
            </form>
        </div>
    </div>
<?php //} else if ($mode ==='confirm'){ ?>
<?php //  && count ($err_msg)===0?>
    <!-- <div class="contact_confirm">
        <!--確認画面のページ-->
        <!-- <form method="POST" action="create_event.php">
            <li>題名:<?php print $_SESSION['event_name'];?></li>
            <li>名前：<?php print $_SESSION['name'];?></li>
            <li>代表のメールアドレス：<?php print $_SESSION['email'];?></li>
            <li>時間：<?php print $_SESSION['date'];?></li>
            <li>開催時間：<?Php print $_SESSION['time'];?></li>
            <li>開催場所：<?php print $_SESSION['location'];?></li>
            <li>住所：<?php print $_SESSION['address'];?></li>
            <li>イベントの情報：<?php print $_SESSION['info'];?></li> 
          
            <div class="button">
                <input type="submit" name="back" value="戻る" class="btn btn-secondary">
                <input type="hidden" name="action" value="back">
                <input type="submit" name="send" value="送信" class="btn btn-primary">
                <input type="hidden" name="action" value="send">
                
            </div>
        </form> -->
    <!-- </div>  -->

<?php //} else {?>
    <!-- <p class="send_message">イベントを作成しました。</p> -->
<?php //} ?>
</body>
</html>