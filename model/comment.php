<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// コメントを表示する
function get_comments($db, $event_id){
    
    $sql ="
      SELECT 
        comments.comment,
        comments.create_datetime,
        users.name
      FROM comments LEFT OUTER JOIN users ON comments.user_id = users.user_id
      WHERE event_id =:event_id
      ORDER BY create_datetime DESC
      
    ";
    return fetch_all_query($db, $sql, array($event_id));

}

// コメントをDBに登録する
function insert_comments($db, $user_id, $event_id, $comment){

    $sql ="
      INSERT INTO 
        comments(
          user_id, 
          event_id, 
          comment)
      VALUES(:user_id, :event_id, :comment)
    ";

    return execute_query($db, $sql, array($user_id, $event_id, $comment));
}

// コメントの文字数と文字列をチェックし結果をtrueかfalseで返す
function is_valid_comment($comment) {
    $is_valid = true;
    if(is_valid_length($comment, INTRODUCTION_LENGTH_MIN, INTRODUCTION_LENGTH_MAX) === false){
      set_error('コメントは'. INTRODUCTION_LENGTH_MIN. '文字以上、' . INTRODUCTION_LENGTH_MAX . '文字以内にしてください。');
      $is_valid = false;
    }
    return $is_valid;
}
