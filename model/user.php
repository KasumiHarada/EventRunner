<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// 送られてきたuserIDに一致するuser情報を取り出す
function get_user($db, $user_id){
  $sql = "
    SELECT
      user_id, 
      name,
      password
    FROM
      users
    WHERE
      user_id = ?
    LIMIT 1
  ";

  return fetch_query($db, $sql, array($user_id));
}

// emailに一致するユーザー情報をひとつ取得する●
function get_user_by_email($db, $email){
  $sql = "
    SELECT
      user_id, 
      name,
      password,
      email
    FROM
      users
    WHERE
      email = ?
  ";

  return fetch_query($db, $sql, array($email));
}

// user_idから、userの名前と紹介を取り出して表示●
function get_user_info($db, $user_id){
  $sql=" 
    SELECT 
      name, 
      img,
      introduction
    FROM
      users
    WHERE user_id =:user_id;
  ";

  return fetch_query($db, $sql, array($user_id));
}

// insert文でpaticipantsテーブルに追加●
function insert_paticipants($db, $user_id, $event_id){
  
  $sql="
  INSERT INTO
    paticipants(
    user_id,
    event_id
    )
    VALUES(
    :user_id,
    :event_id
    )
  ";

  execute_query($db, $sql, array($user_id, $event_id));

}

// // バリデーション後問題なければ、regist_item_transaction関数に進む
// function regist_item($db, $name, $price, $stock, $status, $image){
//   $filename = get_upload_filename($image);
//   if(validate_item($name, $price, $stock, $filename, $status) === false){
//     return false;
//   }
//   return regist_item_transaction($db, $name, $price, $stock, $status, $image, $filename);
// }


// nameに一致するユーザー情報をひとつ取得する→falseなら弾く。OKならsessionにuser_idを返す
function login_as($db, $email, $password){
  $user = get_user_by_name($db, $email);
  if($user === false || $user['password'] !== $password){
    return false;
  }
  set_session('user_id', $user['user_id']);
  return $user;
}

// login済みのユーザーIDとパスワードをセッションから取得して返す●
function get_login_user($db){
  $login_user_id = get_session('user_id');

  return get_user($db, $login_user_id);
}

// 送信されたユーザー情報に問題なければ、insert_user関数でユーザー情報をDBに登録する
function regist_user($db, $name, $password, $password_confirmation) {
  if( is_valid_user($name, $password, $password_confirmation) === false){
    return false;
  }
  
  return insert_user($db, $name, $password);
}

// user のtypeを返す(admin:1、user:2）
function is_admin($user){
  return $user['type'] === USER_TYPE_ADMIN;
}

function is_valid_user($name, $password, $password_confirmation){
  // 短絡評価を避けるため一旦代入。
  $is_valid_user_name = is_valid_user_name($name);
  $is_valid_password = is_valid_password($password, $password_confirmation);
  return $is_valid_user_name && $is_valid_password ;
}

// user_nameの文字数と文字列をチェックし結果をtrueかfalseで返す
function is_valid_user_name($name) {
  $is_valid = true;
  if(is_valid_length($name, USER_NAME_LENGTH_MIN, USER_NAME_LENGTH_MAX) === false){
    set_error('ユーザー名は'. USER_NAME_LENGTH_MIN . '文字以上、' . USER_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  if(is_alphanumeric($name) === false){
    set_error('ユーザー名は半角英数字で入力してください。');
    $is_valid = false;
  }
  return $is_valid;
}

// パスワードをチェックして結果を
function is_valid_password($password, $password_confirmation){
  $is_valid = true;
  if(is_valid_length($password, USER_PASSWORD_LENGTH_MIN, USER_PASSWORD_LENGTH_MAX) === false){
    set_error('パスワードは'. USER_PASSWORD_LENGTH_MIN . '文字以上、' . USER_PASSWORD_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  if(is_alphanumeric($password) === false){
    set_error('パスワードは半角英数字で入力してください。');
    $is_valid = false;
  }
  if($password !== $password_confirmation){
    set_error('パスワードがパスワード(確認用)と一致しません。');
    $is_valid = false;
  }
  return $is_valid;
}

// ユーザー情報をDBに登録する
function insert_user($db, $name, $hash){
  

  $sql = "
    INSERT INTO
      users(name, password, img, introduction)
    VALUES ( ?, ?, ?, ?);
  ";
 
  return execute_query($db, $sql, array($name, $hash));
}


