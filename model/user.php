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


function get_userid_from_paticipants($db,$user_id, $event_id){
  $sql ="
    SELECT 
      user_id,
      event_id 
    FROM
      paticipants 
    WHERE user_id =:user_id
    AND event_id =:event_id
  ";
  
  return fetch_query($db, $sql, array($user_id, $event_id));

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

  return execute_query($db, $sql, array($user_id, $event_id));

}

// 参加者を削除する
function delete_paticipants($db, $user_id, $event_id){
  $sql="
    DELETE FROM 
      paticipants 
    WHERE 
      user_id =:user_id 
    AND 
      event_id = :event_id
  ";
  return execute_query($db, $sql, array($user_id, $event_id));

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
  $user = get_user_by_email($db, $email);
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

// // 送信されたユーザー情報に問題なければ、insert_user関数でユーザー情報をDBに登録する
// function regist_user($db, $name, $password, $password_confirmation) {
//   if( is_valid_user($name, $password, $password_confirmation) === false){
//     return false;
//   }
  
//   return insert_user($db, $name, $password);
// }


// function is_valid_user($name, $password, $password_confirmation){
//   // 短絡評価を避けるため一旦代入。
//   $is_valid_user_name = is_valid_user_name($name);
//   $is_valid_password = is_valid_password($password, $password_confirmation);
//   return $is_valid_user_name && $is_valid_password ;
// }

// 会員登録で入力された値をチェック●
function validate_user_info($name, $introduction, $email, $password, $new_img_filename){
  $is_valid_user_name = is_valid_user_name($name);
  $is_valid_introduction = is_valid_introduction($introduction);
  $is_valid_email = is_valid_email($email);
  $is_valid_password = is_valid_password($password);
  $is_valid_img = is_valid_img($new_img_filename);

  return $is_valid_user_name
    && $is_valid_introduction
    && $is_valid_email
    && $is_valid_password
    && $is_valid_img;
}

// user_nameの文字数と文字列をチェックし結果をtrueかfalseで返す●
function is_valid_user_name($name) {
  $is_valid = true;
  if(is_valid_length($name, USER_NAME_LENGTH_MIN, USER_NAME_LENGTH_MAX) === false){
    set_error('ユーザー名は'. USER_NAME_LENGTH_MIN . '文字以上、' . USER_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

// introductionの文字数と文字列をチェックし結果をtrueかfalseで返す●
function is_valid_introduction($introduction) {
  $is_valid = true;
  if(is_valid_length($introduction, INTRODUCTION_LENGTH_MIN, INTRODUCTION_LENGTH_MAX) === false){
    set_error('自己紹介文は'. INTRODUCTION_LENGTH_MIN . '文字以上、' . INTRODUCTION_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

// emaiilの文字数と文字列をチェックし結果をtrueかfalseで返す●
function is_valid_email($email) {
  $is_valid = true;
  if (!preg_match(REGEXP_EMAIL, $email)){
    set_error('メールアドレスを正しく入力してください。');
    $is_valid = false;
  }
  return $is_valid;
}

// パスワードをチェックして結果を返す●
function is_valid_password($password){
  $is_valid = true;
  if(is_valid_length($password, USER_PASSWORD_LENGTH_MIN, USER_PASSWORD_LENGTH_MAX) === false){
    set_error('パスワードは'. USER_PASSWORD_LENGTH_MIN . '文字以上、' . USER_PASSWORD_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  if(is_alphanumeric($password) === false){
    set_error('パスワードは半角英数字で入力してください。');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_img($new_img_filename){
  $is_valid = true;
  if($new_img_filename === ''){
    $is_valid = false;
  }
  return $is_valid;
}

// // 入力値に問題なければ、user情報を登録する
// function user($name, $introduction, $email, $password, $new_img_filename){
//   if (validate_user_info($name, $introduction, $email, $password, $new_img_filename)===false){
//     return false;
//   }
//   return insert_user($db, $name, $email, $password, $new_img_filename, $introduction);
// }

// // ユーザー情報をDBに登録する●
function insert_user($db, $name, $email, $password, $new_img_filename, $introduction){
  $sql ='
    INSERT INTO 
      users(
        name,
        email,
        password,
        img,
        introduction)
      VALUES
        (:name, :email, :password, :img, :introduction)';

  return execute_query($db, $sql, array($name, $email, password_hash($password, PASSWORD_DEFAULT), $new_img_filename, $introduction));
}
