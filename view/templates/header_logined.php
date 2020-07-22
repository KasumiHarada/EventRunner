<header>
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="<?php print(HOME_URL);?>">EventRunner</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#headerNav" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="ナビゲーションの切替">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="headerNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php print(CREATE_EVENT_URL);?>">イベントを主催する</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php print(HISTORY_URL);?>">イベントを探す</a>
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