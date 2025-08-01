<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
   <title>メモ帳</title> 
  </head>
  <body>
    <header>
      <div class="container">
        <div class="d-flex header_flex">
          <div class="left_header">
            <h2>メモ共有</h2>
          </div>
          <div class="right_header">
            <ul>
              <li>
                <a href="/">トップ</a>
              </li>
              <li>
                <a href="/timeline">タイムライン</a>
              </li>
              <li>
                <form action="{{ route('logout') }}" method="post">@csrf 
                  <input class="logout_btn" type="submit" value="ログアウト">
                </form>
              </li>
              <li>
                <a href="/user_profile/{{Auth::id()}}">ユーザー名：{{ Auth::user()->name }}</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <div class="container">
        @yield('content') 
    </div>
  </body>
</html>