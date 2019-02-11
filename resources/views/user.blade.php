<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$user['nickname']}} - {{$admin->title}}</title>
    <link rel="bookmark" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="stylesheet" href="/theme/{{$admin->theme}}/css/main.css">
    <link rel="stylesheet" href="/theme/{{$admin->theme}}/css/header.css">
    <link rel="stylesheet" href="/theme/{{$admin->theme}}/css/user.css">
    <link rel="stylesheet" href="/theme/{{$admin->theme}}/css/message.css">
    <script type="text/javascript" charset="utf-8" src="/theme/{{$admin->theme}}/js/jquery-3.3.1.js"> </script>
  <style>
    
</style>
</head>
<body>
  @include('layout.header')
    <div class="container">
        <div class="aside">
            <div class="content">
                <ul>
                    <a href="/user?do=set"><li @if(@$_GET['do']=='set'||@$_GET['do']=='')class="active"@endif>个人信息</li></a>
                    <a href="/user?do=kindle"><li @if(@$_GET['do']=='kindle')class="active"@endif>kindle设置</li></a>
                    <li>修改头像</li>
                    <li>修改密码</li>
                </ul>
            </div>
        </div>
        <div class="article">
            <div class="content">
                @if(@$_GET['do']=='kindle')
                <h1>kindle设置</h1>
                @else
                <h1>个人信息</h1>
                @endif
                <div class="form">
                    @if(@$_GET['do']=='kindle')
                    <form action="/user/set/kindle" method="post">
                        @csrf
                        <input type="hidden" value="{{session('vcode')}}" name="hash">
                        <ul>
                            <li>
                                <span class="label">发件邮箱</span>
                                <input type="text" value="{{$admin->email}}" disabled>
                                <span class="remark"><a class="azw" href="https://www.amazon.cn/manageyourkindle" target="__black">前往设置</a><a id="set_help" href="javascript:;">设置教程</a></span>
                            </li>
                            <li>
                                <span class="label">当前邮箱</span>
                                <input type="text" value="{{$userinfo->kindleemail}}" disabled>
                                <span class="remark"></span>
                            </li>
                            <li>
                                <span class="label">修改为</span>
                                <input id="kindleemail" type="email" name="kindleemail" value="{{session('kindleemail')? session('kindleemail'):$userinfo->kindleemail}}" required>
                                <span class="remark push">
                                    <a id="test_push" href="/email/test/{{$userinfo->kindleemail}}">点击推送测试邮件</a>
                                </span>
                            </li>
                            <li>
                                <span class="label">验证码</span>
                                <input type="text" name="vcode" required>
                                <span class="remark push">请在设备测试邮件中查看</span>
                            </li>
                            <li class="submit">
                                <span class="label"></span>
                                <input type="submit" value="应用修改">
                                <span class="remark"></span>
                            </li>
                        </ul>
                    </form>
                    @else
                    <form action="/user/set" method="post">
                        @csrf
                        <ul>
                            <li>
                                <span class="label">用户名</span>
                                <input type="text" name="username" value="{{$users->username}}" disabled>
                                <span class="remark">用户名不可修改</span>
                            </li>
                            <li>
                                <span class="label">邮箱</span>
                                <input type="email" name="email" value="{{old('email')? old('email'):$users->email}}" required>
                                <span class="remark">此邮箱可用于修改密码</span>
                            </li>
                            <li>
                                <span class="label">呢称</span>
                                <input type="text" name="nickname" value="{{old('nickname')? old('nickname'):$userinfo->nickname}}" required>
                                <span class="remark">给自己起一个不一样的名字</span>
                            </li>
                            <li>
                                <span class="label">性别</span>
                                <select name="sex" id="sex" data="{{old('sex')? old('sex'):$userinfo->sex}}">
                                    <option value="1">男</option>
                                    <option value="0">女</option>
                                </select>
                                <span class="remark"></span>
                            </li>
                            <li>
                                <span class="label">地址</span>
                                <input type="text" name="address" value="{{old('address')? old('address'):$userinfo->address}}">
                                <span class="remark">如：山东济南</span>
                            </li>
                            <li>
                                <span class="label">出生年份</span>
                                <input type="number" name="birth_year" min="1900" max="2020" value="{{old('birth_year')? old('birth_year'):$userinfo->birth_year}}">
                                <span class="remark">如：1990</span>
                            </li>
                            <li>
                                <span class="label">兴趣爱好</span>
                                <input type="text" name="interest" value="{{old('interest')? old('interest'):$userinfo->interest}}">
                                <span class="remark">如：看书</span>
                            </li>
                            <li>
                                <span class="label">星座</span>
                                <select name="constellation" id="constellation" data="{{old('constellation')? old('constellation'):$userinfo->constellation}}">
                                    <option value="0">未选择</option>
                                    <option value="1">白羊座</option>
                                    <option value="2">金牛座</option>
                                    <option value="3">双子座</option>
                                    <option value="4">巨蟹座</option>
                                    <option value="5">狮子座</option>
                                    <option value="6">处女座</option>
                                    <option value="7">天秤座</option>
                                    <option value="8">天蝎座</option>
                                    <option value="9">射手座</option>
                                    <option value="10">摩羯座</option>
                                    <option value="11">水瓶座</option>
                                    <option value="12">双鱼座</option>
                                </select>
                                <span class="remark"></span>
                            </li>
                            <li>
                                <span class="label">密码</span>
                                <input type="password" name="password" required>
                                <span class="remark">验证本次修改身份</span>
                            </li>
                            <li class="submit">
                                <span class="label"></span>
                                <input type="submit" value="应用修改">
                                <span class="remark"></span>
                            </li>
                        </ul>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="kindle_set" class="kindle-set">
        <span id="close" class="close">×</span>
        <ol>
            <li>点击本页面的<a href="javascript:;">前往设置</a></li>
            <li>登录绑定设备的亚马逊帐号</li>
            <li>点击【设置】选项卡，点击“个人文档设置”</li>
            <li>记下列表中的kindle邮件地址，点击“添加认可的电子邮箱”</li>
            <img src="/images/my-email.png" alt="">
            <li>添加本站邮箱：{{$admin->email}}，并返回本页面</li>
            <img src="/images/add-email.png" alt="">
            <li>将第4步记下的kindle邮件地址添加至本页面“修改为”一栏</li>
            <li>点击本页面“点击推送测试邮件”</li>
            <li>将您的kindle设置打开并连接WIFI,等待接收推送</li>
            <li>收到推送后，将看到的验证码填入本页面“验证码”一栏</li>
            <li>点击本页面“应用修改”，至此设置完毕</li>
        </ol>
        <hr>
        <div>
            <h2>一些重要说明</h2>
            <ul>
                <li>本站致力于永久免费提供kindle推送服务</li>
                <li>由于服务器及邮箱的限制，我们对推送间隔做了限制，以保证大多数人的正常使用，在使用期间如果出现无法推送的情况，请尝试稍候再试</li>
                <li>本站推送服务采用队列方式，所以推送可能稍有延迟</li>
                <li>由于kindle支持的电子书格式有限，所以可能会有推送成功但没有接收到的情况</li>
                <li>由于本站资源大多数为注册用户上传，所以请自行甄别</li>
                <li>待续...</li>
            </ul>
        </div>
    </div>
    @include('layout.message')

    <script src="/theme/{{$admin->theme}}/js/main.js"></script>
    <script src="/theme/{{$admin->theme}}/js/message.js"></script>
    <!-- <script src="/theme/{{$admin->theme}}/js/post.js"></script>    -->
    <script>
        $(function(){
            var constellation = $('#constellation').attr('data');
            if(constellation > 0){
                $('#constellation option[value='+constellation+']').attr('selected','');
            }
            var sex = $('#sex').attr('data');
            if(sex == 0 || sex == 1){
                $('#sex option[value='+sex+']').attr('selected','');
            }
            $('#test_push').on('click', function(){
                $(this).attr('href', '/email/test/'+$('#kindleemail').val());
                if($.trim($('#kindleemail').val()) == ''){
                    $('#test_push').attr('href', '/email/test/请在此输入邮箱地址');
                }
            });
            $('#set_help').on('click', function(){
                $('#kindle_set').css('display', 'block');
            });
            $('#kindle_set #close').on('click', function(){
                $('#kindle_set').css('display', 'none');
            });
        })
    </script>
</body>
</html>