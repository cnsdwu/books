<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$post->title}} - {{$admin->title}}</title>
    <link rel="bookmark" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{$admin->icon}}">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/main.css">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/header.css">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/info.css">
    <link rel="stylesheet" href="../theme/{{$admin->theme}}/css/message.css">
    <script type="text/javascript" charset="utf-8" src="../theme/{{$admin->theme}}/js/jquery-3.3.1.js"> </script>
    <script type="text/javascript" src="../theme/{{$admin->theme}}/js/wangEditor.js"></script>
</head>
<body>
    @include('layout.header')
<main class="main-wrapper">
    <div class="content">
        <img id="coverimg" class="coverimg" src="/images/cover.jpg" alt="">
        <div class="work-details-content">
            <div class="left-details-head">
            <div class="details-contitle-box article-details-head">
                <span>
                    @if($post->logo)
                        <img src="{{asset('storage/upload/cover/'.$post->logo)}}" alt="">
                    @else
                        <canvas id="myCanvas" title="{{$post->title}}" data="{{$post->author}}" width="180" height="240">
                            您的浏览器不支持 HTML5 canvas 标签。
                        </canvas>
                    @endif
                    
                </span>
                <div>
                    <h2>
                        {{$post->title}}
                    </h2>
                    <p class="author">
                        作者：
                        @if($post->author)
                        {{$post->author}}
                        @else
                        佚名
                        @endif
                    </p>
                    
                
                <div class="work-head-box">
                    <div class="head-left">
                        <span class="head-index">
                            <span>分类 :</span>
                            <span>{{$category->title}}</span>
                        </span>
                    </div>
                </div>
                <div class="work-head-box">
                    <div class="head-left">
                        <span class="head-index uploader">
                            <span>贡献 :</span>
                            <span>{{$author->nickname}}</span>
                        </span>
                    </div>
                </div>
                <!--发布时间-->
                    <p class="title-time">
                        <span>{{$post->created_at}}</span>
                    </p>
                    <span class="post-info">
                        <span><img src="/images/card-liulan.svg" alt="">{{$post->look}}</span>
                        <span><img src="/images/card-zan.svg" alt="">{{$post->admire}}</span>
                    </span>
            </div>
            </div>
        </div>
        </div>
        <div class="comment-module article-comments">
            
            <table>
                @if(count($file)>0)
                <tr>
                    <th>格式</th>
                    <th>大小</th>
                    <th>下载数</th>
                    <th>推送数</th>
                    <th>下载</th>
                    <th>推送</th>
                </tr>
                @foreach($file as $key => $value)
                    <tr @if($key%2 != 0) class="odd" @endif>
                    <td>{{$value->extension}}</td>
                    <td>
                        @if($value->size >= 1024*1024)
                            {{round($value->size/1024/1024, 2)}}MB
                        @elseif($value->size >= 1024)
                            {{round($value->size/1024, 2)}}KB
                        @else
                            {{round($value->size, 2)}}B
                        @endif
                    </td>
                    <td>{{$value->download}}</td>
                    <td>{{$value->push}}</td>
                    <td class="over"><a href="/download/{{$value->path}}/{{$post->title}}.{{$value->extension}}">下载</a></td>
                    <td class="over">
                        @if(in_array($value->extension, array('epub','azw','azw3')))
                        推送
                        @else
                        <a href="/email/{{$value->path}}/{{$post->title}}.{{$value->extension}}">推送</a>
                        @endif
                    </td>
                    </tr>
                @endforeach
                @else
                    <tr><th colspan="6">本书暂不提供服务</th></tr>
                @endif
                @if(Auth::id() == $post->user_id || Auth::id() == 1)
                <tr>
                    <td id="uploadBook" class="uploadBook" colspan="6">上传图书</td>
                </tr>
                @endif
            </table>
            <div id="upload" class="upload"></div>
            
            
        </div>
        <div class="book-content">
            <div class="book-content-title">图书简介</div>
            <div class="book-content-info">
                @if($post->display != 1)
                    {{$post->content}}
                @endif
                @if($post->display == 1)
                    {!!$post->content!!}
                @endif
            </div>
        </div>
        <div id="admire-box" data="{{$post->id}}" class="admire-box" title="推荐">
            @csrf
            <div id="admire-box-div" class="admire-box-div">
                <img src="/images/dianzan.svg" alt="">
            </div>
        </div>
        
        <div class="comment-box">
            <form action="/post/{{$post->id}}/comment" method="post">
                @csrf
            <div class="comment-box-content">
                <ul>
                    @if(count($comment) > 0)
                    @foreach($comment as $value)
                    <li>
                        <span class="comment-box-content-head"><img src="{{asset($value['path'])}}" alt=""></span>
                        <div class="comment-box-content-info">
                            <div class="comment-box-content-info-author">{{$value['nickname']}}</div>
                            <span class="comment-box-content-time">{{$value['time']}}</span>
                            <div class="comment-box-content-info-content">{!!$value['content']!!}</div>
                            <div class="comment-box-content-info-item">
                                <span><img src="/images/card-pinglun.svg" alt=""></span>
                                <span class="comment-box-content-info-content-admire" data="{{$value['id']}}"><img src="/images/card-zan.svg" alt="">{{$value['admire']}}</span>
                            </div>
                        </div>
                        
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            <div class="comment-box-textarea">
                 <div id="div1"></div>
                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                <div class="comment-box-textarea-submit">
                    <span><button id="submit" type="submit">发表回复</button></span>
                    <span>Ctrl+Enter</span>
                </div>
            </div>
            </form>
        </div>
    </div>
</main>
@include('layout.message')
<script src="../theme/{{$admin->theme}}/js/main.js"></script>
<script src="../theme/{{$admin->theme}}/js/info.js"></script>
<script src="../theme/{{$admin->theme}}/js/message.js"></script>
</body>
</html>