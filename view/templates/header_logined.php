<header>
<nav class="navbar navbar-expand-sm bg-info navbar-dark">
  <a class="navbar-brand" href="index.php">
    <img src="../assets/images/tree.jpg" alt="Logo" style="width:40px;">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php print(CREATE_EVENT_URL);?>">イベントを主催する</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php print(SEARCH_URL);?>">イベントを探す</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php print(MYPAGE_URL);?>">マイページ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php print(LOGOUT_URL);?>">ログアウト</a>
      </li>      
    </ul>
  </div>
</nav>
<p>ようこそ、<?php print($user['name']); ?>さん。</p>  
</header>