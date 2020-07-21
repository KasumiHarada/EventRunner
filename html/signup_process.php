<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';

////
$img_dir    ='./assets/images/'; // アップロードした画像ファイルの保存ディレクトリ
$new_img_filename =''; //アップロードした画像の新しいファイルネーム

$err_msg=array();
///

//session_start();

$db = get_db_connect();
// // ログイン済みか確認し、trueならtopページへリダイレクト
// if(is_logined() === true){
//   redirect_to(HOME_URL);
// }

if ($_SERVER['REQUEST_METHOD']==='POST'){

  // post 送信された
  $name = get_post('name');
  $password = get_post('password');
  $email = get_post('email');
  $introduction = get_post('introduction');
  

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
        
  //   $sql ="SELECT email, password FROM users WHERE name = :name";
  //   $stmt = $dbh->prepare($sql);
  //   $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  //   $stmt->execute();
  //   $user = $stmt->fetch();
    
  // } catch (PDOException $e){
  //     print 'ユーザー名が見つからない'. $e->getMessage();
  // }


  // // エラーがなしで、かつ、同じ名前のユーザが存在しなければ、登録
  // if (count($err_msg)===0 && !isset ($user['user_name'])){
      
      try {

          $sql ='INSERT INTO users (name, email, password, introduction)VALUES
                (:name, :email, :password, :introduction)';
      
          // 準備
          $stmt = $db->prepare($sql);
          
          // 値をバインド
          $stmt->bindValue(':name', $name, PDO::PARAM_STR);
          $stmt->bindValue(':email', $email, PDO::PARAM_STR);          
          $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
          //$stmt->bindValue(':img', $img, PDO::PARAM_STR);
          $stmt->bindValue(':introduction', $introduction, PDO::PARAM_STR);
          
          
          // 実行
          $stmt->execute();
          //$result_msg[] = 'ユーザー登録完了';
    
      } catch (PDOException $e){
          print '登録できない'.$e->getMessage();
      }


      set_message('ユーザー登録が完了しました。');
      //login_as($db, $name, $password);   

  // } else if (isset ($user['user_name'])) {
  //     $err_msg[]= '既に登録済のユーザ名です';
  // } // (!isset ($result) おわり

} // $_SERVERおわり



redirect_to(HOME_URL);