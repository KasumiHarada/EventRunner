<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>ログイン</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'login.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header.php'; ?>
  <?php include VIEW_PATH . 'templates/messages.php'; ?>
  <div class="container">
    <h1>ログイン</h1>

    <form method="post" action="login_process.php" class="login_form mx-auto">
      <div class="form-group">
        <label for="email">メールアドレス: </label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <input type="submit" value="ログイン" class="btn btn-block btn-info">
      <input type="hidden" name="token" value="<?php print $_SESSION['token'];?>">
    </form>
  </div>
</body>
</html>