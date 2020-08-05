<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'functions.php';
require_once MODEL_PATH.'user.php';

session_start();

// ログイン済みか確認し、trueならトップページへリダイレクト
if(is_logined() === true){
    redirect_to(HOME_URL);
}

// post送信された値を変数に格納
$email    = get_post('email');
$password = get_post('password');

// DBに接続する
$db = get_db_connect();

// emailに一致するユーザを取り出す user.php
$user = get_user_by_email($db, $email);

// sessionのtokenとpost（hidden）送信されたtokenを比較して問題なければ処理を続ける
if (isset($_POST['token']) ===false && $_POST['token'] !== $_SESSION['token']){
    // 不正な処理が行われたからsession情報消去
    redirect_to(LOGIN_URL);
    $_SESSION = array();
    exit;

// メールアドレスが登録済みでかつ空送信でなければ
} else if (isset ($user['email']) && $email !== '' && $password !==''){
        
    // 入力されたパスワードとハッシュ化されたパスワードの検証
    if (password_verify($password, $user['password'])){
        // -----ユーザ名とパスワードが一致している場合-----
        
        // emailとパスワードが一致していることが確認済→$_SESSIONにselect文で取得したuser_idとnameを格納
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];
        set_message('ログインしました。');

    } else {
        set_error('パスワードが違います。');
    } // password検証おわり

} else {
    set_error('ユーザー名またはパスワードが違います。');
}// isset($user)おわり 

redirect_to(HOME_URL);