<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/function.php';

session_start();

// DBに接続する
$db = get_db_connect();

// それぞれの入力項目のチェック



// post送信された時の処理
if ($_SERVER['REQUEST_METHOD'] ==='POST'){
    // ログアウトの処理
    
    $action = get_post('action');
    var_dump($action);

    
    // $action='confirm'の場合
    if ($action === 'confirm'){
        
        // post送信されたデータをそれぞれ変数に格納
        $event_name = get_post('event_name');
        $name       = get_post('name');
        $email      = get_post('email');
        $date       = get_post('date');
        $time       = get_post('time');
        $location   = get_post('location');
        $address    = get_post('address');
        $info       = get_post('info');
    
        
    } else if ($action === 'send'){
    
        $location   = $_SESSION['location'];
        $address    = $_SESSION['address'];

        try{
        // $mode='send'の場合DBにデータを格納する
        $sql = "
        INSERT INTO
            location(
            location,
            address
            )
        VALUES (?, ?)
        ";
        
        $stmt=$db->prepare($sql);
        $stmt->bindValue(':location', $location, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
       
        $stmt->execute();
       
        //execute_query($db, $sql, array($location, $address));
        } catch (PDOException $e){
            print 'NGできない'.$e->getMessage();
        }
        
        
    } //$actionおわり
    
    
    // それぞれバリデーションが必要
    
}

// HTML表示のために$modeを設定する（input, confirm, send）
$mode='input';
if (isset($_POST['back']) && $_POST['back']){
    // 何もしない

} else if (isset($_POST['confirm']) && $_POST['confirm']){
    $_SESSION['event_name'] = $event_name;
    $_SESSION['name']       = $name;
    $_SESSION['email']      = $email;
    $_SESSION['date']       = $date;   
    $_SESSION['time']       = $time;       
    $_SESSION['location']   = $location;  
    $_SESSION['address']    = $address; 
    $_SESSION['info']       = $info;  

    $mode='confirm';

} else if (isset($_POST['send']) && $_POST['send']){
    $mode='send';
} else {
    // それぞれ空文字を入れてセッションを初期化しておく
    $_SESSION['event_name'] = "";
    $_SESSION['name']       = "";
    $_SESSION['email']      = "";
    $_SESSION['date']       = "";   
    $_SESSION['time']       = "";   
    $_SESSION['location']   = "";  
    $_SESSION['address']    = "";
    $_SESSION['info']       = "";
  
}
    
    
    

include_once('../view/create_event_view.php');  
        