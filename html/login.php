<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';


// ログイン済みか確認し、trueならtopページへリダイレクト
if(is_logined() === true){
    redirect_to(HOME_URL);
}

include_once('../view/login_view.php');  