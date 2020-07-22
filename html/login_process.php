<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/user.php';

session_start();

// DBに接続する
$db = get_db_connect();

if ($_SERVER['REQUEST_METHOD']==='POST'){

    // post送信された値を変数に格納
    $email    = get_post('email');
    $password = get_post('password');

    // emailに一致するユーザを取り出す user.php
    $user = get_user_by_email($db, $email);

    // メールアドレスが登録済みだったら
    if (isset ($user['email']) ){
           
        // 入力されたパスワードとハッシュ化されたパスワードの検証
        if (password_verify ($password, $user['password'])){
            // -----ユーザ名とパスワードが一致している場合-----
            
            // emailとパスワードが一致していることが確認済→$_SESSIONにselect文で取得したuser_idとnameを格納
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];

            // // 管理者の場合→管理ページへ
            // if ($name === 'admin'){ 
            //     header('Location: admin.php');
            //     exit;
            // } else {
            //     header('Location: index.php');
            //     exit;
            // }
            
        } else {
            set_error('パスワードが違います。');
        } // password検証おわり
    
    } else {
        set_error('ユーザー名またはパスワードが違います。');
    }// isset($user)おわり 

    redirect_to(HOME_URL);
    
} // $_SERVERおわり        