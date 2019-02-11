<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>后台 - {{$admin->title}}</title>
	
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
        th{
        	text-align: center;
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
		      		<a class="nav-link" href="/admin/index">基本设置</a>
		    	</li>
		    	<li class="nav-item">
		      		<a class="nav-link" href="/admin/head">默认头像</a>
		    	</li>
		    	<li class="nav-item active">
		      		<a class="nav-link" href="/admin/booklist">图书列表</a>
		    	</li>
		  </ul>
		</div>
	</nav>

	<div class="container">
			  
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>id</th>
		        <th>名称</th>
		        <th>用户</th>
		        <th>分类</th>
		        <th>时间</th>
		        <th>审核</th>
		        <th>操作</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($post as $value)
			     <tr>
			        <td>{{$value->id}}</td>
			        <td><a href="/post/{{$value->id}}">{{$value->title}}</a></td>
			        <td>{{$value->author}}</td>
			        <td>{{$value->category()->value('title')}}</td>
			        <td>{{$value->created_at}}</td>
			        <td class="display">{!!$value->display? '<button data="'.$value->id.'" type="button" class="btn btn-outline-success btn-sm">已通过</button>':'<button data="'.$value->id.'" type="button" class="btn btn-outline-secondary btn-sm">审核中</button>'!!}</td>
			        <td>
			        	<button type="button" class="btn btn-outline-info btn-sm">修改</button>
			        	<button data="{{$value->id}}" type="button" class="del btn btn-outline-danger btn-sm">删除</button>
			        </td>
			     </tr>
		      @endforeach
		    </tbody>
		</table>
		<div class="container">
		    {{$post->links()}}
		</div>
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
	        $('.display').on('click', 'button', function(){
	        	var id = $(this).attr('data');

	        	$.get('/admin/post/display/'+id, function(data){
	        		if(data.error == 1){
	        			var temp = $('.display button[data='+id+']');
	        			if(temp.text() == '审核中'){
	        				temp.text('已通过');
	        			}else{
	        				temp.text('审核中');
	        			}
	        			temp.attr('class', 'btn btn-outline-primary btn-sm');
	        		}
	        	},'json');
	        });
	        $('.del').on('click', function(){
	        	var id = $(this).attr('data');
	        	var tr = $(this).parent().parent();
	        	$.get('/admin/post/del/'+id, function(data){
	        		if(data.error == 1){
	        			tr.remove();
	        			$('#notice').css('display', 'block');
	        			$('#notice p').text('删除成功');
	        			setTimeout(function(){
			                $('#notice').css('display', 'none');
			                $('#session #do').text('');
			            },2000);
	        		}else{
	        			$('#notice').css('display', 'block');
	        			$('#notice p').text('删除失败');
	        			setTimeout(function(){
			                $('#notice').css('display', 'none');
			                $('#session #do').text('');
			            },2000);
	        		}
	        	},'json');
	        });
		})
	</script>
</body>
</html>