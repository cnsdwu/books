<header>
    <nav>
        <div class="logo" title="返回首页">
            <a href="/">
                <img src="{{asset($admin->logo)}}" width="120" height="20" alt="">
            </a>
        </div>
        <div class="search" style="display: none;">
            
        </div>
        <div class="user-center">
            <div class="upload" title="上传图书">
                <a href="/post" class="upload-link" z-st="nav_upload"></a>
            </div>
            <div id="user_box" class="user-box">
                <div class="user-head">
                    @if(Auth::check())
                        <span id="user_head">
                            <img src="{{asset($user['path'])}}" alt="">
                        </span>
                    @else
                        <a href="/login" class="user-login">登录</a><a href="/register">注册</a>
                    @endif
                </div>
                @if(Auth::check())
                <ul id="login_list" class="login-list">
                    <li class="login-list-none">{{$user['nickname']}}</li>
                    <a href="/user"><li>个人中心</li></a>
                    <a href="/logout"><li>退出登录</li></a>
                </ul>
                @endif
            </div>
        </div>
    </nav>
</header>