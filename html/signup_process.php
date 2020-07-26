<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/user.php';
////
$new_img_filename =''; //アップロードした画像の新しいファイルネーム
///

session_start();

// DBに接続する
$db = get_db_connect();

// ログイン済みか確認し、trueならtopページへリダイレクト
if(is_logined() === true){
  redirect_to(HOME_URL);
}

// post 送信された値を変数へ格納
$name = get_post('name');
$password = get_post('password');
$email = get_post('email');
$introduction = get_post('introduction');

// アップロード画像ファイルの保存
// HTTP POST でファイルがアップロードされたかどうかチェック
if (is_uploaded_file($_FILES['new_img']['tmp_name']) === TRUE) {
  // 画像の拡張子を取得
  $extension = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
  // 指定の拡張子であるかどうかチェック
  if ($extension === 'jpg' || $extension === 'jpeg') {
    // 保存する新しいファイル名の生成（ユニークな値を設定する）
    $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
    // 同名ファイルが存在するかどうかチェック
    if (is_file($img_dir . $new_img_filename) !== TRUE) {
      // アップロードされたファイルを指定ディレクトリに移動して保存
      if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
          set_error('ファイルアップロードに失敗しました');
      }
    } else {
      set_error('ファイルアップロードに失敗しました。再度お試しください。');
    }
  } else {
    set_erro('ファイル形式が異なります。画像ファイルはJPEGのみ利用可能です。');
  }
} else {
  set_error('ファイルを選択してください');
}


// 各項目の入力チェック
if (validate_user_info($name, $introduction, $email, $password, $new_img_filename)){

}

// post送信されたemailに一致する情報を検索する
$user = get_user_by_email($db, $email);

// エラーがなしで、かつ、同じ名前のユーザが存在しなければ、登録する
if (!isset ($user['email'])){

  if (insert_user($db, $name, $email, $password, $new_img_filename, $introduction)){
    set_message('ユーザー登録が完了しました。');
    //login_as($db, $name, $password);   
    redirect_to(HOME_URL);
  }
  
} else if (isset ($user['email'])) {
    set_error('既に登録済のメールアドレスです。他のメールアドレスを登録してください。');
    redirect_to(SIGNUP_URL);
} // (!isset ($result) おわり