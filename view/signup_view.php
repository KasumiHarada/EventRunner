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

    <?php include 'templates/messages.php'; ?>

    <form method="post" action="signup_process.php" enctype= "multipart/form-data" class="signup_form mx-auto">
      <div class="form-group">
        <label for="name">名前: </label>
        <input type="text" name="name" id="name" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="introduction">紹介文: </label>
        <input type="text" name="introduction" id="introduction" class="form-control">
      </div>
      <div class="form-group">
        <label for="email">メールアドレス: </label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
        <label for="image">写真: </label>
        <input type="file" name="new_img" id="image">

      <input type="submit" value="登録" class="btn btn-block btn-info">
    </form>
  </div>
</body>
</html>