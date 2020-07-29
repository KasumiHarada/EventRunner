<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/user.php';
require_once '../model/event.php';

session_start();

// ログイン済みか確認し、falseならloginページへリダイレクト
if(is_logined() === false){
    redirect_to(LOGIN_URL);
}

// DBに接続する
$db = get_db_connect();

// login済みのユーザーIDとパスワードをセッションから取得して返す
$user = get_login_user($db);
// user_idを取得する
$user_id = $user['user_id'];
$name = $user['name'];

// それぞれの入力項目のチェック


// post送信された時の処理
if ($_SERVER['REQUEST_METHOD'] ==='POST'){
    // ログアウトの処理
        
        // post送信されたデータをそれぞれ変数に格納
        $event_name = get_post('event_name');
        $email      = get_post('email');
        $date       = get_post('date');
        $time       = get_post('time');
        $location   = get_post('location');
        $address    = get_post('address');
        $event_info = get_post('event_info');
        $capacity   = get_post('capacity');

        // 入力項目を全てチェック
        if(validate_event($event_name, $date, $time, $location, $address, $event_info, $capacity)===false){
            redirect_to('create_event.php');
        }
        // eventsテーブルとlocationテーブルにデータをinsertする
        $db->beginTransaction();
        try{     

            $sql = "
            INSERT INTO
                location(
                location,
                address
                )
            VALUES (:location, :address)
            ";
            
            //execute_query($db, $sql, array($location, $address));
            $stmt=$db->prepare($sql);
            $stmt->bindValue(':location', $location, PDO::PARAM_STR);
            $stmt->bindValue(':address', $address, PDO::PARAM_STR);
            $stmt->execute();

            $location_id = $db->lastInsertId('location_id');

            $sql = "
            INSERT INTO
                events(
                user_id,
                location_id,
                event_name,
                introduction,
                capacity,
                date,
                time
                )
            VALUES(:user_id, :location_id, :event_name, :event_info, :capacity, :date, :time)    
            ";

            //execute_query($db, $sql, array($user_id, $location_id, $event_name, $introduction, $date, $time));
            $stmt=$db->prepare($sql);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':location_id', $location_id, PDO::PARAM_INT);
            $stmt->bindValue(':event_name', $event_name, PDO::PARAM_STR);
            $stmt->bindValue(':event_info', $event_info, PDO::PARAM_STR);
            $stmt->bindValue(':capacity', $capacity, PDO::PARAM_INT);        
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt->bindValue(':time', $time, PDO::PARAM_STR);          
            $stmt->execute();

            $db->commit();

        } catch (PDOException $e){
            //print 'できない'.$e->getMessage();
            // ロールバック処理
            $db->rollback();
            // 例外をスロー
            throw $e;
            redirect_to('CREATE_EVENT_URL');
        }
        
        set_message('イベントを登録しました。');
    
}    

include_once(VIEW_PATH .'create_event_view.php');  
        