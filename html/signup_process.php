<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/function.php';

$img_dir    ='./img/'; // アップロードした画像ファイルの保存ディレクトリ
$new_img_filename =''; //アップロードした画像の新しいファイルネーム

$err_msg=array();
//session_start();

// ログイン済みか確認し、trueならtopページへリダイレクト
if(is_logined() === true){
  redirect_to(HOME_URL);
}

if ($_SERVER['REQUEST_METHOD']==='POST'){

  $name = get_post('name');
  $password = get_post('password');
  $email = get_post('email');
  $introduction = get_post('introduction');
  $image    = get_post('image');
  
  $img = get_upload_filename($img);
  var_dump($name);
  var_dump($image);
  // // アップロード画像ファイルの保存
  // // HTTP POST でファイルがアップロードされたかどうかチェック
  // if (is_uploaded_file($_FILES['new_img']['tmp_name']) === TRUE) {
  //   // 画像の拡張子を取得
  //   $extension = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
  //   // 指定の拡張子であるかどうかチェック
  //   if ($extension === 'jpg' || $extension === 'jpeg') {
  //     // 保存する新しいファイル名の生成（ユニークな値を設定する）
  //     $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
  //     // 同名ファイルが存在するかどうかチェック
  //     if (is_file($img_dir . $new_img_filename) !== TRUE) {
  //       // アップロードされたファイルを指定ディレクトリに移動して保存
  //       if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
  //           $err_msg[] = 'ファイルアップロードに失敗しました';
  //       }
  //     } else {
  //       $err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
  //     }
  //   } else {
  //     $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEGのみ利用可能です。';
  //   }
  // } else {
  //   $err_msg[] = 'ファイルを選択してください';
  // }



  // // select文で、user_nameを呼び出す
  // try {
            
  //   $sql ='SELECT name, password FROM users WHERE name = :name';

  //   $stmt = $dbh->prepare($sql);
    
  //   $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    
  //   $stmt->execute();
    
  //   $user = $stmt->fetch();
    
  // } catch (PDOException $e){
  //     print 'ユーザー名が見つからない'. $e->getMessage();
  // }


  // エラーがなしで、かつ、同じ名前のユーザが存在しなければ、登録
  if (count($err_msg)===0 && !isset ($user['user_name'])){
      
      try {
          
          // insert文で新規登録されたユーザ情報をDBへ
          $sql ='INSERT INTO users (name, email, password, img, introduction)VALUES
                (:name, :email, :password, :img, :introduction)';
      
          // 準備
          $stmt = $dbh->prepare($sql);
          
          // 値をバインド
          $stmt->bindValue(':name', $name, PDO::PARAM_STR);
          $stmt->bindValue(':email', $email, PDO::PARAM_STR);          
          $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
          $stmt->bindValue(':img', $img, PDO::PARAM_STR);
          $stmt->bindValue(':introduction', $introduction, PDO::PARAM_STR);
          
          
          // 実行
          $stmt->execute();
          $result_msg[] = 'ユーザー登録完了';
    
      } catch (PDOException $e){
          print '登録できない';
      }
          

  } else if (isset ($user['user_name'])) {
      $err_msg[]= '既に登録済のユーザ名です';
  } // (!isset ($result) おわり

} // $_SERVERおわり




// // パスワードをハッシュ化する
// $hash = password_hash($password, PASSWORD_DEFAULT);
// $hash_confirmation = password_hash($password_confirmation, PASSWORD_DEFAULT);

// // post送信されたpasswordを変数に格納する
// $password = $hash;
// // post送信されたpassword(確認用)を変数に格納する
// $password_confirmation = $hash_confirmation;


// DB接続
//$db = get_db_connect();

// // sessionのtokenとpost（hidden）送信されたtokenを比較して問題なければ処理を続ける
// if (isset($_POST['token']) ===false && $_POST['token'] !== $_SESSION['token']){
//   // 不正な処理が行われたからsession情報消去
//   redirect_to(LOGIN_URL);
//   $_SESSION = array();
//   exit;

// } else {
//   // 新規ユーザー登録　password_hash($password, PASSWORD_DEFAULT)
//   try{
    
//     $result = regist_user($db, $name, $password, $password_confirmation);
//     if( $result=== false){
//       set_error('ユーザー登録に失敗しました。');
//       redirect_to(SIGNUP_URL);
//     }
//   }catch(PDOException $e){
//     set_error('ユーザー登録に失敗しました。');
//     redirect_to(SIGNUP_URL);
//   }

//   set_message('ユーザー登録が完了しました。');
//   login_as($db, $name, $password);

// } 

// redirect_to(HOME_URL);