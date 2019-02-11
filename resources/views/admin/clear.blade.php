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
		<a class="navbar-brand" href="/"><img src="{{asset($admin->logo)}}" alt="" style="width: 60px"></a>
	   	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  <!-- Links -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
		  	<ul class="navbar-nav">
		    	<li class="nav-item active">
		      		<a class="nav-link" href="/admin/index">基本设置</a>
		    	</li>
		    	<li class="nav-item">
		      		<a class="nav-link" href="/admin/head">默认头像</a>
		    	</li>
		    	<li class="nav-item">
		      		<a class="nav-link" href="/admin/booklist">图书列表</a>
		    	</li>
		  </ul>
		</div>
	</nav>

	<div class="container">
			  
		<form action="setbase" method="post" enctype="multipart/form-data">
			@csrf
		  <div class="form-group">
		    <label for="title">网站标题</label>
		    <input type="text" name="title" class="form-control" id="title" value="{{$admin->title}}">
		  </div>
		  <div class="form-group">
		    <label for="email">推送邮箱</label>
		    <input type="text" name="email" class="form-control" id="title" value="{{$admin->email}}">
		  </div>
			<div class="form-group">
		    	<label for="name">网站主题</label>
		    	<select class="form-control" name="theme">
		    		@foreach($theme as $key => $value)
		    			@if($key > 1)
			      			<option value="{{$value}}">{{$value}}</option>
			      		@endif
			      	@endforeach
		    	</select>
		  	</div>
		  	<div class="form-group">
				<img src="{{asset($admin->logo)}}" class="rounded" alt="Cinque Terre">
				<label class="file">
			  		<input type="file" id="file" name="logo">
			  		<span class="file-custom"></span>
				</label>
			</div>
			<div class="form-group">
				<img src="{{asset($admin->icon)}}" class="rounded" alt="Cinque Terre">
				<label class="file">
			  		<input type="file" id="file1" name="icon">
			  		<span class="file-custom"></span>
				</label>
			</div>
		  	<div class="form-group">
		    	<label for="pwd">后台密码</label>
		    	<input type="password" class="form-control" id="pwd" name="password">
		  	</div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>

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
		});
	</script>
</body>
</html>