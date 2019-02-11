<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页 - {{$admin->title}}</title>
    <link rel="bookmark" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="stylesheet" href="theme/{{$admin->theme}}/css/main.css">
    <link rel="stylesheet" href="theme/{{$admin->theme}}/css/header.css">
    <link rel="stylesheet" href="theme/{{$admin->theme}}/css/index.css">
    <script type="text/javascript" charset="utf-8" src="theme/{{$admin->theme}}/js/jquery-3.3.1.js"> </script>
    <style>
    </style>
</head>
<body>
    @include('layout.header')
    <div class="subnav-content-wrap" id="tab_anchor" style="height: 56px;">
        <div class="subnav-wrap" style="left: 0px;">
            <div class="top-hull">
                <div class="subnav-contentbox">
                    <div class="tab-nav-container">
                        <ul class="subnav-content text-center">
                            <li id="course-li" class="current"><a href="/" class="title" z-st="home_tab_home">最多推荐</a></li>
                            
                            <li id="forum-li"><a href="{{asset('new')}}" class="title" z-st="home_tab_lastest">最新收录</a></li>
                            <li id="data-li"><a href="{{asset('click')}}" class="title" z-st="home_tab_rise">人气最高</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="all-list-box">
        <img id="coverimg" class="coverimg" src="/images/cover.jpg" alt="">
    <div class="list-box">
        @foreach($post as $value)
<div class="card-box">
        <div class="card-img">
            <a href="{{asset('post/'.$value->id)}}">
                <div>
                @if($value->logo)
                    <img src="{{asset('storage/upload/cover/'.$value->logo)}}" alt="">
                @else
                    <canvas class="myCanvas" title="{{$value->title}}" data="{{$value->author}}" width="96" height="128">
                        您的浏览器不支持 HTML5 canvas 标签。
                    </canvas>
                    <!-- <img src="default/images/cover.jpg" alt=""> -->
                @endif
                </div>
                
            </a>
        </div>
        <div class="card-info">
            <p class="card-info-title">
                <a href="{{asset('post/'.$value->id)}}">{{$value->title}}</a>
            </p>
            <p class="card-info-author">
                @if($value->author)
                {{$value->author}}
                @else
                佚名
                @endif
            </p>
            <p class="card-info-category">{{$category[$value->id]}}</p>
<!--             <p class="card-info-item">
                <span><img src="default/images/card-liulan.svg" alt="">{{$value->look}}</span>
                <span><img src="default/images/card-pinglun.svg" alt="">{{$comment[$value->id]}}</span>
                <span><img src="default/images/card-zan.svg" alt="">{{$value->admire}}</span>
            </p> -->
        </div>
<!--         <div class="card-item">
            <span class="auto">{{$auth[$value->id]}}</span>
            <span class="time">{{$date[$value->id]}}</span>
        </div> -->
    </div>
    @endforeach
        
    {{$post->links()}}
    </div>
    </div>
<script src="theme/{{$admin->theme}}/js/main.js"></script>
<script src="theme/{{$admin->theme}}/js/index.js"></script>
</body>
</html>