<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>后台</title>
	
	<!-- 新 Bootstrap4 核心 CSS 文件 -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
	 
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
	 
	<!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
	<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
	 
	<!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
	<style>
		.notice{
            display: none;
            width: 300px;
            background: #ccc;
            border-radius: 5px;
            opacity: 0.8;
            position: fixed;
            top: 32.8%;
            left: 50%;
            transform: translateX(-50%);
            padding: 20px;
        }
        .notice p{
            text-align: center;
        }
        .session{
            display: none;
        }
        </style>
</head>
<body>
	
	<!-- 小屏幕上水平导航栏会切换为垂直的 -->
	<nav class="navbar navbar-expand-md bg-primary navbar-dark">
		<a class="navbar-brand" href="#"><img src="{{asset($admin->logo)}}" alt="" style="width: 60px"></a>
	   	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  <!-- Links -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
		  	<ul class="navbar-nav">
		    	<li class="nav-item">
		      		<a class="nav-link" href="index">基本设置</a>
		    	</li>
		    	<li class="nav-item active">
		      		<a class="nav-link" href="#">默认头像</a>
		    	</li>
		    	<li class="nav-item">
		      		<a class="nav-link" href="booklist">图书列表</a>
		    	</li>
		  </ul>
		</div>
	</nav>

	<div class="container">
			  
<table class="table table-hover">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
</table>

	</div>
	<!-- 提示内容 -->
	<div id="notice" class="notice">
	    <p>这是一段提示文本！</p>
	</div>
	<div id="session" class="session">
	<span id="do">{{session('do')}}</span>
	<span id="error">{{session('error')}}</span>
	<span id="message">{{session('message')}}</span>
	</div>
	<script>
		$(function(){
			var ido = $('#session #do').text();
	        var error = $('#session #error').text();
	        var message = $('#session #message').text();
	        if(ido == 'admin'){
	            $('#notice').css('display', 'block');
	            $('#notice p').text(message);
	            setTimeout(function(){
	                $('#notice').css('display', 'none');
	                $('#session #do').text('');
	            },2000);
	        }
		})
	</script>
</body>
</html>