<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>サインアップ</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'signup.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header.php'; ?>
  <div class="container">
    <h1>ユーザー登録</h1>

    <?php //include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post" action="signup_process.php" class="signup_form mx-auto">
      <div class="form-group">
        <label for="name">名前: </label>
        <input type="text" name="name" id="name" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="password_confirmation">紹介文: </label>
        <input type="text" name="introduction" id="introduction" class="form-control">
      </div>
      <div class="form-group">
        <label for="password_confirmation">メールアドレス: </label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
        <label for="password_confirmation">写真: </label>
        <input type="file" name="image" id="image">

      <input type="submit" value="登録" class="btn btn-block btn-primary">
    </form>
  </div>
</body>
</html>