  <header>
      <div class="container">
          <div class="d-flex header_flex">
              <div class="left_header">
                  <h2>メモ共有</h2>
              </div>
              <div class="right_header">
                  <ul>
                      <li>
                          <form action="{{ route('logout') }}" method="post">
                              @csrf
                              <input class="logout_btn" type="submit" value="ログアウト" />
                          </form>
                      </li>
                      <li>ユーザー名：{{ Auth::user()->name }}</li>
                  </ul>
              </div>
          </div>
      </div>
  </header>