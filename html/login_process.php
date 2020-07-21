<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';

session_start();

$db = get_db_connect();

if ($_SERVER['REQUEST_METHOD']==='POST'){

    // post送信された値を変数に格納
    $email    = get_post('email');
    $password = get_post('password');

    // 該当するユーザーがusersにいるかチェックする
    $sql = "SELECT user_id, name, password, email FROM users WHERE email = :email";
    $stmt =$db->prepare($sql);
        
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    
    $stmt ->execute();
    
    $user = $stmt->fetch();

    // メールアドレスが登録済みだったら
    if (isset ($user['email']) ){
           
        // 入力されたパスワードとハッシュ化されたパスワードの検証
        if (password_verify ($password, $user['password'])){
            // -----ユーザ名とパスワードが一致している場合-----
            
            // emailとパスワードが一致していることが確認できたから、
            // $_SESSIONにselect文で取得したuser_idとnameを格納
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];

            // 管理者の場合→管理ページへ
            if ($name === 'admin'){ 
                header('Location: admin.php');
                exit;
            } else {
                header('Location: index.php');
                exit;
            }
            
        } else {
            $err_msg[]= 'パスワードが違います';
        } // password検証おわり
    
    } else {
        $err_msg[]= 'ユーザー名またはパスワードが違います';
    }// isset($user)おわり 
    header('Location: index.php');
    
} // $_SERVERおわり


        