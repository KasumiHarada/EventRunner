<?php
require_once '../conf/const.php';
require_once '../model/functions.php';

// ログアウト処理
session_start();
$_SESSION = array();
$params = session_get_cookie_params();
setcookie(session_name(), '', time() - 42000,
  $params["path"], 
  $params["domain"],
  $params["secure"], 
  $params["httponly"]
);
session_destroy();

redirect_to(LOGIN_URL);

