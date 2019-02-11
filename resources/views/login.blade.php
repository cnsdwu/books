<html>
<head>
<title>用户登录 - {{$admin->title}}</title>


<meta charset="utf-8">
<link rel="bookmark" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/main.css">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/header.css">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/info.css">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/message.css">
    <script type="text/javascript" charset="utf-8" src="../theme/{{$admin->theme}}/js/jquery-3.3.1.js"> </script>
<style>
  html, body, div, span, input, button, figure, i, h1, h2, h3, h4, h5, h6, em, img, strong, sub, sup, tt, dd, dl, dt, form, label, table, caption, tbody, tfoot, thead, tr, th, td, ul, ol, li, p, a {
      margin: 0;
      padding: 0;
  }
  html, body {
    height: 100%;
    background: #f4f4f4;
  }
  body {
    font: 14px/1.5 "PingFang SC", "Lantinghei SC", "Microsoft YaHei", "HanHei SC", "Helvetica Neue", "Open Sans", Arial, "Hiragino Sans GB", "微软雅黑", "STHeiti", "WenQuanYi Micro Hei", SimSun, sans-serif; 
  }
  input, textarea, select, button {
    font-family: inherit;
    font-size: 14px;
    border: 0;
    outline: none;
  }
  .login-box {
    width: 336px;
    min-height: 400px;
    background: #ffffff;
    position: fixed;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-70%);
    margin: 50px auto;
    padding: 30px 32px;
    box-shadow: 0px 1px 12px 0px rgba(0, 0, 0, 0.2);
  }
  .login-switch {
    width: 53px;
    height: 53px;
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
  }
  .module-l-static .l-static, .module-l-static .static-l {
    display: block;
  }
  .l-tab-covers {
    text-align: center;
    /*border-bottom: 1px solid #eee;*/
    font-size: 16px;
    border-bottom: 1px solid #eeeeee;
  }
  .l-tab-covers .l-tab-list:hover, .l-tab-covers .l-tab-list.current {
    color: #282828;
    /*border-bottom: 2px solid #282828;*/
    font-weight: 500;
  }
  .l-tab-covers .l-tab-list {
    color: #999999;
    display: inline-block;
    margin-right: 30px;
    border-bottom: 2px solid transparent;
    padding-bottom: 20px;
    margin-bottom: -1px;
    cursor: pointer;
  }
  .static-module-covers {
    background: #ffffff;
    position: relative;
    z-index: 2;
    margin-top: 20px;
    padding-bottom: 8px;
  }
  .pass-login-covers {
    position: relative;
  }
  .ipt-tips-default, .email, .password {
    margin-bottom: 20px;
  }
  .ipt-tips-default, .email, .password {
    margin-bottom: 20px;
  }
  .ipt-default-current {
    width: 336px;
  }
  .text-style {
    height: 42px;
    padding-left: 20px;
    padding-right: 20px;
    color: #666666;
    font-size: 14px;
    border: 1px solid #dddddd;
    background: #f4f4f4;
    box-sizing: border-box;
    border-radius: 4px;
  }
  thead, tr, th, td, ul, ol, li, p, a {
    margin: 0;
    padding: 0;
  }
  .btn-current-big {
    width: 336px;
  }
  .btn-current-big {
    width: 320px;
    height: 42px;
    font-size: 16px;
  }
  .btn-disabled {
    color: #fff;
    background: #55c3dc;
    border: 1px solid #55c3dc;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    cursor: default;
  }
  .auto-login {
    line-height: 14px;
    margin-top: 20px;
  }
  .auto-login .auto-login-cd{
    background: url(/images/checkbox.svg) no-repeat 0 3px;
  }
  .auto-login .auto-login-cd[checked='checked'] {
    background: url(/images/checkboxed.svg) no-repeat 0 3px;
  }
  .auto-login input {
    vertical-align: middle;
    opacity: 0;
    margin-right: 8px;
  }
  input[type="checkbox"], input[type="radio"] {
    box-sizing: border-box;
    padding: 0;
  }
  .login-links {
    color: #999999;
    float: right;
  }
  a {
    text-decoration: none;
    color: inherit;
  }
  .btn-current-big {
    width: 336px;
  }

  .login-box{
    /*margin-top: 30px;*/
  }
</style>
</head>
<body marginwidth="0">


<div class="login-box module-l-static" id="login-box">
    <div class="l-static">
        <div class="l-tab-covers">
            <div class="l-tab-list current">用户帐号登录</div>
        </div>
        <div class="static-module-covers">
            <div class="pass-login-covers">
              <form action="login" method="post">
                @csrf
                  <div class="email">
                      <input id="username" type="text" name="username" placeholder="用户名/邮箱" autocomplete="on" pattern="[0-9a-zA-z-_@.]{1,100}" value="{{old('username')}}" maxlength="100" class="text-style ipt-default-current" title="字母、数字、下划线、横线"  autofocus required>
                  </div>
                  <div class="password">
                      <input type="password" id="password" name="password" placeholder="密码" maxlength="40" maxlength="100" pattern="^[^\u2E80-\u9FFF]+$" autocomplete="off" class="text-style ipt-default-current" required>
                  </div>
                  
                  <div class="login">
                      <!--  btn-disabled  btn-default-main -->
                      <input type="submit" id="loginbtn" class="btn-current-big btn-disabled" value="登录">
                  </div>
                  <div id="auto_login" class="auto-login">

                      <label class="auto-login-cd">
                      <input type="checkbox" name="autolog" id="autolog" checked="" class="auto-login-cd">下次自动登录</label>
                      <div class="login-links">
                          <a href="javascript:;" class="">忘记密码</a>
                          &nbsp; | &nbsp;<a href="../register" class="">注册</a>
                      </div>
                  </div>
            </div>
            </form>
        </div>
    </div>
    
</div>
@include('layout.message')
<script src="../theme/{{$admin->theme}}/js/message.js"></script>
<script>
  $('#auto_login label').on('click','input',function(){
    if($(this).parent().attr('checked') == 'checked'){
      $(this).parent().removeAttr('checked');
    }else{
      $(this).parent().attr('checked','checked');
    }
  });
</script>
</body></html>