<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include '../view/templates/head.php';?>
    <title>イベント登録ページ</title>
</head>
<body>
<h1>イベント登録ページ</h1>

<?php if ($mode === 'input'){ ?>
<?php //|| count ($err_msg)>0?>
    <!--入力画面のページ-->
    <div class="contact_confirm">
        <form method="POST" action="create_event.php">
            <li><lavel for="event_name">題名</lavel><input type="text" name="event_name" value="<?php print $_SESSION['event_name'];?>"/></li>
            <li>
                <lavel for="name">代表者名</lavel>
                <input type="text" name="name" placeholder="山田　花子" value="<?php print $_SESSION['name'];?>"/>
            </li>
            <li>
                <lavel for="email">代表のメールアドレス</lavel>
                <input type="email" name="email" value="<?php print $_SESSION['email'];?>"/>
            </li>
             <li>
                <lavel for="date">開催日</lavel>
                <input type="date" name="date" value="<?php print $_SESSION['date'];?>"/>
            </li>
            <li>
                <lavel for="time">開催時間</lavel>
                <input type="time" name="time" value="<?php print $_SESSION['time'];?>"/>
            </li>
            <li>
                <lavel for="location">開催場所</lavel>
                <input type="text" name="location" value="<?php print $_SESSION['location'];?>"/>
            </li>
            <li>
                <lavel for="address">住所</lavel>
                <input type="text" name="address" value="<?php print $_SESSION['address'];?>"/>
            </li>
            <li>
                <lavel for="info">イベントの情報</lavel>
                <textarea type="text" name="info"><?php print $_SESSION['info'];?></textarea>
            </li>
            
            <div class="button">
                <input type="submit" name="confirm" value="確認" class="btn btn-primary">
                <input type="hidden" name="action" value="confirm">
            </div>
        </form>
    </div>
    
<?php } else if ($mode ==='confirm'){ ?>
<?php //  && count ($err_msg)===0?>
    <div class="contact_confirm">
        <!--確認画面のページ-->
        <form method="POST" action="create_event.php">
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
        </form>
    </div>

<?php } else {?>
    <p class="send_message">イベントを作成しました。</p>
<?php } ?>
</body>
</html>