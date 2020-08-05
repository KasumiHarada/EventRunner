<?php

define('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../model/');
define('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'] . '/../view/');

define('STYLESHEET_PATH', '/assets/css/');
define('IMAGE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/assets/images/' );
$img_dir ='./assets/images/'; // アップロードした画像ファイルの保存ディレクトリ

// define('DB_HOST', 'localhost');
// define('DB_NAME', 'eventrunner');
// define('DB_USER', 'root');
// define('DB_PASS', 'v76FkiUts');

define('DB_HOST', 'mysql');
define('DB_NAME', 'eventrunner');
define('DB_USER', 'testuser');
define('DB_PASS', 'password');
define('DB_CHARSET', 'utf8');

define('HOME_URL', '/index.php');
define('DETAIL_URL', '/detail.php');
define('SIGNUP_URL', '/signup.php');
define('LOGIN_URL', '/login.php'); 
define('LOGOUT_URL', '/logout.php');
define('HOME_URL', '/index.php');  // 編集
define('HISTORY_URL', '/history.php');
define('DETAIL_URL', '/purchase_detail.php'); // 編集
define('CREATE_EVENT_URL', '/create_event.php');
define('MYPAGE_URL', '/mypage.php');
define('SEARCH_URL', '/events.php');

define('REGEXP_ALPHANUMERIC', '/\A[0-9a-zA-Z]+\z/');
define('REGEXP_POSITIVE_INTEGER', '/[0-9]{2}/'); // 定員
define('REGEXP_EMAIL', '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD'); // email

define('USER_NAME_LENGTH_MIN', 1);
define('USER_NAME_LENGTH_MAX', 10);
define('USER_PASSWORD_LENGTH_MIN', 8);
define('USER_PASSWORD_LENGTH_MAX', 100);
define('INTRODUCTION_LENGTH_MIN', 1);
define('INTRODUCTION_LENGTH_MAX', 100);

define('STR_LENGTH_MIN', 1);
define('STR_LENGTH_MAX', 50);

define('EVENT_NAME_LENGTH_MIN', 1);
define('EVENT_NAME_LENGTH_MAX', 30);

define('NOW_DATE', DATE('Y-m-d'));